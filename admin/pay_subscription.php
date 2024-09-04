<?php
session_start();

// Inclusion des dépendances et des fichiers nécessaires
require '../vendor/autoload.php';
include_once("../database/database.php");
include_once("../controllers/controllers.php");

use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

// Définir votre clé API Stripe (remplacez par votre clé secrète)
Stripe::setApiKey('sk_test_51PvK3l08QILWwY1ztJaryXP5o5GwQLKyf6enbJr6cnbO06R1p8ld4HKqNrYzOdFUF6UH1Fz8kwj47UfS0c2n5lmi00Sijvkwu7');

// Messages d'état pour le traitement
$success = "";
$erreur = "";

// Vérifiez si un ID de souscription est fourni et qu'il n'y a pas encore de session_id
if (isset($_GET['id']) && !isset($_GET['session_id'])) {
    $subscription_id = $_GET['id'] ?? null;

    // Vérifiez que l'ID de souscription est valide
    if (!$subscription_id) {
        die("Erreur : Aucune souscription spécifiée.");
    }

    // Récupérer les détails de la souscription et calculer le montant total à payer
    $stmt = $pdo->prepare("SELECT 
                                s.id AS subscription_id,
                                a.name AS agency_name,
                                st.name AS subscription_type,
                                s.start_date,
                                s.end_date,
                                DATEDIFF(s.end_date, s.start_date) AS days_between,
                                (DATEDIFF(s.end_date, s.start_date) * st.price) AS total_amount,
                                s.status,
                                s.created_at
                           FROM 
                                subscriptions s
                           JOIN 
                                agencies a ON s.agency_id = a.id
                           JOIN 
                                subscription_types st ON s.id_type = st.id
                           WHERE 
                                s.id = :subscription_id");
    $stmt->execute([':subscription_id' => $subscription_id]);
    $subscription = $stmt->fetch();

    // Vérifiez si la souscription a été trouvée
    if (!$subscription) {
        die("Erreur : Souscription introuvable.");
    }

    // Calculer les nouvelles dates de début et de fin de l'abonnement
    $start_date = new DateTime();
    $end_date = (clone $start_date)->modify('+' . $subscription['days_between'] . ' days');

    // Mettre à jour les dates de début et de fin dans la base de données
    $stmt = $pdo->prepare("UPDATE subscriptions SET start_date = :start_date, end_date = :end_date WHERE id = :id");
    $stmt->execute([
        ':start_date' => $start_date->format('Y-m-d'),
        ':end_date' => $end_date->format('Y-m-d'),
        ':id' => $subscription_id,
    ]);

    // Créer une session de paiement avec Stripe
    $session = StripeSession::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $subscription['subscription_type'],
                ],
                'unit_amount' => $subscription['total_amount'] * 100, // Montant en centimes
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/PROJET/PROJET01/admin/payment_success.php?session_id={CHECKOUT_SESSION_ID}&subscription_id=' . $subscription_id,
        'cancel_url' => 'http://localhost/PROJET/PROJET01/admin/payment_integration.php?cancelled=true&subscription_id=' . $subscription_id,
    ]);

    // Rediriger vers la page de paiement Stripe
    header("Location: " . $session->url);
    exit();
}

// Étape 2: Gérer le succès du paiement lorsque Stripe redirige l'utilisateur
if (isset($_GET['session_id']) && isset($_GET['subscription_id'])) {
    $session_id = $_GET['session_id'];
    $subscription_id = $_GET['subscription_id'];
    $added_by = $_SESSION['user_id']; // ID de l'utilisateur, si disponible

    // Récupérer les détails de la session Stripe
    $session = StripeSession::retrieve($session_id);
    $payment_intent = $session->payment_intent;

    // Enregistrer le paiement dans la base de données
    $payment_id = generateUuid4();
    $transaction_id = generateTransactionId();

    // Préparer la requête d'insertion du paiement
    $stmt = $pdo->prepare("INSERT INTO payments (id, subscription_id, amount, payment_date, payment_method, status, transaction_id, added_by) 
                           VALUES (:id, :subscription_id, :amount, NOW(), 'card', 'completed', :transaction_id, :added_by)");
    $stmt->execute([
        ':id' => $payment_id,
        ':subscription_id' => $subscription_id,
        ':amount' => $session->amount_total / 100, // Stripe renvoie le montant en centimes
        ':transaction_id' => $transaction_id,
        ':added_by' => $added_by, // Assurez-vous que cette valeur est valide
    ]);

    // Mettre à jour le statut de la souscription
    $stmt = $pdo->prepare("UPDATE subscriptions SET status = 'active' WHERE id = :id");
    $stmt->execute([':id' => $subscription_id]);

    // Redirection en cas de succès du paiement
    header("Location: payment_success.php?success=" . urlencode("Le paiement a été effectué avec succès ! Merci pour votre achat."));
    exit();
}

// Étape 3: Gérer l'annulation du paiement
if (isset($_GET['cancelled'])) {
    $subscription_id = $_GET['subscription_id'] ?? null;

    // Enregistrer l'annulation du paiement dans la base de données (si nécessaire)
    if ($subscription_id) {
        $stmt = $pdo->prepare("INSERT INTO payment_errors (subscription_id, error_message, error_date) 
                               VALUES (:subscription_id, 'Le paiement a été annulé par l\'utilisateur.', NOW())");
        $stmt->execute([':subscription_id' => $subscription_id]);
    }

    // Redirection en cas d'annulation
    header("Location: payment_success.php?error=" . urlencode("Le paiement a été annulé. Veuillez réessayer."));
    exit();
}
?>
