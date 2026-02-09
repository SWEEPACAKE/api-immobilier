<?php
$config = require_once __DIR__ . '/includes/config.php';
include 'includes/db.php';

$condition = "WHERE 1 = ?";
$array_params = [1];
if(!empty($_GET)) {
    if(array_key_exists('type', $_GET) && isset($_GET['type'])) {
        $condition .= " AND id_type = ?";
        $array_params[] = $_GET['type'];
    }
    if(array_key_exists('localisation', $_GET) && isset($_GET['localisation'])) {
        $condition .= " AND ville = ?";
        $array_params[] = $_GET['ville'];
    }
    if(array_key_exists('budget', $_GET) && isset($_GET['budget'])) {
        $budget_min = (float) $_GET['budget'] * 0.95;
        $budget_max = (float) $_GET['budget'] * 1.05;
        $condition .= " AND budget BETWEEN ? AND ? ";
        $array_params[] = $budget_min;
        $array_params[] = $budget_max;
    }
}

$query = "SELECT * FROM offre $condition ORDER BY id DESC";

$stmt = $database->prepare($query);
$stmt->execute($array_params);
$result = $stmt->fetchAll();

var_dump($result);