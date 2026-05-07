<?php
require_once 'api/konfigurasi/database.php';

try {
    $database = new Database();
    $db = $database->getConnection();

    // Modify the column to include 'flight' and 'hotel'
    $sql = "ALTER TABLE reservations MODIFY COLUMN type ENUM('travel', 'culinary', 'ai_design', 'flight', 'hotel') NOT NULL";
    
    $db->exec($sql);
    echo "Schema updated successfully: 'type' column now supports flight and hotel.";

} catch (PDOException $e) {
    echo "Error updating schema: " . $e->getMessage();
}
?>
