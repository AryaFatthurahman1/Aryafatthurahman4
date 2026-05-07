<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../konfigurasi/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Get all destinations or specific one
        if (isset($_GET['id'])) {
            $query = "SELECT * FROM travel_destinations WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":id", $_GET['id']);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                echo json_encode($row);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Destination not found."));
            }
        } else {
            $query = "SELECT * FROM travel_destinations";
            
            // Add filters
            if (isset($_GET['category'])) {
                $query .= " WHERE category = :category";
            }
            if (isset($_GET['featured'])) {
                $query .= (isset($_GET['category']) ? " AND" : " WHERE") . " featured = 1";
            }
            
            $query .= " ORDER BY rating DESC";
            
            $stmt = $db->prepare($query);
            
            if (isset($_GET['category'])) {
                $stmt->bindParam(":category", $_GET['category']);
            }
            
            $stmt->execute();
            
            $destinations_arr = array();
            $destinations_arr["records"] = array();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $destination_item = array(
                    "id" => $id,
                    "name" => $name,
                    "description" => $description,
                    "category" => $category,
                    "price_range" => $price_range,
                    "location" => $location,
                    "image_url" => $image_url,
                    "rating" => $rating,
                    "featured" => $featured
                );
                array_push($destinations_arr["records"], $destination_item);
            }
            
            echo json_encode($destinations_arr);
        }
        break;
        
    case 'POST':
        // Create new destination (admin only)
        $data = json_decode(file_get_contents("php://input"));
        
        if (!empty($data->name) && !empty($data->description)) {
            $query = "INSERT INTO travel_destinations (name, description, category, price_range, location, image_url, rating, featured) 
                      VALUES (:name, :description, :category, :price_range, :location, :image_url, :rating, :featured)";
            
            $stmt = $db->prepare($query);
            
            $stmt->bindParam(":name", $data->name);
            $stmt->bindParam(":description", $data->description);
            $stmt->bindParam(":category", $data->category);
            $stmt->bindParam(":price_range", $data->price_range);
            $stmt->bindParam(":location", $data->location);
            $stmt->bindParam(":image_url", $data->image_url);
            $stmt->bindParam(":rating", $data->rating);
            $stmt->bindParam(":featured", $data->featured);
            
            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode(array("message" => "Destination created successfully."));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Unable to create destination."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create destination. Data is incomplete."));
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed."));
        break;
}
?>
