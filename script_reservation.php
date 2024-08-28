<?php
include_once("database/database.php");

$erreur_champ ='';
$erreur = '';
$succes ='';

if (isset($_POST["submit"])) {
    $full_name = $_POST['full_name'] ?? null;
    $email = $_POST['email'] ?? null;
    $phone = $_POST['phone'] ?? null;
    $start_date = $_POST['start_date'] ?? null;
    $end_date = $_POST['end_date'] ?? null;
    $number_of_days = $_POST['number_of_days'] ?? null;
    $cni = $_FILES['cni'] ?? null;
    $permis = $_FILES['permis'] ?? null;


    if (!empty($full_name) && !empty($email) && !empty($phone) && !empty($start_date) && !empty($end_date) && !empty($number_of_days)
            && !empty($cni) && !empty($permis)) {
        $erreur_champ  = "Tous les champs sont obligatoires !";

        # code...
    }

    

    # code...
}












?>