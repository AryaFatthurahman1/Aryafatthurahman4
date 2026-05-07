<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

if (isset($_GET['user_id'])) {
    $query = "SELECT o.id, o.quantity, o.total_price, o.status, o.created_at, c.name, c.image_url, c.price as unit_price
              FROM orders o
              JOIN culinary_items c ON o.item_id = c.id
              WHERE o.user_id = :user_id
              ORDER BY o.created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":user_id", $_GET['user_id']);
    $stmt->execute();

    $orders = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $orders[] = $row;
    }

    echo json_encode($orders);
} else {
    http_response_code(400);
    echo json_encode(array("message" => "User ID required."));
}
?>