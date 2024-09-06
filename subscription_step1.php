<?php
include_once("database/database.php");
include_once("controllers.php");

$erreur_champ = '';
$erreur = '';
$succes = '';

if (isset($_POST["submit"])) {
    // Récupération des données du formulaire
    $email = $_POST['email'] ?? null;
    $subscription_id = $_POST['subscription_id'] ?? null;

    // Vérifier que l'email n'est pas vide
    if (empty($email)) {
        $erreur_champ = 'L\'adresse email ne peut pas être vide.';
    } else {
        // Vérifier si l'email existe dans la base de données
        $sql = "SELECT id FROM owners WHERE email = :email AND is_deleted = 0";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email]);
        $owner = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si l'email existe, récupérer l'ID du propriétaire
        if ($owner) {
            $owner_id = $owner['id'];

            // Redirection vers la page de choix de l'agence avec l'ID du propriétaire et l'ID de l'abonnement
            header("Location: subscribe_agency.php?owner_id=$owner_id&subscription_id=$subscription_id");
            exit;
        } else {
            $erreur = 'Aucun compte propriétaire trouvé avec cet email.';
        }
    }
}
?>
