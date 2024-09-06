<?php
require 'vendor/autoload.php';

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

$orderId = $_GET['token'] ?? null;

if ($orderId) {
    $request = new OrdersCaptureRequest($orderId);

    try {
        $response = $apiContext->execute($request);
        // Traitement après confirmation du paiement
        echo "Paiement réussi. Vous pouvez maintenant accéder à vos services.";
        // Ici, vous pouvez mettre à jour le statut de la souscription dans la base de données
    } catch (Exception $e) {
        echo "Erreur: " . $e->getMessage();
    }
} else {
    echo "ID de commande manquant.";
}
?>
