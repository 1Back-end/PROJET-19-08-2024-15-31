<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="v1.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3010b1eaf1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.2/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
include_once("controllers.php");
// Récupérer les paramètres passés via l'URL
$owner_id = $_GET['owner_id'] ?? null;
$subscription_id = $_GET['subscription_id'] ?? null;

// Récupérer les agences depuis la base de données
$sql = "SELECT id, name FROM agencies WHERE owner_id = :owner_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['owner_id' => $owner_id]);
$agencies = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$agencies) {
    echo "Aucune agence trouvée pour ce propriétaire.";
    exit;
}
?>
<div class="container mt-5">
<?php include('subscription_step2.php');?>
        <div class="col-md-6 mx-auto col-sm-12">
        <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= htmlspecialchars($erreur); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($succes)): ?>
        <div class="alert alert-success text-center" role="alert">
            <?= htmlspecialchars($succes); ?>
        </div>
    <?php endif; ?>
        </div>
<div class="row p-3">
    <div class="col-md-6 mx-auto col-sm-12 card-box p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="text-left">Choix de l'agence</h3>
            <h2 class="card-title text-right">01</h2>
        </div>
        <small class="mb-3">Veuillez sélectionner l'agence à laquelle vous souhaitez associer cet abonnement. Si vous possédez plusieurs agences, assurez-vous de choisir celle qui correspond à vos besoins actuels.</small>

        <form action="" method="post">
            <div class="mb-4">
                <select name="agency_id" id="agency" class="form-select shadow-none py-3">
                    <option disabled selected value="">Sélectionner une agence</option>
                    <?php foreach ($agencies as $agency): ?>
                        <option value="<?php echo htmlspecialchars($agency['id']); ?>">
                            <?php echo htmlspecialchars($agency['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if(isset($erreur_champ) && empty($_POST['email'])): ?>
                    <small class="text-danger"><?=$erreur_champ?></small>
                <?php endif; ?>
            </div>
            <input type="hidden" name="subscription_id" value="<?php echo htmlspecialchars($subscription_id); ?>">
            <input type="hidden" name="owner_id" value="<?php echo htmlspecialchars($owner_id); ?>">
            <button type="submit" name="submit" class="btn btn-primary w-100">Valider</button>
        </form>
    </div>
</div>
</div>
</body>
</html>