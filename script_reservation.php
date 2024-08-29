<?php
include_once("database/database.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$erreur_champ = '';
$erreur = '';
$succes = '';

// Define file size limits (in bytes)
const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5 MB

if (isset($_POST["submit"])) {
    $full_name = $_POST['full_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $start_date = $_POST['start_date'] ?? null;
    $end_date = $_POST['end_date'] ?? null;
    $number_of_days = $_POST['number_of_days'] ?? null;
    $comments = $_POST['comments'] ?? null;
    $id_car = $_POST['id_car'] ?? null;

    $cni_file = $_FILES['cni'] ?? null;
    $permis_file = $_FILES['permis'] ?? null;
    // $preuve_domicile = $_FILES['preuve_domicile'] ?? null;

    // Check if all required fields are filled
    if (empty($full_name) || empty($email) || empty($phone) || empty($start_date) || empty($end_date) || empty($number_of_days) || empty($cni_file) || empty($permis_file)) {
        $erreur_champ = "Tous les champs sont obligatoires !";
    } else {
        // Validate file sizes
        if ($cni_file['size'] > MAX_FILE_SIZE ||$preuve_domicile['size'] > MAX_FILE_SIZE ||  $permis_file['size'] > MAX_FILE_SIZE) {
            $erreur = "Les fichiers ne doivent pas dépasser " . (MAX_FILE_SIZE / 1024 / 1024) . " MB.";
        } else {
            // Generate UUID4 for the ID
            $id = uuid4(); // Implement this function to generate UUID4
            
            // Exemple d'utilisation
            $num_reservation = generateReservationNumber();

            // Define upload directory and file paths
            $upload_dir = 'upload/';
            $cni_name = basename($cni_file['name']); // Only the file name
            $permis_name = basename($permis_file['name']); // Only the file name

            // Move uploaded files to the uploads directory
            if (move_uploaded_file($cni_file['tmp_name'], $upload_dir . $cni_name) && move_uploaded_file($permis_file['tmp_name'], $upload_dir . $permis_name)) {
                try {
                    // Prepare SQL statement for reservation
                    $stmt = $pdo->prepare("INSERT INTO reservations (id, id_car, num_reservation, full_name, email, phone, start_date, end_date, number_of_days, options, cni_file, permis_file, comments, reservation_date, status, created_at, is_deleted) 
                                            VALUES (:id, :id_car, :num_reservation, :full_name, :email, :phone, :start_date, :end_date, :number_of_days, :options, :cni_file, :permis_file, :comments, NOW(), 'pending', NOW(), '0')");

                    // Bind parameters
                    $stmt->bindValue(':id', $id, PDO::PARAM_STR);
                    $stmt->bindValue(':id_car', $id_car, PDO::PARAM_STR);
                    $stmt->bindValue(':num_reservation', $num_reservation, PDO::PARAM_STR);
                    $stmt->bindValue(':full_name', $full_name, PDO::PARAM_STR);
                    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                    $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
                    $stmt->bindValue(':start_date', $start_date, PDO::PARAM_STR);
                    $stmt->bindValue(':end_date', $end_date, PDO::PARAM_STR);
                    $stmt->bindValue(':number_of_days', $number_of_days, PDO::PARAM_INT);
                    $stmt->bindValue(':options', null, PDO::PARAM_NULL); // Assuming options can be null
                    $stmt->bindValue(':cni_file', $cni_name, PDO::PARAM_STR); // Store only file name
                    $stmt->bindValue(':permis_file', $permis_name, PDO::PARAM_STR); // Store only file name
                    $stmt->bindValue(':comments', $comments, PDO::PARAM_STR);

                    // Execute the query
                    $stmt->execute();

                    // Retrieve vehicle details along with the brand name
                    $stmt = $pdo->prepare("SELECT cars.*, carbrands.name AS brand_name 
                                            FROM cars 
                                            JOIN carbrands ON cars.brand_id = carbrands.id 
                                            WHERE cars.id = :id_car");
                    $stmt->bindValue(':id_car', $id_car, PDO::PARAM_STR);
                    $stmt->execute();
                    $car = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($car) {
                        // Prepare email
                        sendReservationEmail($id, $full_name, $email, $phone, $start_date, $end_date, $number_of_days, $comments, $car);
                        $succes = "Votre réservation est en attente de validation.";
                        echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 2500);</script>";
                    } else {
                        $erreur = "Détails du véhicule non trouvés.";
                    }
                } catch (PDOException $e) {
                    $erreur = "Erreur lors de l'ajout de la réservation : " . $e->getMessage();
                }
            } else {
                $erreur = "Erreur lors du téléchargement des fichiers.";
            }
        }
    }
}

// Function to generate UUID4
function uuid4() {
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff), mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
    );
}

function generateReservationNumber($prefix = 'RES', $length = 6) {
    // Générer une partie aléatoire
    $randomPart = strtoupper(substr(md5(uniqid(rand(), true)), 0, $length));
    
    // Inclure une partie temporelle pour éviter les collisions
    $timestampPart = date('YmdHis');

    // Combiner le préfixe, la partie temporelle, et la partie aléatoire
    $reservationNumber = $prefix . '-' . $timestampPart . '-' . $randomPart;

    return $reservationNumber;
}

// Function to send reservation email
function sendReservationEmail($id, $full_name, $email, $phone, $start_date, $end_date, $number_of_days, $comments, $car) {
    $mail = new PHPMailer(true);
    
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'laurentalphonsewilfried@gmail.com'; // Replace with your email address
        $mail->Password = 'ztgs elyg jaxy emnx'; // Replace with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipient
        $mail->setFrom('laurentalphonsewilfried@gmail.com', 'Nouvelle Réservation');
        $mail->addAddress('laurentalphonsewilfried@gmail.com'); // Replace with the admin's email address
        
        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'Nouvelle Réservation';
        $mail->CharSet = 'UTF-8';
        
        // Load the email template
        $emailBody = file_get_contents('templates/reservation_template.php'); // Ensure the path is correct
        // Format the dates
        $startDateFormatted = (new DateTime($start_date))->format('d M Y'); // e.g., 28 Aug 2024
        $endDateFormatted = (new DateTime($end_date))->format('d M Y'); // e.g., 30 Aug 2024

        
        // Replace placeholders with actual values
        $emailBody = str_replace([
            '{{ date_debut }}',
            '{{ date_fin }}',
            '{{ nombre_jours }}',
            '{{ nom_client }}',
            '{{ email_client }}',
            '{{ telephone_client }}',
            '{{ marque_vehicule }}',
            '{{ modele_vehicule }}',
            '{{ couleur_vehicule }}',
            '{{ prix_vehicule }}',
            '{{ kilometrage_vehicule }}',
            '{{ immatriculation_vehicule }}',
            '{{ lien_reservation }}'
        ], [
            $startDateFormatted,
            $endDateFormatted,
            $number_of_days,
            $full_name,
            $email,
            $phone,
            $car['brand_name'], // Brand name
            $car['model'],
            $car['color'],
            $car['price_per_day'],
            $car['mileage'],
            $car['registration_number'],
            'https://example.com/reservation.php?id=' . $id // Reservation link
        ], $emailBody);
        
        $mail->Body    = $emailBody;
        
        $mail->send();
        // echo 'Email sent successfully';
    } catch (Exception $e) {
        echo "Error sending email: {$mail->ErrorInfo}";
    }
}
?>