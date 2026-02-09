<?php
$config = require_once __DIR__ . '/includes/config.php';
include 'includes/jwt-handler.php';
include 'includes/db.php';

$query = "SELECT DISTINCT offre.ville FROM offre";

$stmt = $database->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll();
echo json_encode($result);