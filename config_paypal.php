<?php
require 'vendor/autoload.php';

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

$clientId = 'Abn8-wTG6AgP2Q-IZrOvqv3A8dwvtKax-Pjw8pBY_LLe9osVXDRfBht7f3r-oguQ67WoR-IuxPym4eZN';
$clientSecret = 'EKjnsVurSnvBc957wvsQdowiP56s-_cWqpXE29AdUTP1Uxnxj3oANkFdaA3VTfFp6bIf_iAEevxWKcN5';

$environment = new SandboxEnvironment($clientId, $clientSecret); // Utiliser ProductionEnvironment pour la production
$client = new PayPalHttpClient($environment);

return $client;
?>
