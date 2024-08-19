<?php
function generateUuid4() {
    $data = random_bytes(16);
    
    // Modifier les octets selon la spécification UUID4
    // Version 4 indique que les 13 premiers bits de la 7ème octet sont 0111
    // Ce qui équivaut à 0x40 en hexadécimal.
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Version 4
    // Les 2 premiers bits du 9ème octet doivent être 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Variante
    
    // Convertir les octets en format UUID
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}


function generateLicensePlate($length = 10) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $plate = '';

    for ($i = 0; $i < $length; $i++) {
        $plate .= $characters[random_int(0, strlen($characters) - 1)];
    }

    return $plate;
}

function generatePassword($length = 12) {
    // Définir les caractères que vous souhaitez utiliser dans le mot de passe
    $upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lower = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $special = '!@#$%&;';
    
    // Combiner tous les caractères possibles
    $characters = $upper . $lower . $numbers . $special;
    
    // Assurez-vous que le mot de passe est suffisamment long pour inclure tous les types de caractères
    if ($length < 4) {
        throw new InvalidArgumentException('La longueur du mot de passe doit être d\'au moins 4 caractères.');
    }
    
    // Utiliser random_int pour générer des caractères aléatoires
    $password = '';
    $charactersLength = strlen($characters);
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[random_int(0, $charactersLength - 1)];
    }
    
    return $password;
}

function generateNumericPassword($length = 4) {
    // Définir les chiffres possibles
    $numbers = '0123456789';
    
    // Vérifier que la longueur demandée est positive
    if ($length < 1) {
        throw new InvalidArgumentException('La longueur du mot de passe doit être d\'au moins 1 caractère.');
    }

    // Utiliser random_int pour générer des chiffres aléatoires
    $password = '';
    $numbersLength = strlen($numbers);
    
    for ($i = 0; $i < $length; $i++) {
        $password .= $numbers[random_int(0, $numbersLength - 1)];
    }
    
    return $password;
}

function isValidEmail($email) {
    // Vérifier la validité de l'email avec filter_var
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function getCurrentYear() {
    return date('Y');
}

function getMonthsShort() {
    // Noms des mois en format abrégé
    return [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Dec'
    ];
}

function getFormattedPageName() {
    // Obtenir le chemin du script en cours
    $currentPage = $_SERVER['PHP_SELF'];
    
    // Extraire le nom du fichier à partir du chemin complet
    $fileName = basename($currentPage, '.php'); // Supprimer l'extension .php

    // Remplacer les tirets par des espaces ou un autre caractère, si nécessaire
    $formattedName = str_replace('-', ' ', $fileName);

    return $formattedName;
}

function getCurrentDateTime($format = 'Y-m-d') {
    // Obtenir la date et l'heure actuelles en utilisant le format spécifié
    return date($format);
}













?>