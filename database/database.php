<?php
// Paramètres de connexion à la base de données
$host = 'localhost';      // Hôte de la base de données
$dbname = 'location_car'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur de la base de données
$password = ''; // Mot de passe de la base de données

try {
    // Crée une instance de PDO
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8"; // DSN pour MySQL
    $pdo = new PDO($dsn, $username, $password);
    
    // Définit le mode d'erreur de PDO sur Exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // echo "Connexion réussie !"; // Optionnel : Message de succès
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    echo "Échec de la connexion : " . $e->getMessage();
}
?>
