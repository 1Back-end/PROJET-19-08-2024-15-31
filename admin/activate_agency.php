<?php
include_once("../database/database.php");

// Récupération de l'ID de l'agence depuis l'URL
$id_agency = $_GET["id"] ?? null;

// Assurez-vous que l'utilisateur est connecté et récupérez son ID
session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    // Redirection si l'utilisateur n'est pas connecté
    header("Location: ../login/login.php");
    exit();
}

// Fonction pour vérifier si l'utilisateur est autorisé
function is_authorized($pdo, $user_id) {
    // Exemple de vérification pour un utilisateur spécifique (admin)
    // Remplacez par votre logique d'autorisation
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user && $user['role'] === 1; // Exemple: seul un admin peut activer les agences
}

if ($id_agency && is_authorized($pdo, $user_id)) {
    try {
        // Préparez la requête SQL pour mettre à jour le champ is_active
        $query = "UPDATE agencies SET is_active = 1 WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_agency);

        // Exécutez la requête
        if ($stmt->execute()) {
            // Redirigez avec un message de succès
            header("Location: liste_agencies.php?message=success&content=" . urlencode("L'agence a été activée avec succès."));
            exit();
        } else {
            // Redirigez avec un message d'erreur
            header("Location: liste_agencies.php?message=error&content=" . urlencode("Erreur lors de l'activation de l'agence."));
            exit();
        }
    } catch (PDOException $e) {
        // Redirigez avec un message d'erreur en cas d'exception
        header("Location: liste_agencies.php?message=error&content=" . urlencode("Erreur de connexion à la base de données : " . $e->getMessage()));
        exit();
    }
} else {
    // Redirigez avec un message d'erreur si l'ID est manquant ou si l'utilisateur n'est pas autorisé
    header("Location: liste_agencies.php?message=error&content=" . urlencode("ID agence manquant ou utilisateur non autorisé."));
    exit();
}
?>
