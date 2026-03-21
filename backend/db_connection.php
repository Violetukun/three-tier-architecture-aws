<?php
// 1. Load the "Ghost File" that the server created at boot
require_once 'db_credentials.php'; 

function getDatabaseConnection() {
    // 2. Pull those injected variables into our function
    global $DB_HOST, $DB_USER, $DB_PASS;
    
    // 3. The database name stays the same
    $db   = 'diagnostic_center';
    $charset = 'utf8mb4';

    // 4. Build the secure connection string dynamically
    $dsn = "mysql:host=$DB_HOST;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $DB_USER, $DB_PASS, $options);
    } catch (\PDOException $e) {
        // If it fails, print a clean error
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
