<?php
require 'vendor/autoload.php';

use PayPal\Checkout\Orders\OrdersCreateRequest;
use PayPal\Checkout\Orders\OrdersCaptureRequest;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

// Configurer l'API Context
$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'Abn8-wTG6AgP2Q-IZrOvqv3A8dwvtKax-Pjw8pBY_LLe9osVXDRfBht7f3r-oguQ67WoR-IuxPym4eZN',     // Remplacez par votre Client ID
        'EKjnsVurSnvBc957wvsQdowiP56s-_cWqpXE29AdUTP1Uxnxj3oANkFdaA3VTfFp6bIf_iAEevxWKcN5'  // Remplacez par votre Client Secret
    )
);

$subscription_id = $_GET['subscription_id'] ?? null;

if ($subscription_id) {
    // Récupérer les détails de la souscription pour obtenir le montant à payer
    $sql = "SELECT s.*, st.price FROM subscriptions s
            JOIN subscription_types st ON s.id_type = st.id
            WHERE s.id = :subscription_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['subscription_id' => $subscription_id]);
    $subscription = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($subscription) {
        $amount = $subscription['price'];  // Montant à payer

        // Créer une commande PayPal
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => $amount
                    ]
                ]
            ],
            'application_context' => [
                'return_url' => 'http://localhost/success.php',  // URL de retour après paiement
                'cancel_url' => 'http://localhost/cancel.php'   // URL de retour en cas d'annulation
            ]
        ];

        try {
            $response = $apiContext->execute($request);
            $orderId = $response->id;
            header("Location: https://www.paypal.com/checkoutnow?token=$orderId");
            exit;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Souscription invalide.";
    }
} else {
    echo "ID de souscription manquant.";
}
?>
