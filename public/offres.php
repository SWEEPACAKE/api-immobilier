<?php
$config = require_once __DIR__ . '/includes/config.php';
include 'includes/jwt-handler.php';
include 'includes/db.php';

$condition = "WHERE 1 = ?";
$array_params = [1];
if(!empty($_GET)) {
    if(array_key_exists('type', $_GET) && isset($_GET['type'])) {
        $condition .= " AND LOWER(type.libelle) = ?";
        $array_params[] = strtolower(urldecode($_GET['type']));
    }
    if(array_key_exists('localisation', $_GET) && isset($_GET['localisation'])) {
        $condition .= " AND ville = ?";
        $array_params[] = $_GET['localisation'];
    }
    if(array_key_exists('budget', $_GET) && isset($_GET['budget'])) {
        $budget_min = (float) $_GET['budget'] * 0.95;
        $budget_max = (float) $_GET['budget'] * 1.05;
        $condition .= " AND prix BETWEEN ? AND ? ";
        $array_params[] = $budget_min;
        $array_params[] = $budget_max;
    }
    if(array_key_exists('vente', $_GET) && isset($_GET['vente'])) {
        $condition .= " AND isAVendre = 1";
    }
    if(array_key_exists('location', $_GET) && isset($_GET['location'])) {
        $condition .= " AND isALouer = 1";
    }
}

$query = "SELECT offre.*, type.libelle 
FROM offre 
INNER JOIN type ON type.id = offre.id_type 
$condition 
ORDER BY id DESC";

$stmt = $database->prepare($query);
$stmt->execute($array_params);
$result = $stmt->fetchAll();
echo json_encode($result);