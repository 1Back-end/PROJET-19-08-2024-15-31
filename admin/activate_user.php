<?php
include_once("../database/database.php");

session_start();

// Récupération de l'ID utilisateur depuis l'URL
$id_user = $_GET["id"] ?? null;

// Assurez-vous que l'utilisateur est connecté et récupérez son ID
$current_user_id = $_SESSION['user_id'] ?? null;

if (!$current_user_id) {
    // Redirection si l'utilisateur n'est pas connecté
    header("Location: ../login/login.php");
    exit();
}

// Fonction pour vérifier si l'utilisateur est autorisé
function is_authorized($pdo, $user_id) {
    // Vérifiez le rôle de l'utilisateur
    $stmt = $pdo->prepare("SELECT role FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    return $user && $user['role'] === 1; // Exemple: seul un admin peut supprimer les utilisateurs
}

if ($id_user && is_authorized($pdo, $current_user_id)) {
    try {
        // Préparez la requête SQL pour changer la valeur de is_deleted
        $query = "UPDATE users SET is_deleted = 1 WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_user);

        // Exécutez la requête
        if ($stmt->execute()) {
            // Si la mise à jour est réussie, redirigez avec un message de succès
            header("Location: liste_users.php?delete=success");
            exit();
        } else {
            // Si la mise à jour échoue, redirigez avec un message d'erreur
            header("Location: liste_users.php?delete=error");
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur PDO, redirigez avec un message d'erreur
        header("Location: liste_users.php?delete=error");
        exit();
    }
} else {
    // Si l'ID utilisateur est manquant ou si l'utilisateur n'est pas autorisé, redirigez avec un message d'erreur
    header("Location: liste_users.php?delete=error");
    exit();
}
?>
