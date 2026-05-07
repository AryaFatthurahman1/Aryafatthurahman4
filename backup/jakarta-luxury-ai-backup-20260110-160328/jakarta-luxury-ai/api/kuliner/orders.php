<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

// Helper to get raw input
function getJsonInput() {
    return json_decode(file_get_contents("php://input"));
}

switch ($method) {
    case 'GET':
        // List Orders - Only show pending and confirmed, exclude cancelled
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : 1;
        $status_filter = isset($_GET['status']) ? $_GET['status'] : null;
        
        $query = "SELECT o.id, o.item_id, o.quantity, o.total_price, o.status, o.created_at, c.name, c.image_url 
                  FROM orders o
                  JOIN culinary_items c ON o.item_id = c.id
                  WHERE o.user_id = :user_id";
        
        // Exclude cancelled orders by default, unless specifically requested
        if ($status_filter) {
            $query .= " AND o.status = :status";
        } else {
            $query .= " AND o.status != 'cancelled'";
        }
        
        $query .= " ORDER BY o.created_at DESC";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        if ($status_filter) {
            $stmt->bindParam(':status', $status_filter);
        }
        $stmt->execute();
        
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode(["success" => true, "orders" => $orders]);
        break;

    case 'POST':
        // Place Order - Check if item already exists in cart, update quantity if exists
        $data = getJsonInput();
        
        if (!empty($data->item_id) && !empty($data->total_price)) {
            $user_id = isset($data->user_id) ? $data->user_id : 1; // Default to user 1
            $qty = isset($data->quantity) ? $data->quantity : 1;
            
            // Check if item already exists in pending orders
            $checkQuery = "SELECT id, quantity, total_price FROM orders 
                          WHERE user_id = :user_id AND item_id = :item_id AND status = 'pending'";
            $checkStmt = $db->prepare($checkQuery);
            $checkStmt->bindParam(':user_id', $user_id);
            $checkStmt->bindParam(':item_id', $data->item_id);
            $checkStmt->execute();
            $existingOrder = $checkStmt->fetch(PDO::FETCH_ASSOC);
            
            if ($existingOrder) {
                // Update existing order quantity
                $newQuantity = $existingOrder['quantity'] + $qty;
                $newTotalPrice = $existingOrder['total_price'] + $data->total_price;
                
                $updateQuery = "UPDATE orders SET quantity = :quantity, total_price = :total_price WHERE id = :id";
                $updateStmt = $db->prepare($updateQuery);
                $updateStmt->bindParam(':quantity', $newQuantity);
                $updateStmt->bindParam(':total_price', $newTotalPrice);
                $updateStmt->bindParam(':id', $existingOrder['id']);
                
                if ($updateStmt->execute()) {
                    echo json_encode(["success" => true, "message" => "Jumlah pesanan diperbarui.", "order_id" => $existingOrder['id']]);
                } else {
                    http_response_code(503);
                    echo json_encode(["success" => false, "message" => "Gagal memperbarui pesanan."]);
                }
            } else {
                // Create new order
                $query = "INSERT INTO orders (user_id, item_id, quantity, total_price, status) 
                          VALUES (:user_id, :item_id, :quantity, :total_price, 'pending')";
                
                $stmt = $db->prepare($query);
                $stmt->bindParam(':user_id', $user_id);
                $stmt->bindParam(':item_id', $data->item_id);
                $stmt->bindParam(':quantity', $qty);
                $stmt->bindParam(':total_price', $data->total_price);
                
                if ($stmt->execute()) {
                    echo json_encode(["success" => true, "message" => "Pesanan berhasil dibuat.", "order_id" => $db->lastInsertId()]);
                } else {
                    http_response_code(503);
                    echo json_encode(["success" => false, "message" => "Gagal membuat pesanan."]);
                }
            }
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
        }
        break;

    case 'PUT':
        // Update Order Status (e.g. Pay) or Quantity
        $data = getJsonInput();
        
        if (!empty($data->id)) {
            if (!empty($data->status)) {
                // Update status
                $query = "UPDATE orders SET status = :status WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':status', $data->status);
                $stmt->bindParam(':id', $data->id);
            } elseif (isset($data->quantity) && isset($data->total_price)) {
                // Update quantity and total price
                $query = "UPDATE orders SET quantity = :quantity, total_price = :total_price WHERE id = :id AND status = 'pending'";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':quantity', $data->quantity);
                $stmt->bindParam(':total_price', $data->total_price);
                $stmt->bindParam(':id', $data->id);
            } else {
                http_response_code(400);
                echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
                break;
            }
            
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Pesanan diperbarui."]);
            } else {
                http_response_code(503);
                echo json_encode(["success" => false, "message" => "Gagal memperbarui pesanan."]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Data tidak lengkap."]);
        }
        break;

    case 'DELETE':
        // Cancel Order
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if ($id) {
            $query = "UPDATE orders SET status = 'cancelled' WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                echo json_encode(["success" => true, "message" => "Pesanan dibatalkan."]);
            } else {
                echo json_encode(["success" => false, "message" => "Gagal membatalkan pesanan."]);
            }
        } else {
             http_response_code(400);
             echo json_encode(["success" => false, "message" => "ID pesanan tidak ditemukan."]);
        }
        break;
}
?>
