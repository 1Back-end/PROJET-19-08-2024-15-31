<?php
include_once("../database/database.php");
include_once("../controllers/controllers.php");

// Initialisation des variables pour les messages d'erreur et de succès
$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // Récupération et validation des données du formulaire
    $subscription_type = $_POST['subscription_type'] ?? null;
    $start_date = $_POST['start_date'] ?? null;
    $end_date = $_POST['end_date'] ?? null;
    $agency = $_POST['agency'] ?? null;
    $comments = $_POST['comments'] ?? null;
    $id = generateUuid4(); // Fonction pour générer un UUID
    $added_by = $_SESSION['user_id'] ?? null;

    // Validation des champs (ajoutez d'autres validations selon les besoins)
    if (!$subscription_type || !$start_date || !$end_date || !$agency) {
        $erreur_champ = "Tous les champs obligatoires doivent être remplis.";
    } else {
        try {
            // Préparer la requête SQL pour insérer les données
            $query = "INSERT INTO subscriptions (id, agency_id, id_type, start_date, end_date, status, created_at, updated_at, is_deleted, added_by)
                      VALUES (:id, :agency_id, :id_type, :start_date, :end_date, 'inactive', NOW(), NOW(), 0, :added_by)";
            $stmt = $pdo->prepare($query);

            // Lier les paramètres à la requête SQL
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':agency_id', $agency);
            $stmt->bindParam(':id_type', $subscription_type);
            $stmt->bindParam(':start_date', $start_date);
            $stmt->bindParam(':end_date', $end_date);
            $stmt->bindParam(':added_by', $added_by);

            // Exécuter la requête
            if ($stmt->execute()) {
                // Si l'insertion est réussie, définir un message de succès
                $success = "Abonnement enregistré avec succès.";
            } else {
                // Si l'insertion échoue, définir un message d'erreur
                $erreur = "Erreur lors de l'enregistrement de l'abonnement.";
            }
        } catch (PDOException $e) {
            // En cas d'erreur PDO, définir un message d'erreur
            $erreur = "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
}
?>
