<?php
include("database/database.php");

// Function to generate UUID4
function uuid4() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function getCarModels() {
    // Création d'un tableau avec des modèles de voitures
    $carModels = array(
        "Toyota Camry",
        "Honda Accord",
        "Ford Mustang",
        "Chevrolet Malibu",
        "BMW 3 Series",
        "Audi A4",
        "Mercedes-Benz C-Class",
        "Volkswagen Jetta",
        "Nissan Altima",
        "Subaru Impreza"
    );

    // Retourner le tableau des modèles
    return $carModels;
}

// Appeler la fonction pour récupérer les modèles de voitures
$carModels = getCarModels();



function getCarColors() {
    $carColors = array(
        "Blanc",
        "Noir",
        "Rouge",
        "Vert",
        "Bleu",
        "Jaune",
        "Gris",
        "Orange",
        "Violet",
        "Cyan"
    );

    return $carColors;
}

function getFuelTypes() {
    $fuelTypes = array(
        "Essence",
        "Diesel",
        "Électrique",
        "Hybride",
        "Hydrogène"
    );

    return $fuelTypes;
}

// Appeler la fonction pour récupérer les types de carburant
$fuelTypes = getFuelTypes();


function getTransmissionTypes() {
    $transmissionTypes = array(
        "Manuelle",
        "Automatique",
        "Semi-Automatique",
        "CVT"
    );

    return $transmissionTypes;
}
// Appeler la fonction pour récupérer les types de transmission
$transmissionTypes = getTransmissionTypes();


function getAvailableSeats() {
    // Création d'un tableau avec des nombres de sièges
    $seatsList = array(
        2,
        4,
        5,
        6,
        7,
        8,
        9
    );

    // Retourner le tableau des nombres de sièges
    return $seatsList;
}
// Exemple d'utilisation de la fonction
$seats = getAvailableSeats();

function getAvailableColors() {
    // Création d'un tableau avec des noms de couleurs
    $colorsList = array(
        "Rouge",
        "Bleu",
        "Vert",
        "Jaune",
        "Noir",
        "Blanc",
        "Gris",
        "Argent",
        "Or",
        "Rose"
    );

    // Retourner le tableau des couleurs
    return $colorsList;
}

// Exemple d'utilisation de la fonction
$colors = getAvailableColors();

function getAvailableMileages() {
    // Création d'un tableau avec des valeurs de kilométrage typiques
    $mileagesList = array(
        5000,     // 5,000 km
        10000,    // 10,000 km
        15000,    // 15,000 km
        20000,    // 20,000 km
        25000,    // 25,000 km
        30000,    // 30,000 km
        35000,    // 35,000 km
        40000     // 40,000 km
    );

    // Retourner le tableau des kilométrages
    return $mileagesList;
}
// Exemple d'utilisation de la fonction
$mileages = getAvailableMileages();

function getActiveCarBrands($pdo) {
    try {
        // Préparer la requête SQL
        $stmt = $pdo->prepare("SELECT * FROM carbrands WHERE is_deleted = 0 ORDER BY name ASC");
        // Exécuter la requête
        $stmt->execute();
        // Récupérer les résultats
        $carBrands = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $carBrands;
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération des marques de voitures : " . $e->getMessage();
        return false;
    }
}
// Appeler la fonction pour récupérer les marques de voitures actives
$carBrands = getActiveCarBrands($pdo);


function fetchAndDisplaySubscriptions($pdo) {
    // Préparer la requête pour récupérer les abonnements actifs
    $sql = "SELECT * FROM subscription_types WHERE is_active = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $subscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculer la durée pour chaque abonnement
    foreach ($subscriptions as &$subscription) {
        $start_date = new DateTime($subscription['start_date']);
        $end_date = new DateTime($subscription['end_date']);
        $interval = $start_date->diff($end_date);
        $subscription['duration_in_months'] = $interval->m + ($interval->y * 12); // Convertir années et mois en mois totaux
    }

    return $subscriptions;
}


// Appeler la fonction pour récupérer les abonnements actifs

$abonnements = fetchAndDisplaySubscriptions($pdo);

function get_all_agencies($pdo){
    try {
        // Préparer la requête SQL
        $stmt = $pdo->prepare("SELECT * FROM agencies WHERE is_deleted = 0 ORDER BY created_at ASC");
        // Exécuter la requête
        $stmt->execute();
        // Récupérer les résultats
        $agencies = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $agencies;
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération des agences : ". $e->getMessage();
        return false;
    }
}
// Appeler la fonction pour récupérer toutes les agences
$agencies = get_all_agencies($pdo);




?>





