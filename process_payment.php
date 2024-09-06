<?php
require 'config_paypal.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$orderID = $input['orderID'] ?? null;
$payerID = $input['payerID'] ?? null;

if ($orderID && $payerID) {
    try {
        $request = new \PayPalCheckoutSdk\Orders\OrdersCaptureRequest($orderID);
        $response = $client->execute($request);

        if ($response->statusCode === 200) {
            // Paiement réussi
            echo json_encode(['success' => true]);
        } else {
            // Erreur lors du traitement du paiement
            echo json_encode(['success' => false, 'error' => 'Échec du paiement']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Données de paiement manquantes']);
}
?>
