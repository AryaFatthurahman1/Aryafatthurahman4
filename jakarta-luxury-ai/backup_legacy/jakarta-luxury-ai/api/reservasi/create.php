<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->user_id) && !empty($data->type) && !empty($data->item_id) && !empty($data->reservation_date)) {
    
    $query = "INSERT INTO reservations (user_id, type, item_id, reservation_date, reservation_time, number_of_people, special_requests, total_price) 
              VALUES (:user_id, :type, :item_id, :reservation_date, :reservation_time, :number_of_people, :special_requests, :total_price)";
    
    $stmt = $db->prepare($query);
    
    $stmt->bindParam(":user_id", $data->user_id);
    $stmt->bindParam(":type", $data->type);
    $stmt->bindParam(":item_id", $data->item_id);
    $stmt->bindParam(":reservation_date", $data->reservation_date);
    $stmt->bindParam(":reservation_time", $data->reservation_time);
    $stmt->bindParam(":number_of_people", $data->number_of_people);
    $stmt->bindParam(":special_requests", $data->special_requests);
    $stmt->bindParam(":total_price", $data->total_price);
    
    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(array(
            "message" => "Reservation created successfully.",
            "reservation_id" => $db->lastInsertId()
        ));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Unable to create reservation."));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create reservation. Data is incomplete."));
}
?>
