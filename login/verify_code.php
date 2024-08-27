<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';  // Adjust the path as needed

include_once("../database/database.php");

$ErreurMessage = "";
$SuccesMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    // Récupérer les valeurs des champs de code
    $code1 = $_POST["code1"];
    $code2 = $_POST["code2"];
    $code3 = $_POST["code3"];
    $code4 = $_POST["code4"];
    $code5 = $_POST["code5"];
    $code6 = $_POST["code6"];
    $user_id = $_POST["user_id"];

    // Concaténer les valeurs pour former le code complet
    $code = $code1 . $code2 . $code3 . $code4 .$code5 .$code6;

    // Vérifier si les champs sont vides
    if (empty($code) || empty($user_id)) {
        $ErreurMessage = "Veuillez entrer votre code de validation !";
    } else {
        // Rechercher le code dans la base de données
        $stmt = $pdo->prepare("SELECT * FROM forgot_password WHERE user_id  = ? AND reset_code = ? AND expiration_date > NOW()");
        $stmt->execute([$user_id, $code]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Le code est valide et n'est pas expiré, suppression de l'enregistrement
            $stmt = $pdo->prepare("DELETE FROM forgot_password WHERE user_id = ? AND reset_code = ?");
            $stmt->execute([$user_id, $code]);
            
            // Redirection vers la page de réinitialisation de mot de passe
            header("Location: reset_password.php?user_id=" . $user_id);
            exit();
        } else {
            // Message d'erreur si le code saisi ne correspond pas à celui enregistré ou est expiré
            $ErreurMessage = "Code de validation incorrect ou expiré. Veuillez réessayer !";
        }
    }
}

// Logic for resending the code
if (isset($_GET['resend_code']) && $_GET['resend_code'] == '1' && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Rechercher le code existant et l'email dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM forgot_password WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $code = $result['reset_code'];

        // Rechercher l'adresse email de l'employé
        $stmt = $pdo->prepare("SELECT email FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($employee) {
            $email = $employee['email'];

            // Envoyer le code de validation par email
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Serveur SMTP
                    $mail->SMTPAuth = true;
                    $mail->Username = 'laurentalphonsewilfried@gmail.com'; // Adresse e-mail
                    $mail->Password = 'ztgs elyg jaxy emnx'; // Mot de passe e-mail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    // Destinataire
                    $mail->setFrom('laurentalphonsewilfried@gmail.com', 'Laurent Alphonse');
                $mail->addAddress($email);  // Add a recipient

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Votre code de validation';
                $mail->Body    = "Votre code de validation est : <b>$code</b>";

                $mail->send();
                $SuccesMessage = "Le code de validation a été renvoyé. Veuillez vérifier votre email.";
            } catch (Exception $e) {
                $ErreurMessage = "Le code de validation n'a pas pu être envoyé. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            $ErreurMessage = "Erreur lors de la récupération de l'email. Veuillez réessayer plus tard.";
        }
    } else {
        $ErreurMessage = "Erreur lors de la récupération du code. Veuillez réessayer plus tard.";
    }
}
?>