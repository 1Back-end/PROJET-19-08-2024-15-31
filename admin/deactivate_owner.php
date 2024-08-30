<?php
include_once("../database/database.php");

// Récupération de l'ID propriétaire depuis l'URL
$id_owner = $_GET["id"] ?? null;

if ($id_owner) {
    try {
        // Préparez la requête SQL pour mettre à jour le champ status
        $query = "UPDATE owners SET status = 'inactive' WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_owner);

        // Exécutez la requête
        if ($stmt->execute()) {
            // Redirigez avec un message de succès
            header("Location: liste_owners.php?message=success&content=Le propriétaire a été désactivé avec succès.");
            exit();
        } else {
            // Redirigez avec un message d'erreur
            header("Location: liste_owners.php?message=error&content=Erreur lors de la désactivation du propriétaire.");
            exit();
        }
    } catch (PDOException $e) {
        // Redirigez avec un message d'erreur en cas d'exception
        header("Location: liste_owners.php?message=error&content=" . urlencode("Erreur de connexion à la base de données : " . $e->getMessage()));
        exit();
    }
} else {
    // Redirigez avec un message d'erreur si l'ID est manquant
    header("Location: liste_owners.php?message=error&content=ID propriétaire manquant.");
    exit();
}
?>
