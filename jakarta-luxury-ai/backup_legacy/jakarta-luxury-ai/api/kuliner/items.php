<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Get all culinary items or specific one
        if (isset($_GET['id'])) {
            $query = "SELECT * FROM culinary_items WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(":id", $_GET['id']);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                echo json_encode($row);
            } else {
                http_response_code(404);
                echo json_encode(array("message" => "Culinary item not found."));
            }
        } else {
            $query = "SELECT * FROM culinary_items";
            
            // Add filters
            if (isset($_GET['category'])) {
                $query .= " WHERE category = :category";
            }
            if (isset($_GET['featured'])) {
                $query .= (isset($_GET['category']) ? " AND" : " WHERE") . " featured = 1";
            }
            if (isset($_GET['restaurant'])) {
                $query .= (isset($_GET['category']) || isset($_GET['featured']) ? " AND" : " WHERE") . " restaurant_name LIKE :restaurant";
            }
            
            $query .= " ORDER BY rating DESC";
            
            $stmt = $db->prepare($query);
            
            if (isset($_GET['category'])) {
                $stmt->bindParam(":category", $_GET['category']);
            }
            if (isset($_GET['restaurant'])) {
                $restaurant = "%" . $_GET['restaurant'] . "%";
                $stmt->bindParam(":restaurant", $restaurant);
            }
            
            $stmt->execute();
            
            $culinary_arr = array();
            $culinary_arr["records"] = array();
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $culinary_item = array(
                    "id" => $id,
                    "name" => $name,
                    "description" => $description,
                    "category" => $category,
                    "price" => $price,
                    "restaurant_name" => $restaurant_name,
                    "location" => $location,
                    "image_url" => $image_url,
                    "rating" => $rating,
                    "featured" => $featured
                );
                array_push($culinary_arr["records"], $culinary_item);
            }
            
            echo json_encode($culinary_arr);
        }
        break;
        
    case 'POST':
        // Create new culinary item (admin only)
        $data = json_decode(file_get_contents("php://input"));
        
        if (!empty($data->name) && !empty($data->description)) {
            $query = "INSERT INTO culinary_items (name, description, category, price, restaurant_name, location, image_url, rating, featured) 
                      VALUES (:name, :description, :category, :price, :restaurant_name, :location, :image_url, :rating, :featured)";
            
            $stmt = $db->prepare($query);
            
            $stmt->bindParam(":name", $data->name);
            $stmt->bindParam(":description", $data->description);
            $stmt->bindParam(":category", $data->category);
            $stmt->bindParam(":price", $data->price);
            $stmt->bindParam(":restaurant_name", $data->restaurant_name);
            $stmt->bindParam(":location", $data->location);
            $stmt->bindParam(":image_url", $data->image_url);
            $stmt->bindParam(":rating", $data->rating);
            $stmt->bindParam(":featured", $data->featured);
            
            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode(array("message" => "Culinary item created successfully."));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Unable to create culinary item."));
            }
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create culinary item. Data is incomplete."));
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Method not allowed."));
        break;
}
?>
