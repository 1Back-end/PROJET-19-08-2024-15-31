<?php
include_once("../database/database.php");

$erreur_champ = "";
$erreur = "";
session_start();
if (isset($_POST["submit"])) {
    // Récupérer et sécuriser les champs
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Vérifier si les champs ne sont pas vides
    if (empty($email) || empty($password)) {
        $erreur_champ = "Tous les champs sont obligatoires.";
    } else {
        // Requête pour vérifier l'existence du propriétaire
        $stmt = $pdo->prepare("SELECT * FROM owners WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $owner = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($owner) {
            // Vérifier si le compte est supprimé
            if ($owner['is_deleted'] == 1) {
                $erreur = "Votre compte n'existe plus.";
            } elseif ($owner['status'] == 'inactive') {
                $erreur = "Votre compte est désactivé.";
            } elseif (password_verify($password, $owner['password_hash'])) {
                // Connexion réussie
                $_SESSION['owner_id'] = $owner['id'];
                $_SESSION['owner_name'] = $owner['name'];
                $_SESSION['owner_image'] = $owner['image'];

                // Redirection vers la page d'accueil ou tableau de bord
                header("Location: ../include/menu_owners.php");
                exit;
            } else {
                // Mot de passe incorrect
                $erreur = "Adresse email ou mot de passe incorrect.";
            }
        } else {
            // Propriétaire non trouvé
            $erreur = "Adresse email ou mot de passe incorrect.";
        }
    }
}
?>
