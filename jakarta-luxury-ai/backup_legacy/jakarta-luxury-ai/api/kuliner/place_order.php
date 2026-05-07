<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->item_id) && !empty($data->quantity)) {
    // Get item price
    $query = "SELECT price FROM culinary_items WHERE id = :item_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":item_id", $data->item_id);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($item) {
        $total_price = $data->quantity * $item['price'];

        // Insert order
        $query = "INSERT INTO orders (user_id, item_id, quantity, total_price, status) VALUES (:user_id, :item_id, :quantity, :total_price, 'pending')";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":user_id", $data->user_id);
        $stmt->bindParam(":item_id", $data->item_id);
        $stmt->bindParam(":quantity", $data->quantity);
        $stmt->bindParam(":total_price", $total_price);

        if ($stmt->execute()) {
            http_response_code(201);
            echo json_encode(array("message" => "Order placed successfully.", "order_id" => $db->lastInsertId()));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to place order."));
        }
    } else {
        http_response_code(404);
        echo json_encode(array("message" => "Item not found."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Incomplete data."));
}
?>