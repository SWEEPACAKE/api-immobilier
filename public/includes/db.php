<?php

$config = require __DIR__ . '/config.php';

$host = $config['db']['host'];
$user = $config['db']['user'];
$pass = $config['db']['pass'];
$name = $config['db']['name'];

try {
    $database = new mysqli($host, $user, $pass, $name);
    mysqli_set_charset($database, "utf8mb4");
    if ($database->connect_error) {
        throw new Exception('Connection failed: ' . $database->connect_error);
    }
} catch (Exception $e) {
    die('Database error: ' . $e->getMessage());
}