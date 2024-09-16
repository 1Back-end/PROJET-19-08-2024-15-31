<?php
include_once("../database/database.php");
include_once("../controllers/controllers.php");
include_once("controllers_owners.php");
$erreur_champ = "";
$erreur = "";
$success = "";

// Définir les paramètres pour le fichier
$max_file_size = 2 * 1024 * 1024; // Taille maximale du fichier en octets (2 Mo)
$allowed_types = ['image/jpeg', 'image/png']; // Types de fichiers autorisés

if (isset($_POST["submit"])) {
    // Récupération des données du formulaire
    $marque = $_POST['marque'] ?? null;
    $description = $_POST['description'] ?? null;
    $added_by = $_SESSION['owner_id'] ?? null;
    $id = generateUuid4();
    $photo = $_FILES['photo'] ?? null;
    $agency_id = get_agency_id_by_owner($pdo, $id_owner);

    // Vérifier que tous les champs sont remplis
    if (empty($marque) || empty($description) || empty($added_by) || empty($photo) || $photo['error'] != UPLOAD_ERR_OK) {
        $erreur_champ = "Tous les champs sont requis !";
    } else {
        // Vérifier le type de fichier
        $file_type = mime_content_type($photo['tmp_name']);
        if (!in_array($file_type, $allowed_types)) {
            $erreur = "Le fichier doit être au format JPEG ou PNG.";
        }
        // Vérifier la taille du fichier
        elseif ($photo['size'] > $max_file_size) {
            $erreur = "Le fichier est trop volumineux. La taille maximale est de 2 Mo.";
        } else {
            // Gérer le fichier photo
            $upload_dir = '../upload/';
            $photo_name = basename($photo['name']);
            $upload_file = $upload_dir . $photo_name;

            // Vérifier si le fichier est bien une image et le déplacer
            if (move_uploaded_file($photo['tmp_name'], $upload_file)) {
                try {
                    // Préparer et exécuter la requête d'insertion avec PDO
                    $stmt = $pdo->prepare("INSERT INTO carbrands (id, name, image, description, added_by,agency_id) VALUES (:id, :name, :image, :description, :added_by,:agency_id)");
                    $stmt->bindParam(':id', $id);
                    $stmt->bindParam(':name', $marque);
                    $stmt->bindParam(':image', $photo_name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':added_by', $added_by);
                    $stmt->bindParam(':agency_id', $agency_id);

                    if ($stmt->execute()) {
                        $success = "Marque ajoutée avec succès.";
                    } else {
                        $erreur = "Erreur lors de l'ajout de la marque.";
                    }
                } catch (PDOException $e) {
                    $erreur = "Erreur de la base de données : " . $e->getMessage();
                }
            } else {
                $erreur = "Erreur lors du téléchargement du fichier.";
            }
        }
    }
}
// echo $agency_id;

?>
