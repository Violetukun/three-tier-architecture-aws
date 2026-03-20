<?php
// backend/db_connection.php

/**
 * Get database connection
 * * @return PDO
 */
function getDatabaseConnection() {
    // LOCALHOST SETTINGS - Change these to your AWS RDS endpoint when you deploy!
    $host = 'localhost';           
    $db_name = 'diagnostic_center'; // Updated from 'hello_world'
    $username = 'admin';             // Default XAMPP username
    $password = '';                 // Default XAMPP password
    
    $dsn = "mysql:host=$host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    return new PDO($dsn, $username, $password, $options);
}
?>
