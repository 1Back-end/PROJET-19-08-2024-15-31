<?php
include_once("../database/database.php");

$id_owner = $_SESSION['owner_id'] ?? null;

// Fonction pour récupérer l'ID de l'agence en fonction de l'ID du propriétaire
function get_agency_id_by_owner($pdo, $id_owner) {
    $stmt = $pdo->prepare("SELECT id FROM agencies WHERE owner_id = :id_owner AND is_deleted = 0 LIMIT 1");
    $stmt->execute(['id_owner' => $id_owner]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['id'] ?? null;
}
$agency_id = get_agency_id_by_owner($pdo, $id_owner);



// Fonction pour récupérer les informations de l'agence en fonction de l'ID du propriétaire
function get_information_by_owner($pdo, $owner_id) {
    $stmt = $pdo->prepare("SELECT * FROM agencies WHERE owner_id = :owner_id AND is_deleted = 0 LIMIT 1");
    $stmt->execute(['owner_id' => $owner_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// $agency_id = $agency_info['id'] ?? null;
// Fonction pour récupérer les informations du propriétaire en fonction de l'ID




// Fonction pour récupérer les voitures d'un propriétaire avec la pagination
function get_car_by_owner_id($pdo,$agency_id, $owner_id, $currentPage = 1, $itemsPerPage = 10) {
    $stmt = $pdo->prepare("
        SELECT cars.*, carbrands.name AS brand_name 
        FROM cars 
        LEFT JOIN carbrands ON cars.brand_id = carbrands.id
        WHERE cars.is_deleted = 0 AND cars.added_by = :owner_id  AND cars.agency_id = :agency_id ORDER BY created_at DESC
        LIMIT :offset, :itemsPerPage
    ");
    $stmt->bindValue(':owner_id', $owner_id, PDO::PARAM_INT);
    $stmt->bindValue(':agency_id', $agency_id, PDO::PARAM_INT);
    $stmt->bindValue(':offset', ($currentPage - 1) * $itemsPerPage, PDO::PARAM_INT);
    $stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fonction pour récupérer le nombre total de voitures d'un propriétaire
function get_total_cars_count($pdo,$agency_id,$id_owner) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cars WHERE is_deleted = 0 AND added_by = :owner_id AND agency_id = :agency_id");
    $stmt->execute([
        'owner_id' => $id_owner,
        'agency_id' => $agency_id
    ]);
    return $stmt->fetchColumn();
}



function get_models_car_by_owner_id($pdo, $id_owner, $agency_id) {
    $stmt = $pdo->prepare("SELECT models_car.*, carbrands.name AS brand_name
        FROM models_car
        LEFT JOIN carbrands ON models_car.cardbrands_id = carbrands.id
        WHERE models_car.is_deleted = 0
        AND models_car.added_by = :id_owner
        AND models_car.agency_id = :agency_id
        ORDER BY models_car.created_at DESC");
    
    $stmt->bindValue(':id_owner', $id_owner, PDO::PARAM_STR);
    $stmt->bindValue(':agency_id', $agency_id, PDO::PARAM_STR);
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Utilisation de la fonction
$model_car = get_models_car_by_owner_id($pdo, $id_owner, $agency_id);




function get_count_carbrands_by_owner_id($pdo,$id_owner,$agency_id){
    try {
        // Préparer la requête avec les deux paramètres
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM carbrands WHERE is_deleted = 0 AND added_by = :owner_id AND agency_id = :agency_id");
        $stmt->execute([
            'owner_id' => $id_owner,
            'agency_id' => $agency_id
        ]);
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération du nombre de marques : " . $e->getMessage();
        return 0;
    };
}
$count_cardbrand=get_count_carbrands_by_owner_id($pdo,$id_owner,$agency_id);




function get_count_model_by_owner_id($pdo,$id_owner,$agency_id){
    try {
        // Préparer la requête avec les deux paramètres
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM carbrands WHERE is_deleted = 0 AND added_by = :owner_id AND agency_id = :agency_id");
        $stmt->execute([
            'owner_id' => $id_owner,
            'agency_id' => $agency_id
        ]);
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération du nombre de marques : " . $e->getMessage();
        return 0;
    };
}
$count_models_car=get_count_carbrands_by_owner_id($pdo,$id_owner,$agency_id);




function get_count_car_by_owner_id($pdo,$id_owner,$agency_id){
    try {
        // Préparer la requête avec les deux paramètres
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM cars WHERE is_deleted = 0 AND added_by = :owner_id AND agency_id = :agency_id");
        $stmt->execute([
            'owner_id' => $id_owner,
            'agency_id' => $agency_id
        ]);
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération du nombre de marques : " . $e->getMessage();
        return 0;
    };
}
$count_car = get_count_car_by_owner_id($pdo,$id_owner,$agency_id);



function getActiveCarBrands($pdo, $agency_id, $owner_id, $currentPage = 1, $itemsPerPage = 10) {
    try {
        // Calcul de l'offset
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Préparer la requête SQL avec la pagination
        $stmt = $pdo->prepare("
            SELECT * FROM carbrands
            WHERE is_deleted = 0 
            AND added_by = :owner_id
            AND agency_id = :agency_id
            ORDER BY created_at DESC
            LIMIT :offset, :itemsPerPage
        ");
        $stmt->bindValue(':owner_id', $owner_id, PDO::PARAM_STR); // Utiliser PARAM_STR pour VARCHAR
        $stmt->bindValue(':agency_id', $agency_id, PDO::PARAM_STR); // Utiliser PARAM_STR pour VARCHAR
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
        
        // Exécuter la requête
        $stmt->execute();

        // Récupérer les résultats
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Gestion des erreurs
        echo "Erreur lors de la récupération des marques de voitures : " . $e->getMessage();
        return false;
    }
}


// Fonction pour obtenir le nombre total de marques de voitures pour la pagination
function getTotalCarBrandsCount($pdo, $owner_id, $agency_id) {
    try {
        // Préparer la requête avec les deux paramètres
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM carbrands WHERE is_deleted = 0 AND added_by = :owner_id AND agency_id = :agency_id");
        $stmt->execute([
            'owner_id' => $owner_id,
            'agency_id' => $agency_id
        ]);
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération du nombre de marques : " . $e->getMessage();
        return 0;
    }
}
// Paramètres de pagination
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, $currentPage);

// Appeler la fonction pour récupérer les marques de voitures actives
$carBrands = getActiveCarBrands($pdo, $agency_id, $id_owner, $currentPage, $itemsPerPage);

// Appeler la fonction pour obtenir le nombre total de marques
$totalBrandsCount = getTotalCarBrandsCount($pdo, $id_owner, $agency_id);
$totalPages = ceil($totalBrandsCount / $itemsPerPage);





function get_model_car_by_owner_id($pdo, $agency_id, $id_owner){
    $stmt = $pdo->prepare("SELECT id,name FROM models_car WHERE is_deleted = 0 AND added_by = :owner_id AND agency_id = :agency_id ORDER BY name ASC");
    $stmt->bindValue(':owner_id', $id_owner, PDO::PARAM_STR); // Utiliser PARAM_STR pour VARCHAR
    $stmt->bindValue(':agency_id', $agency_id, PDO::PARAM_STR); // Utiliser PARAM_STR pour VARCHAR
    // Exécuter la requête
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}
$models_car=get_model_car_by_owner_id($pdo, $agency_id, $id_owner);

function afficherReservations($pdo, $owner_id, $currentPage = 1, $itemsPerPage = 10) {
    try {
        // Calcul de l'offset pour la pagination
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Préparer la requête SQL pour récupérer les réservations avec pagination
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
                reservations.id_car = cars.id
            WHERE 
                reservations.is_deleted = 0
                AND cars.added_by = :owner_id
            ORDER BY 
                reservations.created_at DESC
            LIMIT :offset, :itemsPerPage
        ";

        // Exécuter la requête
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':owner_id', $owner_id, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
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



// Fonction pour obtenir le nombre total de réservations pour la pagination
function getTotalReservationsCount($pdo, $owner_id) {
    try {
        $stmt = $pdo->prepare("
            SELECT COUNT(*) 
            FROM reservations
            INNER JOIN cars ON reservations.id_car = cars.id
            WHERE reservations.is_deleted = 0 AND cars.added_by = :owner_id
        ");
        $stmt->execute(['owner_id' => $owner_id]);
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération du nombre de réservations : " . $e->getMessage();
        return 0;
    }
}

// Paramètres de pagination
$itemsPerPage = 10;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, $currentPage);

// Appeler la fonction pour récupérer les réservations pour le propriétaire
$reservations = afficherReservations($pdo, $id_owner, $currentPage, $itemsPerPage);

// Appeler la fonction pour obtenir le nombre total de réservations
$totalReservationsCount = getTotalReservationsCount($pdo, $id_owner);
$totalPages = ceil($totalReservationsCount / $itemsPerPage);


// Exemple d'utilisation
$cars = get_car_by_owner_id($pdo,$agency_id,$id_owner);
$totalCarsCount = get_total_cars_count($pdo,$agency_id,$id_owner);
?>
