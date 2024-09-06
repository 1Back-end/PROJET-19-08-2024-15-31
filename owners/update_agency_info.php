<?php
include_once("../database/database.php");
include_once("../controllers/controllers.php");

$erreur = "";
$success = "";

// Vérifier si le formulaire est soumis
if (isset($_POST['submit'])) {
    $owner_id = $_POST['owner_id'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $logo = $_FILES['logo'] ?? null;

    // Gérer le fichier logo
    $logoFileName = null;
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../upload/';
        $tmpName = $_FILES['logo']['tmp_name'];
        $logoFileName = basename($_FILES['logo']['name']);
        $uploadFile = $uploadDir . $logoFileName;

        // Déplacer le fichier uploadé
        if (move_uploaded_file($tmpName, $uploadFile)) {
            // Utiliser le nouveau logo
        } else {
            $erreur = "Erreur lors du téléchargement du fichier.";
        }
    }

    if (empty($erreur)) {
        try {
            // Vérifier si le nom d'agence existe déjà (pour éviter les doublons)
            $checkSql = "SELECT COUNT(*) FROM agencies WHERE name = :name AND owner_id != :owner_id";
            $checkStmt = $pdo->prepare($checkSql);
            $checkStmt->bindParam(':name', $name);
            $checkStmt->bindParam(':owner_id', $owner_id);
            $checkStmt->execute();
            $count = $checkStmt->fetchColumn();

            if ($count > 0) {
                $erreur = "Une agence avec ce nom existe déjà.";
            } else {
                // Préparer la requête SQL pour mettre à jour les informations de l'agence
                $sql = "UPDATE agencies SET 
                            name = :name,
                            email = :email,
                            phone = :phone,
                            address = :address,
                            city = :city,
                            country = :country,
                            postal_code = :postal_code,
                            logo = COALESCE(:logo, logo), -- Utilise le logo actuel si aucun nouveau logo n'est fourni
                            updated_at = CURRENT_TIMESTAMP
                        WHERE owner_id = :owner_id";

                $stmt = $pdo->prepare($sql);

                // Lier les paramètres
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':country', $country);
                $stmt->bindParam(':postal_code', $postal_code);
                $stmt->bindParam(':logo', $logoFileName);
                $stmt->bindParam(':owner_id', $owner_id);

                // Exécuter la requête
                $stmt->execute();

                $success = "Informations mises à jour avec succès.";
                echo '<meta http-equiv="refresh" content="2;url=my_account.php">';
                // Actualiser la page pour recharger les données
            
            }
        } catch (PDOException $e) {
            $erreur = "Erreur lors de la mise à jour des informations : " . $e->getMessage();
        }
    }
}
?>
