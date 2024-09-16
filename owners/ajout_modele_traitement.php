<?php
include_once("../database/database.php");
include_once("../controllers/controllers.php");
include_once("controllers_owners.php");

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Si le champ est vide, définissez une valeur par défaut "lorem"
    $modele = $_POST["modele"] ?? "lorem";
    $id_marque = $_POST["id_marque"] ?? "lorem";
    $description = $_POST["description"] ?? "lorem";
    
    $id = generateUuid4();
    $owner_id = $_SESSION['owner_id'] ?? null;
    $agency_id = get_agency_id_by_owner($pdo, $owner_id);

    // Vérifier que les champs nécessaires sont fournis
    if (!$modele || !$id_marque) {
        $erreur_champ = "Ce champ est requis !";
    } else {
        $stmt = $pdo->prepare("INSERT INTO models_car(id, name, cardbrands_id, added_by, agency_id) VALUES (:id, :name, :cardbrands_id, :added_by, :agency_id)");
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $modele);
        $stmt->bindParam(":cardbrands_id", $id_marque);
        $stmt->bindParam(":added_by", $owner_id);
        $stmt->bindParam(":agency_id", $agency_id);
        
        if ($stmt->execute()) {
            $success = "Modèle de voiture enregistré avec succès";
        } else {
            $erreur = "Erreur lors de l'ajout du modèle.";
        }
    }
}
?>