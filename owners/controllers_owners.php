<?php
include_once("../database/database.php");

$id_owner = $_SESSION['owner_id'] ?? null;

function get_information_by_owner($pdo, $owner_id) {
    // Requête pour récupérer les informations de l'agence en fonction de l'ID du propriétaire
    $stmt = $pdo->prepare("SELECT * FROM agencies WHERE owner_id = :owner_id AND is_deleted = 0 LIMIT 1");
    $stmt->execute(['owner_id' => $owner_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Récupérer les informations de l'agence, y compris le chemin du logo
$agency_info = get_information_by_owner($pdo, $id_owner);