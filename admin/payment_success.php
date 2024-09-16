

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
        <a href="http://localhost/grh/page/tableau_de_bord.php" class="btn btn-secondary mt-3">Retourner à l'application</a>
    </div>
</body>
</html>
