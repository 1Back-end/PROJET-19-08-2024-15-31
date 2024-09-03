<?php
include_once("../database/database.php");

session_start();

// Récupération de l'ID du propriétaire depuis l'URL
$id_owner = $_GET["id"] ?? null;

// Assurez-vous que l'utilisateur est connecté et récupérez son ID
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

    return $user && $user['role'] === 1; // Exemple: seul un admin peut activer les propriétaires
}

if ($id_owner && is_authorized($pdo, $user_id)) {
    try {
        // Préparez la requête SQL pour mettre à jour le champ status
        $query = "UPDATE owners SET status = 'active' WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_owner);

        // Exécutez la requête
        if ($stmt->execute()) {
            // Redirigez avec un message de succès
            header("Location: liste_owners.php?message=success&content=" . urlencode("Le propriétaire a été activé avec succès."));
            exit();
        } else {
            // Redirigez avec un message d'erreur
            header("Location: liste_owners.php?message=error&content=" . urlencode("Erreur lors de l'activation du propriétaire."));
            exit();
        }
    } catch (PDOException $e) {
        // Redirigez avec un message d'erreur en cas d'exception
        header("Location: liste_owners.php?message=error&content=" . urlencode("Erreur de connexion à la base de données : " . $e->getMessage()));
        exit();
    }
} else {
    // Redirigez avec un message d'erreur si l'ID est manquant ou si l'utilisateur n'est pas autorisé
    header("Location: liste_owners.php?message=error&content=" . urlencode("ID propriétaire manquant ou utilisateur non autorisé."));
    exit();
}
?>
