<?php
include_once("../database/database.php");

function get_all_owners($pdo, $limit = 10, $offset = 0) {
    // Préparation de la requête SQL pour récupérer les propriétaires non supprimés avec pagination
    $query = "SELECT * FROM owners WHERE is_deleted = 0 ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Retourne les résultats sous forme de tableau associatif
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_total_owners_count($pdo) {
    $query = "SELECT COUNT(*) FROM owners WHERE is_deleted = 0";
    $stmt = $pdo->query($query);
    return $stmt->fetchColumn();
}

function get_name_owners($pdo) {
    $query = "SELECT id, name FROM owners WHERE is_deleted = 0";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$name_owners = get_name_owners($pdo);

function get_agencies($pdo, $limit, $offset) {
    $query = "
        SELECT a.id, a.logo,a.name,a.country, a.agency_code, a.email, a.created_at, a.is_active, o.name as owner_name
        FROM agencies a
        JOIN owners o ON a.owner_id = o.id
        WHERE a.is_deleted = 0
        ORDER BY a.created_at DESC
        LIMIT :limit OFFSET :offset
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_total_agencies_count($pdo) {
    $query = "SELECT COUNT(*) FROM agencies WHERE is_deleted = 0";
    $stmt = $pdo->query($query);
    return $stmt->fetchColumn();
}

function getSubscriptionTypesOptions($pdo){
    $query = "SELECT id, name FROM subscription_types WHERE is_active = 1";
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$subscriptionTypes = getSubscriptionTypesOptions($pdo);

function getAgenciesOptions($pdo) {
    // Préparer la requête SQL pour récupérer les IDs et les noms des agences
    $query = "SELECT id, name FROM agencies WHERE is_deleted = 0";
    try {
        // Exécuter la requête
        $stmt = $pdo->query($query);
        // Récupérer toutes les lignes en tant que tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Gérer les erreurs de connexion à la base de données
        echo "Erreur lors de la récupération des agences : " . $e->getMessage();
        return [];
    }
}
$agencies = getAgenciesOptions($pdo);

function generateAgencyCode($prefix = 'AGC') {
    // Obtenir la date actuelle au format YYYYMMDD
    $date = date('Ymd');
    // Générer un identifiant unique basé sur l'horodatage actuel
    $uniqueId = uniqid($prefix, true);
    // Extraire les derniers caractères de l'identifiant unique pour ajouter de la variabilité
    $shortUniqueId = substr($uniqueId, -6);
    // Combiner la date avec l'identifiant unique pour former le code final
    $code = $prefix . '-' . $date . '-' . $shortUniqueId;
    return $code;
}


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


function generateReservationNumber($prefix = 'RES', $length = 6) {
    // Générer une partie aléatoire
    $randomPart = strtoupper(substr(md5(uniqid(rand(), true)), 0, $length));
    
    // Inclure une partie temporelle pour éviter les collisions
    $timestampPart = date('YmdHis');

    // Combiner le préfixe, la partie temporelle, et la partie aléatoire
    $reservationNumber = $prefix . '-' . $timestampPart . '-' . $randomPart;

    return $reservationNumber;
}
// Exemple d'utilisation
$reservationNumber = generateReservationNumber();

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

function generateNumericPassword($length = 6) {
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

function get_count_car($pdo){
    try {
        // Préparation de la requête SQL pour récupérer le nombre de voitures par marque
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM reservations where is_deleted=0");
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        return $results['count'];
        
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération du nombre de voitures par marque : " . $e->getMessage();
        return false;
    } 
}

// Appeler la fonction pour récupérer le nombre de voitures par marque
$countCar = get_count_car($pdo);




function afficherReservations($pdo) {
    try {
        // Préparer la requête SQL pour récupérer les réservations avec l'immatriculation du véhicule
        $sql = "
            SELECT 
                reservations.*,
                cars.registration_number,
                cars.price_per_day,
                (reservations.number_of_days * cars.price_per_day) AS total_cost
            FROM 
                reservations
            INNER JOIN 
                cars 
            ON 
                reservations.id_car = cars.id WHERE 
                reservations.is_deleted = 0 ORDER BY
                reservations.created_at DESC;
        ";

        // Exécuter la requête
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        // Récupérer les résultats
        $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $reservations ?: []; // Retourne un tableau vide si aucun résultat n'est trouvé
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération des réservations: " . $e->getMessage();
        return false;
    }
}

// Appeler la fonction pour afficher les réservations

$reservations = afficherReservations($pdo);


function getTotalClients($pdo) {
    try {
        // Préparer la requête pour compter les clients uniques par email
        $stmt = $pdo->prepare("SELECT COUNT(DISTINCT email) AS total_clients FROM reservations");
        
        // Exécuter la requête
        $stmt->execute();
        
        // Récupérer le résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Retourner le nombre total de clients
        return $result['total_clients'];
    } catch (PDOException $e) {
        // En cas d'erreur, retourner 0 ou un message d'erreur
        return 0;  // Ou bien: return "Erreur : " . $e->getMessage();
    }
}

// Exemple d'utilisation de la fonction
$total_clients = getTotalClients($pdo);

?>





