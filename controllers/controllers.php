<?php
include_once("../database/database.php");



function generateUuid4() {
    $data = random_bytes(16);
    
    // Modifier les octets selon la spécification UUID4
    // Version 4 indique que les 13 premiers bits de la 7ème octet sont 0111
    // Ce qui équivaut à 0x40 en hexadécimal.
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Version 4
    // Les 2 premiers bits du 9ème octet doivent être 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Variante
    
    // Convertir les octets en format UUID
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


function generateLicensePlate($length = 10) {
    $characters = 'ABCWETPD0123456789';
    $plate = '';

    for ($i = 0; $i < $length; $i++) {
        $plate .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $plate;
}

function generatePassword($length = 12) {
    // Définir les caractères que vous souhaitez utiliser dans le mot de passe
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $special = '!@#$%&;';
    
    // Combiner tous les caractères possibles
    $characters = $upper . $lower . $numbers . $special;
    
    // Assurez-vous que le mot de passe est suffisamment long pour inclure tous les types de caractères
    if ($length < 4) {
        throw new InvalidArgumentException('La longueur du mot de passe doit être d\'au moins 4 caractères.');
    }
    
    // Utiliser random_int pour générer des caractères aléatoires
    $password = '';
    $charactersLength = strlen($characters);
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, $charactersLength - 1)];
    }
    
    return $password;
}

function generateNumericPassword($length = 4) {
    // Définir les chiffres possibles
    $numbers = '0123456789';
    
    // Vérifier que la longueur demandée est positive
    if ($length < 1) {
        throw new InvalidArgumentException('La longueur du mot de passe doit être d\'au moins 1 caractère.');
    }

    // Utiliser random_int pour générer des chiffres aléatoires
    $password = '';
    $numbersLength = strlen($numbers);
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $numbers[random_int(0, $numbersLength - 1)];
    }
    
    return $password;
}

function isValidEmail($email) {
    // Vérifier la validité de l'email avec filter_var
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function getCurrentYear() {
    return date('Y');
}

function getMonthsShort() {
    // Noms des mois en format abrégé
    return [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
    ];
}

function getFormattedPageName() {
    // Obtenir le chemin du script en cours
    $currentPage = $_SERVER['PHP_SELF'];
    
    // Extraire le nom du fichier à partir du chemin complet
    $fileName = basename($currentPage, '.php'); // Supprimer l'extension .php

    // Remplacer les tirets par des espaces ou un autre caractère, si nécessaire
    $formattedName = str_replace('-', ' ', $fileName);

    return $formattedName;
}

function getCurrentDateTime($format = 'Y-m-d') {
    // Obtenir la date et l'heure actuelles en utilisant le format spécifié
    return date($format);
}



function get_all_admin($pdo) {
    // Préparer la requête SQL pour récupérer les utilisateurs avec le rôle 1 et is_deleted = 0
    $query = "SELECT * FROM users WHERE role = '1' AND is_deleted = 0 ORDER BY created_at DESC";
    try {
        // Préparer la requête
        $stmt = $pdo->prepare($query);
        // Exécuter la requête
        $stmt->execute();
        // Récupérer les résultats
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Retourner les résultats
        return $result;
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération des administrateurs : " . $e->getMessage();
        return false;
    }
}
// Appeler la fonction pour récupérer les administrateurs
$admins = get_all_admin($pdo);


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

// Fonction pour générer une liste d'années
function getYears($startYear, $endYear) {
    $years = array();
    for ($year = $startYear; $year <= $endYear; $year++) {
        $years[] = $year;
    }
    return $years;
}

// Appeler la fonction pour générer une liste d'années
$years = getYears(1990, getCurrentYear());


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


function getActiveCars($pdo) {
    try {
        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT * FROM cars WHERE is_deleted = 0");
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $cars;
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération des voitures: " . $e->getMessage();
        return false;
    }
}
// Appeler la fonction pour récupérer les voitures actives
$cars = getActiveCars($pdo);


function get_count_users($pdo){
    try {
        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM users WHERE role = 1 AND is_deleted = 0");
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération du nombre d'utilisateurs : " . $e->getMessage();
        return false;
    }
}
// Appeler la fonction pour récupérer le nombre d'utilisateurs
$countUsers = get_count_users($pdo);


function get_count_marques($pdo){
    try {
        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM carbrands WHERE is_deleted = 0");
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération du nombre de marques : " . $e->getMessage();
        return false;
    }
}

// Appeler la fonction pour récupérer le nombre de marques
$countMarques = get_count_marques($pdo);


function get_count_voitures($pdo){
    try {
        // Préparation de la requête SQL
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM cars WHERE is_deleted = 0");
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération du nombre de voitures : " . $e->getMessage();
        return false;
    }
}

// Appeler la fonction pour récupérer le nombre de voitures
$countVoitures = get_count_voitures($pdo);

?>

<!DOCTYPE html>

?>





