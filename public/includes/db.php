<?php

$config = require __DIR__ . '/config.php';

$host = $config['db']['host'];
$user = $config['db']['user'];
$pass = $config['db']['pass'];
$name = $config['db']['name'];

try {
    $dsn = 'mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8mb4';
    $database = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (Exception $e) {
    die('Database error: ' . $e->getMessage());
}