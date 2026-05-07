<?php
/**
 * Database Configuration for Alfamart Mobile API
 * Supports MySQL with PDO for security and performance
 */

class Database {
    private $host = 'localhost';
    private $db_name = 'alfamart';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';
    
    public $conn;
    
    public function getConnection() {
        $this->conn = null;
        
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
            ];
            
            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch(PDOException $exception) {
            echo json_encode([
                'success' => false,
                'message' => 'Connection error: ' . $exception->getMessage()
            ]);
            exit();
        }
        
        return $this->conn;
    }
    
    /**
     * Get database configuration for different environments
     */
    public function getConfig($env = 'development') {
        $configs = [
            'development' => [
                'host' => 'localhost',
                'db_name' => 'alfamart',
                'username' => 'root',
                'password' => ''
            ],
            'production' => [
                'host' => $_ENV['DB_HOST'] ?? 'localhost',
                'db_name' => $_ENV['DB_NAME'] ?? 'alfamart',
                'username' => $_ENV['DB_USER'] ?? 'root',
                'password' => $_ENV['DB_PASS'] ?? ''
            ]
        ];
        
        return $configs[$env] ?? $configs['development'];
    }
}
?>
