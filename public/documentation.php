
<?php

$config = require_once __DIR__ . '/includes/config.php';
include 'includes/db.php';

$queryOffres = "SELECT offre.*, type.libelle 
FROM offre 
INNER JOIN type ON type.id = offre.id_type 
WHERE 1 = ? 
LIMIT 2";

$stmt = $database->prepare($queryOffres);
$stmt->execute(array(1));
$resultOffres = $stmt->fetchAll();


$queryArticles = "SELECT article.* FROM article LIMIT 2";

$stmt = $database->prepare($queryArticles);
$stmt->execute();
$resultArticles = $stmt->fetchAll();

$queryTypes = "SELECT type.* FROM type LIMIT 2";

$stmt = $database->prepare($queryTypes);
$stmt->execute();
$resultTypes = $stmt->fetchAll();

$queryVilles = "SELECT DISTINCT offre.ville FROM offre LIMIT 2";

$stmt = $database->prepare($queryVilles);
$stmt->execute();
$resultVilles = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mb-3">Documentation pour ce petit projet :)</h1>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        <div class="btn btn-small btn-primary d-inline-block" style="margin-right:25px;">GET</div>
                        <span>/jwt-login.php</span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Permet de récuperer un JWT au format JSON. À stocker en session dans votre projet front
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <div class="btn btn-small btn-primary d-inline-block" style="margin-right:25px;">GET</div>
                        <span>/offres.php</span>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Permet de récuperer un tableau d'offres au format JSON. <br>
                        Paramètres acceptés : 
                        <ul>
                            <li style="margin-bottom:10px;">
                                type <b>(string)</b> 
                                <br>Exemples : "bureaux", "F2", "Terrain"
                            </li>
                            <li style="margin-bottom:10px;">
                                localisation <b>(string)</b> 
                                <br>Exemples : "Montluçon", "Avermes", "Vichy"
                            </li>
                            <li style="margin-bottom:10px;">
                                budget <b>(int)</b> 
                                <br>Exemples : 450, 320000, 870. 
                                <br>Le budget sera assoupli à +/- 5% pour garantir des résultats
                            </li>
                            <li style="margin-bottom:10px;">
                                vente <b>(tinyint)</b> 
                                <br>Exemples : 0, 1 
                            </li>
                            <li style="margin-bottom:10px;">
                                location <b>(tinyint)</b> 
                                <br>Exemples : 0, 1 
                            </li>
                        </ul>
                        <h4>Résultat : </h4>
                        <pre>
                            <?php
                            print_r($resultOffres);
                            ?>
                        </pre>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <div class="btn btn-small btn-primary d-inline-block" style="margin-right:25px;">GET</div>
                        <span>/article.php?id={id_article}</span>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Permet de récuperer un article au format JSON. Renvoie une erreur 422 si le paramètre est manquant.
                        <br>
                        Paramètre obligatoire : 
                        <ul>
                            <li style="margin-bottom:10px;">
                                id <b>(int)</b> 
                                <br>Exemples : 1, 2
                            </li>
                        </ul>
                        <h4>Résultat</h4>
                        <pre>
                            <?php
                            print_r($resultArticles);
                            ?>
                        </pre>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <div class="btn btn-small btn-primary d-inline-block" style="margin-right:25px;">GET</div>
                        <span>/types.php</span>
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Permet de récuperer les types de bien au format JSON.
                        <br>
                        <h4>Résultat</h4>
                        <pre>
                            <?php
                            print_r($resultTypes);
                            ?>
                        </pre>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <div class="btn btn-small btn-primary d-inline-block" style="margin-right:25px;">GET</div>
                        <span>/villes.php</span>
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Permet de récuperer les différentes villes au format JSON. Le résultat sera dédoublonné.
                        <br>
                        <h4>Résultat</h4>
                        <pre>
                            <?php
                            print_r($resultVilles);
                            ?>
                        </pre>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <div class="btn btn-small btn-success d-inline-block" style="margin-right:25px;">POST</div>
                        <span>/contact.php</span>
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        Permet d'enregistrer en base les demandes de contact.
                        <br>
                        <h4>Format attendu</h4>
                        <pre>
                            <?php
                            print_r(array(
                                "nom" => "John",
                                "prenom" => "DOE",
                                "telephone" => "0612345678",
                                "email" => "john.doe@mail.dev",
                                "message" => "Lorem ipsum dolor sit amet, conspectetur adipiscing elit es"
                            ));
                            ?>
                        </pre>

                        <h4>Résultat positif</h4>
                        <pre>
                            <?php
                            print_r(array(
                                "error" => "false",
                                "message" => ""
                            ));
                            ?>
                        </pre>
                        <h4>Résultat négatif</h4>
                        <pre>
                            <?php
                            print_r(array(
                                "error" => "true",
                                "message" => "Message d'erreur"
                            ));
                            ?>
                        </pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>