<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de Paiement PayPal</title>
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>
</head>
<body>
    <h1>Paiement avec PayPal</h1>
    <div id="paypal-button-container"></div>
    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '50.00' // Montant en dollars (changer selon le montant de l'abonnement)
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Envoie le paiement réussi au serveur pour validation
                    fetch('process_payment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            orderID: data.orderID,
                            payerID: data.payerID
                        })
                    }).then(function(response) {
                        return response.json();
                    }).then(function(data) {
                        if (data.success) {
                            window.location.href = 'success.php'; // Redirection après paiement réussi
                        } else {
                            alert('Erreur lors du traitement du paiement.');
                        }
                    });
                });
            },
            onError: function(err) {
                console.error('Erreur lors du paiement :', err);
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
