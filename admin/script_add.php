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
    // Récupération des données du formulaire
    $nom = $_POST['nom'] ?? null;
    $prenom = $_POST['prenom'] ?? null;
    $email = $_POST['email'] ?? null;
    $telephone = $_POST['telephone'] ?? null;
    $birthday = $_POST["birthday"] ?? null;
    
    // Génération des valeurs pour d'autres champs
    $id = generateUuid4();
    $password = generatePassword();
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $role = 1; // Exemple : 1 pour un utilisateur standard
    $created_at = date('Y-m-d H:i:s'); // Date actuelle
    $is_deleted = 0; // Non supprimé
    $is_active = 1; // Actif
    $photo = ''; // Champ photo peut être vide ou à mettre à jour selon vos besoins

    // Validation des champs
    if (empty($nom) || empty($prenom) || empty($email) || empty($telephone) || empty($birthday)) {
        $erreur_champ = "Ce champ est requis !";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreur = "Veuillez entrer une adresse email valide.";
    } elseif (!preg_match('/^\+[0-9]{1,3}\s*[0-9]{1,14}$/', $telephone)) {
        $erreur = "Veuillez entrer un numéro de téléphone valide.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $birthday)) {
        $erreur = "Veuillez entrer une date de naissance valide au format YYYY-MM-DD.";
    } else {
        try {
            // Vérification de l'unicité de l'email
            $query = "SELECT COUNT(*) FROM users WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $email_count = $stmt->fetchColumn();

            // Vérification de l'unicité du numéro de téléphone
            $query = "SELECT COUNT(*) FROM users WHERE contact = :telephone";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':telephone', $telephone);
            $stmt->execute();
            $phone_count = $stmt->fetchColumn();

            if ($email_count > 0) {
                $erreur = "L'adresse email est déjà utilisée.";
            } elseif ($phone_count > 0) {
                $erreur = "Le numéro de téléphone est déjà utilisé.";
            } else {
                // Insertion des données dans la base de données
                $query = "INSERT INTO users (id, firstname, lastname, email, contact, birthday, password, role, created_at, is_deleted, is_active) VALUES (:id, :nom, :prenom, :email, :telephone, :birthday, :password_hash, :role, :created_at, :is_deleted, :is_active)";
                $stmt = $pdo->prepare($query);
                
                // Lier les paramètres
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':nom', $nom);
                $stmt->bindParam(':prenom', $prenom);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':telephone', $telephone);
                $stmt->bindParam(':birthday', $birthday);
                $stmt->bindParam(':password_hash', $password_hash);
                $stmt->bindParam(':role', $role);
                $stmt->bindParam(':created_at', $created_at);
                $stmt->bindParam(':is_deleted', $is_deleted);
                $stmt->bindParam(':is_active', $is_active);
                
                // Exécution de la requête
                $stmt->execute();
                $success = "Les données ont été enregistrées avec succès.";
                
                // Envoi d'un email de confirmation avec PHPMailer
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = 'laurentalphonsewilfried@gmail.com'; // Remplacez par votre adresse e-mail
                    $mail->Password = 'ztgs elyg jaxy emnx'; // Remplacez par votre mot de passe e-mail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    // Destinataire
                    $mail->setFrom('laurentalphonsewilfried@gmail.com', 'Laurent Alphonse');
                    $mail->addAddress($email, $prenom . ' ' . $nom);
                    
                    // Contenu de l'email
                    $mail->isHTML(true);
                    $mail->Subject = 'Vos Identifiants de Connexion';
                    $mail->CharSet = 'UTF-8';
                    
                    // Charger le template HTML
                    $template = file_get_contents('template_mail.html');
                    
                    // Remplacer les placeholders dans le template
                    $template = str_replace(
                        ['{{nom_prenom}}', '{{email}}', '{{mot_de_passe}}'],
                        [$prenom . ' ' . $nom, $email, $password],
                        $template
                    );
                    
                    $mail->Body    = $template;
                    $mail->AltBody = 'Voici vos identifiants de connexion. Utilisez le lien suivant pour vous connecter : https://example.com/login';
                    
                    // Envoi de l'email
                    $mail->send();
                    // $success .= " Un email de confirmation a été envoyé.";
                } catch (Exception $e) {
                    $erreur = "L'email de confirmation n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        } catch (PDOException $e) {
            $erreur = "Échec de l'enregistrement : " . $e->getMessage();
        }
    }
}
?>
