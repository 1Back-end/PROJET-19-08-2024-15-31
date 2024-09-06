<?php
include_once("database/database.php");
include_once("controllers.php");

$erreur = '';
$succes = '';

if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $agency_id = $_POST['agency_id'] ?? null;
    $subscription_id = $_POST['subscription_id'] ?? null;
    $owner_id = $_POST['owner_id'] ?? null;

    // Vérifier que les champs requis ne sont pas vides
    if (empty($agency_id) || empty($subscription_id) || empty($owner_id)) {
        $erreur = "Tous les champs sont obligatoires.";
    } else {
        // Récupérer les informations du type d'abonnement
        $sql = "SELECT * FROM subscription_types WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $subscription_id]);
        $subscription_type = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($subscription_type) {
            // Date actuelle (date de début)
            $start_date = date('Y-m-d');

            // Date de fin récupérée depuis la table subscription_types
            $end_date = $subscription_type['end_date'];

            // Vérifie que end_date est bien définie
            if (!$end_date) {
                $erreur = "La date de fin n'est pas définie pour ce type d'abonnement.";
            } else {
                // Générer un UUID pour la souscription
                $subscription_uuid = uuid4();  // Si vous avez une fonction uuid4() pour générer des UUIDs

                // Insérer la souscription dans la base de données
                $sql_insert = "INSERT INTO subscriptions (id, agency_id, id_type, start_date, end_date, status, added_by_owner) 
                               VALUES (:id, :agency_id, :id_type, :start_date, :end_date, 'inactive', :added_by_owner)";
                $stmt_insert = $pdo->prepare($sql_insert);
                $stmt_insert->execute([
                    'id' => $subscription_uuid,
                    'agency_id' => $agency_id,
                    'id_type' => $subscription_id,
                    'start_date' => $start_date,
                    'end_date' => $end_date,  // Utiliser la date de fin récupérée
                    'added_by_owner' => $owner_id  // Enregistrer l'ID du propriétaire
                ]);

                $succes = "Souscription enregistrée avec succès. Vous allez être redirigé vers le paiement.";
                
                // Redirection vers la page de paiement (à adapter)
                header("Location: subscribe_payment.php?subscription_id=$subscription_uuid");
                exit;
            }
        } else {
            $erreur = "Type d'abonnement invalide.";
        }
    }
}
?>
