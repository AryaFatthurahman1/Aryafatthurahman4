<?php
// Database setup script for Jakarta Luxury AI
// Run this file once to set up the database

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'jakarta_luxury_ai';

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if not exists
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $database");
    echo "Database '$database' created successfully.<br>";
    
    // Select the database
    $pdo->exec("USE $database");
    
    // Read and execute SQL file
    $sqlFile = __DIR__ . '/../api/database.sql';
    if (file_exists($sqlFile)) {
        $sql = file_get_contents($sqlFile);
        $pdo->exec($sql);
        echo "Database tables created successfully.<br>";
        echo "Sample data inserted successfully.<br>";
    } else {
        echo "Error: SQL file not found.<br>";
    }
    
    echo "<h3>Setup Complete!</h3>";
    echo "<p>Default admin credentials:</p>";
    echo "<ul>";
    echo "<li>Email: admin@jakartaluxury.ai</li>";
    echo "<li>Password: password</li>";
    echo "</ul>";
    echo "<p><a href='index.html'>Go to Jakarta Luxury AI</a></p>";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
