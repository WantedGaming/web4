<?php
/**
 * Database configuration file
 */

// Database connection parameters
$config = [
    'host'     => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'l1j_remastered',
    'charset'  => 'utf8mb4',
    'port'     => 3306,
];

/**
 * Get database connection
 * 
 * @return PDO Database connection
 */
function getDbConnection() {
    global $config;
    
    try {
        $dsn = "mysql:host={$config['host']};dbname={$config['database']};charset={$config['charset']};port={$config['port']}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        return new PDO($dsn, $config['username'], $config['password'], $options);
    } catch (PDOException $e) {
        // Log error and display friendly message
        error_log("Database connection error: " . $e->getMessage());
        die("Sorry, there was a problem connecting to the database. Please try again later.");
    }
}
