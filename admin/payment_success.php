<?php
require '../vendor/autoload.php';
include_once("../database/database.php");
include_once("../controllers/controllers.php");

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

// Définir votre clé API Stripe
Stripe::setApiKey('sk_test_51PvK3l08QILWwY1ztJaryXP5o5GwQLKyf6enbJr6cnbO06R1p8ld4HKqNrYzOdFUF6UH1Fz8kwj47UfS0c2n5lmi00Sijvkwu7'); // Remplacez par votre clé secrète

$success = "";
$erreur = "";

// Vérifiez si une session ID et une souscription ID sont fournies
if (isset($_GET['session_id']) && isset($_GET['subscription_id'])) {
    $session_id = $_GET['session_id'];
    $subscription_id = $_GET['subscription_id'];

    $session = StripeSession::retrieve($session_id);
    $payment_intent = $session->payment_intent;

    // Enregistrer le paiement dans la base de données
    $payment_id = generateUuid4();
    $transaction_id = generateTransactionId();

    $stmt = $pdo->prepare("INSERT INTO payments (id, subscription_id, amount, payment_date, payment_method, status, transaction_id) 
                           VALUES (:id, :subscription_id, :amount, NOW(), 'card', 'completed', :transaction_id)");
    $stmt->execute([
        ':id' => $payment_id,
        ':subscription_id' => $subscription_id,
        ':amount' => $session->amount_total / 100, // Stripe renvoie le montant en centimes
        ':transaction_id' => $payment_intent,
    ]);

    // Mettre à jour le statut de l'abonnement
    $stmt = $pdo->prepare("UPDATE subscriptions SET status = 'active' WHERE id = :id");
    $stmt->execute([':id' => $subscription_id]);

    // Récupérer l'ID de l'agence associé à la souscription
    $stmt = $pdo->prepare("SELECT agency_id FROM subscriptions WHERE id = :id");
    $stmt->execute([':id' => $subscription_id]);
    $subscription = $stmt->fetch();

    if ($subscription) {
        $agency_id = $subscription['agency_id'];

        // Mettre à jour le statut de l'agence
        $stmt = $pdo->prepare("UPDATE agencies SET is_active = 1 WHERE id = :id");
        $stmt->execute([':id' => $agency_id]);
    }

    // Enregistrer le succès du paiement dans la session
    $success = "Paiement réussi ! Merci pour votre achat.";
}

// Affichage du résultat
?>

<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de Paiement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Confirmation de Paiement</h1>
        <?php if ($success): ?>
            <div class="alert alert-success" role="alert">
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Le paiement a été annulé ou il y a eu un problème. Veuillez réessayer.
            </div>
        <?php endif; ?>

        <p>Vous pouvez accéder à votre tableau de bord Stripe pour plus de détails sur ce paiement :</p>
        <a href="https://dashboard.stripe.com/test/payments" target="_blank" class="btn btn-primary">Accéder au tableau de bord Stripe</a>
        
        <!-- Bouton retour sur l'application -->
        <a href="http://localhost/PROJET/PROJET01" class="btn btn-secondary mt-3">Retourner à l'application</a>
    </div>
</body>
</html>
