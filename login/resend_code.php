<?php
include_once("../database/database.php");
include("../controllers/controllers.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Variables d'état pour les messages
$resend_error = '';
$resend_success = '';

// Vérifier si le renvoi du code est demandé
if (isset($_GET['resend_code']) && $_GET['resend_code'] == '1' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Vérifier si l'utilisateur existe
    $query = $pdo->prepare("
        SELECT id, firstname, lastname, email 
        FROM users 
        WHERE id = :user_id 
        LIMIT 1
    ");
    $query->bindParam(':user_id', $user_id);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $resend_error = "Utilisateur non trouvé.";
    } else {
        $email = $user['email'];
        $nom = $user['firstname'];
        $prenom = $user['lastname'];

        // Vérifier si un code en attente existe
        $stmt = $pdo->prepare("
            SELECT * FROM forgot_password 
            WHERE user_id = :user_id AND status = 'pending' 
            LIMIT 1
        ");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $token = $result['reset_code'];
        } else {
            // Générer un nouveau code
            $token = generateNumericPassword();  // Fonction à implémenter pour générer un code à 6 chiffres
            $expiration_date = date('Y-m-d H:i:s', strtotime('+24 hours'));

            // Insérer le nouveau code
            $insert_query = $pdo->prepare("
                INSERT INTO forgot_password (id, user_id, reset_code, expiration_date)
                VALUES (UUID(), :user_id, :reset_code, :expiration_date)
            ");
            $insert_query->bindParam(':user_id', $user_id);
            $insert_query->bindParam(':reset_code', $token);
            $insert_query->bindParam(':expiration_date', $expiration_date);
            $insert_query->execute();
        }

        // Envoyer un e-mail avec le code de validation
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'laurentalphonsewilfried@gmail.com';
            $mail->Password = 'ztgs elyg jaxy emnx'; // Remplacez par votre mot de passe e-mail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('laurentalphonsewilfried@gmail.com', 'Laurent Alphonse');
            $mail->addAddress($email);

            // Charger le template HTML ou utiliser un simple corps de message
            ob_start();
            include '../templates/email_template.php';
            $body = ob_get_clean();
            $body = str_replace('{{code}}', $token, $body);

            $mail->isHTML(true);
            $mail->Subject = 'Votre code de validation';
            $mail->Body = $body;

            $mail->send();
            $resend_success = "Un nouveau code de réinitialisation a été envoyé à votre adresse email.";
        } catch (Exception $e) {
            $resend_error = "L'email n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
        }
    }
}
?>
