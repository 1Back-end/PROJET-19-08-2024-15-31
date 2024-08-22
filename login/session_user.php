<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirection si l'utilisateur n'est pas connecté
    header("Location: ../login/login.php");
    exit();
}
?>