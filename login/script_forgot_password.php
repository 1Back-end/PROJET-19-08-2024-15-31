<?php 
include_once("../database/database.php");
include("../controllers/controllers.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$erreur_champ = "";
$erreur = "";
$success = "";

if (isset($_POST["submit"])) {
    // 1. Vérifier que le champ email n'est pas vide
    if (empty($_POST['email'])) {
        $erreur_champ = "Le champ email est requis.";
    } else {
        $email = $_POST['email'];
        
        // 2. Vérifier si l'email existe dans le système
        $query = $pdo->prepare("SELECT id, firstname, lastname FROM users WHERE email = :email LIMIT 1");
        $query->bindParam(':email', $email);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user === false) {
            $erreur = "Cet email n'existe pas dans notre système.";
        } else {
            // 3. Générer un code de réinitialisation
            $user_id = $user['id'];
            $nom = $user['firstname'];
            $prenom = $user['lastname'];
            $token = generateNumericPassword();  // Supposons que cette fonction génère un code de 6 chiffres
            $expiration_date = date('Y-m-d H:i:s', strtotime('+24 hours'));

            // 4. Enregistrer les informations dans la table forgot_password
            $insert_query = $pdo->prepare("
                INSERT INTO forgot_password (id, user_id, reset_code, expiration_date)
                VALUES (UUID(), :user_id, :reset_code, :expiration_date)
            ");
            $insert_query->bindParam(':user_id', $user_id);
            $insert_query->bindParam(':reset_code', $token);
            $insert_query->bindParam(':expiration_date', $expiration_date);
            $insert_query->execute();

            // 5. Envoyer un email avec PHPMailer
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
                $mail->addAddress($email);  // Adresse email du destinataire

                // Contenu de l'email
                $mail->isHTML(true);
                $mail->Subject = 'Réinitialisation de votre mot de passe';
                $mail->CharSet = 'UTF-8';
                    

                // Charger le template HTML
                ob_start();
                include '../templates/email_template.php';
                $body = ob_get_clean();
                
                $mail->Body = $body;

                // Envoyer l'email
                $mail->send();

                // Message de succès
                $success_message = urlencode("Un code de réinitialisation a été envoyé à votre adresse email.");

                // Rediriger vers la page de validation avec l'id de l'utilisateur et le message de succès
                header("Location: code_validation.php?user_id=" . $user_id . "&success_message=" . $success_message);
                exit();
            } catch (Exception $e) {
                $erreur = "L'email n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
            }
        }
    }
}
?>
