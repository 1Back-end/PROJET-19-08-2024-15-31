<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3010b1eaf1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5  d-flex justify-content-center align-items-center">
        <div class="col-md-6 col-sm-12">
            <div class="card-box">
                <div class="mb-3 text-center">
                    <h4 class="fw-bold">Choix du profil</h4>
                    <p class="text-muted">Veuillez sélectionner votre rôle pour accéder aux fonctionnalités appropriées.</p>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2 col-sm-12">
                        <a href="login/login.php" class="btn btn-secondary btn-lg w-100">
                            <i class="fas fa-user-shield me-2"></i> Administrateur
                        </a>
                    </div>
                    <div class="col-md-6 mb-2 col-sm-12">
                        <a href="owners/login.php" class="btn btn-secondary btn-lg w-100">
                            <i class="fas fa-user-tie me-2"></i> Propriétaire
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
