<?php
include_once("../database/database.php");

// Récupération de l'ID de l'agence depuis l'URL
$id_agency = $_GET["id"] ?? null;

if ($id_agency) {
    try {
        // Préparez la requête SQL pour marquer l'agence comme supprimée
        $query = "UPDATE agencies SET is_deleted = 1 WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_agency);

        // Exécutez la requête
        if ($stmt->execute()) {
            // Redirigez avec un message de succès
            header("Location: liste_agencies.php?message=success&content=" . urlencode("L'agence a été supprimée avec succès."));
            exit();
        } else {
            // Redirigez avec un message d'erreur
            header("Location: liste_agencies.php?message=error&content=" . urlencode("Erreur lors de la suppression de l'agence."));
            exit();
        }
    } catch (PDOException $e) {
        // Redirigez avec un message d'erreur en cas d'exception
        header("Location: liste_agencies.php?message=error&content=" . urlencode("Erreur de connexion à la base de données : " . $e->getMessage()));
        exit();
    }
} else {
    // Redirigez avec un message d'erreur si l'ID est manquant
    header("Location: liste_agencies.php?message=error&content=" . urlencode("ID agence manquant."));
    exit();
}
?>
