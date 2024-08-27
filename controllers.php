<?php
include("database/database.php");



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
        $stmt = $pdo->prepare("SELECT * FROM carbrands WHERE is_deleted = 0 ORDER BY created_at DESC");
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


?>





