<?php
session_start();
if (!isset($_SESSION['owner_id'])) {
    // Redirection si l'utilisateur n'est pas connecté
    header("Location: ../owners/login.php");
    exit();
}
?>