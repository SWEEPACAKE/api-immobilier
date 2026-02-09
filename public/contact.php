<?php
$config = require_once __DIR__ . '/includes/config.php';
include 'includes/jwt-handler.php';
include 'includes/db.php';

if(!empty($_POST)) {
    $query = "INSERT INTO contact (nom, prenom, telephone, email, message) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $database->prepare($query);
    $resultat = $stmt->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['email'],
        $_POST['message']
    ]);
    if($resultat) {
        echo json_encode(array("error" => false));
    } else {
        echo json_encode(array('error' => true, "message" => "L'insertion à échoué"));
    }

} else {
    echo json_encode(array('error' => true, "message" => "Pas de données en POST"));
}
