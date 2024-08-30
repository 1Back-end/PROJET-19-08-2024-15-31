<?php
include_once("../database/database.php");
include_once("../controllers/controllers.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    $username = $_POST['username'] ?? null;
    $tel = $_POST['tel'] ?? null;
    $country = $_POST['country'] ?? null;
    $email = $_POST['email'] ?? null;
    $ville = $_POST['ville'] ?? null;
    $code_postal = $_POST['code_postal'] ?? null;
    $adresse = $_POST['adresse'] ?? null;
    $id = generateUuid4();
    $password = generatePassword();
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $photo = $_FILES['photo'] ?? null;
    $added_by = $_SESSION['user_id'] ?? null;

    // Vérifier que les champs obligatoires sont remplis
    if (!$username || !$email || !$tel || !$country || !$password_hash || !$added_by) {
        $erreur_champ = "Ce champ est requis !";
    } else {
        try {
            // Vérifier l'unicité de l'email et du téléphone
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM owners WHERE email = :email OR phone = :phone");
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':phone', $tel);
            $stmt->execute();
            $exists = $stmt->fetchColumn();

            if ($exists) {
                $erreur = "Un propriétaire avec cet email ou numéro de téléphone existe déjà.";
            } else {
                $photo_name = null;

                // Gestion de la photo
                if ($photo && $photo['size'] > 0) {
                    if ($photo['size'] > 5 * 1024 * 1024) {
                        $erreur = "La photo ne doit pas dépasser 5MB.";
                    } else {
                        $target_dir = "../upload/";
                        $photo_name = $id . "_" . basename($photo["name"]);
                        $target_file = $target_dir . $photo_name;
                        move_uploaded_file($photo["tmp_name"], $target_file);
                    }
                }

                // Insérer les données dans la base
                $stmt = $pdo->prepare("
                    INSERT INTO owners (id, name, email, phone, address, city, country, postal_code, image, password_hash, created_at, updated_at, is_deleted, added_by)
                    VALUES (:id, :name, :email, :phone, :address, :city, :country, :postal_code, :image, :password_hash, NOW(), NOW(), 0, :added_by)
                ");
                $stmt->bindValue(':id', $id);
                $stmt->bindValue(':name', $username);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':phone', $tel);
                $stmt->bindValue(':address', $adresse);
                $stmt->bindValue(':city', $ville);
                $stmt->bindValue(':country', $country);
                $stmt->bindValue(':postal_code', $code_postal);
                $stmt->bindValue(':image', $photo_name);
                $stmt->bindValue(':password_hash', $password_hash);
                $stmt->bindValue(':added_by', $added_by);

                if ($stmt->execute()) {
                    // Si l'enregistrement en base est réussi, envoyer un email avec PHPMailer
                    $mail = new PHPMailer(true);
                    try {
                        // Configurations du serveur SMTP
                        $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = 'laurentalphonsewilfried@gmail.com'; // Remplacez par votre adresse e-mail
                    $mail->Password = 'ztgs elyg jaxy emnx'; // Remplacez par votre mot de passe e-mail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    // Destinataire
                    $mail->setFrom('laurentalphonsewilfried@gmail.com', 'AutoSmart');
                    $mail->addAddress($email, $username);
                        // Contenu de l'email
                    $mail->isHTML(true);
                    $mail->Subject = 'Bienvenue sur notre plateforme';
                    $mail->CharSet = 'UTF-8';
                    
                        
                    // Charger et personnaliser le template HTML
                    $template = file_get_contents('../templates/owners_template.php');
                    $template = str_replace('{{username}}', $username, $template);
                    $template = str_replace('{{password}}', $password, $template);

                    $mail->Body    = $template;
                    $mail->send();
                    $success = "Propriétaire enregistré avec succès et email envoyé.";
                    } catch (Exception $e) {
                        $erreur = "L'email n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
                    }
                } else {
                    $erreur = "Erreur lors de l'enregistrement du propriétaire.";
                }
            }
        } catch (PDOException $e) {
            $erreur = "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
}
?>
