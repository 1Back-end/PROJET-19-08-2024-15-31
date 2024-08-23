<?php
include_once("../database/database.php");

// Récupération de l'ID de la voiture depuis l'URL
$id_car = $_GET["id"] ?? null;

// Connexion à la base de données
try {
    if ($id_car) {
        // Préparez la requête SQL pour changer la valeur de is_deleted
        $query = "UPDATE cars SET is_deleted = 1 WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_car);

        // Exécutez la requête
        if ($stmt->execute()) {
            // Si la mise à jour est réussie, redirigez avec un message de succès
            header("Location: liste_car.php?message=success");
            exit();
        } else {
            // Si la mise à jour échoue, redirigez avec un message d'erreur
            header("Location: liste_car.php?message=error");
            exit();
        }
    } else {
        // Si l'ID de la voiture n'est pas fourni, redirigez avec un message d'erreur
        header("Location: liste_car.php?message=error");
        exit();
    }
} catch (PDOException $e) {
    // En cas d'erreur PDO, redirigez avec un message d'erreur
    header("Location: liste_car.php?message=error");
    exit();
}
?>
