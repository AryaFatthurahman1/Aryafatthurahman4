<?php
require_once 'database.php';

try {
    $database = new Database();
    $db = $database->getConnection();

    // Check if column exists
    $check = $db->query("SHOW COLUMNS FROM users LIKE 'address'");
    if($check->rowCount() == 0) {
        $sql = "ALTER TABLE users ADD COLUMN address TEXT AFTER phone";
        $db->exec($sql);
        echo "Successfully added 'address' column to users table.";
    } else {
        echo "Column 'address' already exists.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
