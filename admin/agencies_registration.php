<?php
include_once("../database/database.php");
include_once("../controllers/controllers.php");

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $owner_id = $_POST['owner_id'] ?? null;
    $email = $_POST['email'] ?? null;
    $ville = $_POST['ville'] ?? null;
    $adresse = $_POST['adresse'] ?? null;
    $name = $_POST['name'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $code_postal = $_POST['code_postal'] ?? null;
    $country = $_POST['country'] ?? null;
    $comments = $_POST['comments'] ?? null;
    $agency_code = generateAgencyCode();
    $id = generateUuid4();
    $logo = $_FILES['logo'] ?? null;
    $added_by = $_SESSION['user_id'] ?? null;

    // Vérifier que les champs obligatoires sont remplis
    if (!$name || !$owner_id || !$email || !$phone || !$country || !$agency_code || !$added_by) {
        $erreur_champ = "Ce champ est requis !";
    } else {
        try {
            // Vérifier si le nom de l'agence existe déjà
            $queryCheck = "SELECT COUNT(*) FROM agencies WHERE name = :name AND is_deleted = 0";
            $stmtCheck = $pdo->prepare($queryCheck);
            $stmtCheck->bindParam(':name', $name);
            $stmtCheck->execute();
            $existingCount = $stmtCheck->fetchColumn();

            if ($existingCount > 0) {
                $erreur = "Une agence avec ce nom existe déjà. Veuillez choisir un autre nom.";
            } else {
                $logo_name = null;

                // Gestion du logo
                if ($logo && $logo['size'] > 0) {
                    if ($logo['size'] > 5 * 1024 * 1024) { // Limite de taille de 5MB
                        $erreur = "Le logo ne doit pas dépasser 5MB.";
                    } else {
                        $target_dir = "../upload/";
                        $logo_name = $id . "_" . basename($logo["name"]);
                        $target_file = $target_dir . $logo_name;
                        move_uploaded_file($logo["tmp_name"], $target_file);
                    }
                }

                // Préparer et exécuter la requête d'insertion
                $query = "INSERT INTO agencies (id, owner_id, name, email, phone, address, city, country, postal_code, logo, created_at, updated_at, is_deleted, is_active, added_by, comments, agency_code)
                          VALUES (:id, :owner_id, :name, :email, :phone, :address, :city, :country, :postal_code, :logo, NOW(), NOW(), 0, 0, :added_by, :comments, :agency_code)";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':owner_id', $owner_id);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $adresse);
                $stmt->bindParam(':city', $ville);
                $stmt->bindParam(':country', $country);
                $stmt->bindParam(':postal_code', $code_postal);
                $stmt->bindParam(':logo', $logo_name);
                $stmt->bindParam(':added_by', $added_by);
                $stmt->bindParam(':comments', $comments);
                $stmt->bindParam(':agency_code', $agency_code);

                if ($stmt->execute()) {
                    $success = "Agence ajoutée avec succès avec le code : " . htmlspecialchars($agency_code);
                } else {
                    $erreur = "Erreur lors de l'ajout de l'agence.";
                }
            }
        } catch (PDOException $e) {
            $erreur = "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
}
?>
