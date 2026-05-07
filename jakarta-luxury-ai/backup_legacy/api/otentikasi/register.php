<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

include_once '../konfigurasi/database.php';

$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"), true);

// Sanitize and validate inputs
$username = isset($data['username']) ? trim($data['username']) : '';
$email = isset($data['email']) ? trim($data['email']) : '';
$password = isset($data['password']) ? $data['password'] : '';
$full_name = isset($data['full_name']) ? trim($data['full_name']) : '';
$phone = isset($data['phone']) ? trim($data['phone']) : null;
$address = isset($data['address']) ? trim($data['address']) : '';

if (empty($username) || empty($email) || empty($password) || empty($full_name)) {
    http_response_code(400);
    echo json_encode(array("message" => "Username, email, password, and full name are required."));
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid email format."));
    exit();
}

if (strlen($password) < 8) {
    http_response_code(400);
    echo json_encode(array("message" => "Password must be at least 8 characters long."));
    exit();
}

if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
    http_response_code(400);
    echo json_encode(array("message" => "Username can only contain letters, numbers, and underscores."));
    exit();
}

try {
    // Check if user already exists
    $check_query = "SELECT id FROM users WHERE email = :email OR username = :username LIMIT 1";
    $check_stmt = $db->prepare($check_query);
    $check_stmt->bindParam(":email", $email);
    $check_stmt->bindParam(":username", $username);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        http_response_code(400);
        echo json_encode(array("message" => "User already exists."));
        exit();
    }

    // Hash password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password_hash, full_name, phone, address) VALUES (:username, :email, :password_hash, :full_name, :phone, :address)";

    $stmt = $db->prepare($query);

    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password_hash", $password_hash);
    $stmt->bindParam(":full_name", $full_name);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":address", $address); // Added address binding

    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(array(
            "message" => "User created successfully.",
            "user" => array(
                "id" => $db->lastInsertId(),
                "username" => $username,
                "email" => $email,
                "full_name" => $full_name,
                "role" => "user"
            )
        ));
    } else {
        http_response_code(500);
        echo json_encode(array("message" => "Unable to create user."));
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array("message" => "Database error: " . $e->getMessage()));
}
?>
