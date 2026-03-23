<?php

require_once 'db_credentials.php'; 

function getDatabaseConnection() {
    global $DB_HOST, $DB_USER, $DB_PASS;
    
    $db   = 'diagnostic_center';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$DB_HOST;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $DB_USER, $DB_PASS, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
