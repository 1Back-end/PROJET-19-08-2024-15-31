<?php
include_once("../database/database.php");

// Récupération de l'ID utilisateur depuis l'URL
$id_marque = $_GET["id"] ?? null;

if ($id_marque) {
    try {
        // Préparez la requête SQL pour changer la valeur de is_active
        $query = "UPDATE carbrands SET is_deleted = 1 WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_marque);

        // Exécutez la requête
        if ($stmt->execute()) {
            // Si la mise à jour est réussie, redirigez avec un message de succès
            header("Location: liste_marques.php?message=success");
            exit();
        } else {
            // Si la mise à jour échoue, redirigez avec un message d'erreur
            header("Location: liste_marques.php?message=error");
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur PDO, redirigez avec un message d'erreur
        header("Location: liste_marques.php?message=error");
        exit();
    }
} else {
    // Si l'ID utilisateur n'est pas fourni, redirigez avec un message d'erreur
    header("Location: liste_marques.php?message=error");
    exit();
}
?>
