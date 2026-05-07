<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->order_id)) {
    // Check if order exists and is pending
    $query = "SELECT status FROM orders WHERE id = :order_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":order_id", $data->order_id);
    $stmt->execute();
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($order && $order['status'] == 'pending') {
        // Update status to cancelled
        $query = "UPDATE orders SET status = 'cancelled' WHERE id = :order_id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(":order_id", $data->order_id);

        if ($stmt->execute()) {
            echo json_encode(array("message" => "Order cancelled successfully."));
        } else {
            http_response_code(500);
            echo json_encode(array("message" => "Unable to cancel order."));
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Order not found or cannot be cancelled."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Order ID required."));
}
?>