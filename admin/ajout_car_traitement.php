<?php
include_once("../database/database.php");
include_once("../controllers/controllers.php");

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $brand = $_POST['brand'] ?? null;
    $carYear = $_POST['carYear'] ?? null;
    $transmissionType = $_POST['transmissionType'] ?? null;
    $color = $_POST['color'] ?? null;
    $price_per_day = $_POST['price_per_day'] ?? null;
    $documents = $_FILES['documents'] ?? null;
    $modele = $_POST['modele'] ?? null;
    $fuelType = $_POST['fuelType'] ?? null;
    $availableSeats = $_POST['availableSeats'] ?? null;
    $mileage = $_POST['mileage'] ?? null;
    $insurance_expiration = $_POST['insurance_expiration'] ?? null;
    $notes = $_POST['notes'] ?? null;
    $photos = $_FILES['photos'] ?? null;
    $id = generateUuid4();
    $immatriculation = generateLicensePlate();
    $added_by = $_SESSION['user_id'] ?? null;

    // Validation des champs requis
    if (empty($brand) || empty($carYear) || empty($transmissionType) || empty($color) || empty($price_per_day) || empty($modele) || empty($fuelType) || empty($availableSeats) || empty($mileage) || empty($insurance_expiration) || empty($notes)) {
        $erreur_champ = "Tous les champs requis doivent être remplis.";
    }

    // Vérification des documents si téléchargés
    if ($documents && $documents['error'][0] == UPLOAD_ERR_OK) {
        $allowedDocumentTypes = ['application/pdf', 'application/msword', 'application/vnd.ms-excel'];
        foreach ($documents['type'] as $type) {
            if (!in_array($type, $allowedDocumentTypes)) {
                $erreur .= "Type de document non autorisé. ";
            }
        }
    }

    // Vérification des photos si téléchargées
    if ($photos && $photos['error'][0] == UPLOAD_ERR_OK) {
        if (count($photos['name']) > 4) {
            $erreur .= "Vous ne pouvez télécharger que 4 photos. ";
        }

        foreach ($photos['type'] as $type) {
            if (!in_array($type, ['image/jpeg', 'image/png'])) {
                $erreur .= "Type de photo non autorisé. ";
            }
        }
    }

    // Enregistrer les fichiers si pas d'erreur
    if (empty($erreur) && empty($erreur_champ)) {
        // Enregistrement des documents
        $documentPaths = [];
        if ($documents && $documents['error'][0] == UPLOAD_ERR_OK) {
            foreach ($documents['tmp_name'] as $key => $tmp_name) {
                $fileName = basename($documents['name'][$key]);
                $targetFile = "../documents/" . $fileName;
                if (move_uploaded_file($tmp_name, $targetFile)) {
                    $documentPaths[] = $fileName;
                } else {
                    $erreur .= "Erreur lors du téléchargement du document $fileName. ";
                }
            }
        }

        // Enregistrement des photos
        $photoPaths = [];
        if ($photos && $photos['error'][0] == UPLOAD_ERR_OK) {
            foreach ($photos['tmp_name'] as $key => $tmp_name) {
                $fileName = basename($photos['name'][$key]);
                $targetFile = "../upload/" . $fileName;
                if (move_uploaded_file($tmp_name, $targetFile)) {
                    $photoPaths[] = $fileName;
                } else {
                    $erreur .= "Erreur lors du téléchargement de la photo $fileName. ";
                }
            }
        }

        // Insertion dans la base de données avec PDO et bindValue
        if (empty($erreur)) {
            $documentPathsStr = implode(',', $documentPaths);
            $photoPathsStr = implode(',', $photoPaths);

            try {
                $stmt = $pdo->prepare("INSERT INTO cars (id, registration_number, brand_id, model, year, fuel_type, transmission, color, seats, mileage, price_per_day, availability_status, insurance_expiration, documents, notes, created_at, added_by, is_deleted, image) VALUES (:id, :registration_number, :brand_id, :model, :year, :fuel_type, :transmission, :color, :seats, :mileage, :price_per_day, :availability_status, :insurance_expiration, :documents, :notes, :created_at, :added_by, :is_deleted, :image)");
                // Lier les valeurs avec bindValue
                $stmt->bindValue(':id', $id);
                $stmt->bindValue(':registration_number', $immatriculation);
                $stmt->bindValue(':brand_id', $brand);
                $stmt->bindValue(':model', $modele);
                $stmt->bindValue(':year', $carYear, PDO::PARAM_INT);
                $stmt->bindValue(':fuel_type', $fuelType);
                $stmt->bindValue(':transmission', $transmissionType);
                $stmt->bindValue(':color', $color);
                $stmt->bindValue(':seats', $availableSeats, PDO::PARAM_INT);
                $stmt->bindValue(':mileage', $mileage, PDO::PARAM_INT);
                $stmt->bindValue(':price_per_day', $price_per_day, PDO::PARAM_STR);
                $stmt->bindValue(':availability_status', 'Disponible');
                $stmt->bindValue(':insurance_expiration', $insurance_expiration);
                $stmt->bindValue(':documents', $documentPathsStr);
                $stmt->bindValue(':notes', $notes);
                $stmt->bindValue(':created_at', date('Y-m-d H:i:s'));
                $stmt->bindValue(':added_by', $added_by);
                $stmt->bindValue(':is_deleted', 0, PDO::PARAM_INT);
                $stmt->bindValue(':image', $photoPathsStr);

                if ($stmt->execute()) {
                    $success = "Enregistrement réussi.";
                    echo "<script>setTimeout(function() { window.location.href = 'liste_car.php'; }, 2000);</script>";
                } else {
                    $erreur = "Erreur lors de l'enregistrement dans la base de données.";
                }
            } catch (PDOException $e) {
                $erreur = "Erreur de connexion ou d'exécution : " . $e->getMessage();
            }
        }
    }
}
?>
