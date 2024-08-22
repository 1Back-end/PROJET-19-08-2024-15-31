<?php
include_once("../database/database.php");

$erreur_champ = "";
$erreur = "";

if (isset($_POST["submit"])) {
    // Récupérer et sécuriser les champs
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Vérifier que les champs ne sont pas vides
    if (empty($email) || empty($password)) {
        $erreur_champ = "Ce champ est réquis !";
    } else {
        try {
            // Préparer la requête SQL pour vérifier l'utilisateur
            $query = "SELECT * FROM users WHERE email = :email AND role = 1 AND is_deleted = 0 LIMIT 1";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Vérifier si le compte est désactivé
                if ($user['is_active'] == 2) {
                    $erreur = "Votre compte est désactivé. Veuillez contacter l'administrateur.";
                } else {
                    // Vérifier le mot de passe
                    if (password_verify($password, $user['password'])) {
                        // Connexion réussie - Démarrer la session et rediriger l'utilisateur
                        session_start();
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_email'] = $user['email'];
                        $_SESSION['username'] = $user['firstname'] . ' ' . $user['lastname'];
                        $_SESSION['user_profile'] = $user['photo'];
                        $_SESSION['user_role'] = $user['role'];
                        header("Location: ../admin/dashboard.php");
                        exit();
                    } else {
                        $erreur = "Adresse e-mail ou mot de passe incorrect.";
                    }
                }
            } else {
                $erreur = "Aucun compte trouvé avec cette adresse e-mail.";
            }
        } catch (PDOException $e) {
            $erreur = "Erreur de base de données : " . $e->getMessage();
        }
    }
}
?>