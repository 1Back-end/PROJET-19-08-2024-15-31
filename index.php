<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="v1.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3010b1eaf1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
   
  <!-- Header -->
   <?php include("navbar.php");?>
  
<div class="container mt-5 section-padding p-3">
</div>

<div class="container mt-5 section-padding p-3">
  <div class="row align-items-center">
    <!-- Section Titre et Description -->
    <div class="col-md-6 col-sm-12 mb-3">
      <h1 class="title1">Louez votre voiture en toute simplicité</h1>
      <p class="lead">
        Découvrez notre large gamme de véhicules disponibles à la location. Que vous ayez besoin d'une voiture compacte pour la ville ou d'un SUV pour un voyage en famille, nous avons ce qu'il vous faut.
      </p>
      <a href="car.php" class="btn btn-primary btn-lg me-2 shadow-none">Voir les véhicules</a>
      <a href="#" class="btn btn-primary btn-lg me-2 shadow-none">Nous contacter</a>
    </div>
    <!-- Section Image -->
    <div class="col-md-6 col-sm-12 mb-3">
      <img src="v1.png" alt="Voiture de location" class="img-fluid">
    </div>
  </div>
</div>


<div class="container mt-5 section-padding p-3">
    <div class="col-md-12 col-sm-12 mb-3">
    <h2 class="text-center title2">Nos services</h2>
    </div>
    <div class="col-md-12 col-sm-12 mb-3">
        <div class="row">
        <div class="col-md-4 col-sm-12 mb-4">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body d-flex flex-column align-items-center">
            <div class="icon mb-3">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <h5 class="card-title mb-3">Location à court terme</h5>
            <p class="card-text">
                Idéal pour les voyages de courte durée ou les besoins temporaires. Choisissez parmi notre large gamme de véhicules modernes.
            </p>
            <a href="" class="btn btn-secondary btn-lg me-2 shadow-none">Lire plus</a>
            </div>
        </div>
        </div>


        <div class="col-md-4 col-sm-12 mb-4">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body d-flex flex-column align-items-center">
            <div class="icon mb-3">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <h5 class="card-title mb-3">Location à long terme</h5>
            <p class="card-text">
            Parfait pour les besoins prolongés. Profitez de tarifs avantageux et de la flexibilité pour des périodes plus longues.
            </p>
            <a href="" class="btn btn-secondary btn-lg me-2 shadow-none">Lire plus</a>
            </div>
        </div>
        </div>


        <div class="col-md-4 col-sm-12 mb-4">
        <div class="card shadow-sm text-center h-100">
            <div class="card-body d-flex flex-column align-items-center">
            <div class="icon mb-3">
                <i class="fa-solid fa-screwdriver-wrench"></i>
            </div>
            <h5 class="card-title mb-3">Service Premium</h5>
            <p class="card-text">
            Pour une expérience de conduite luxueuse, optez pour nos véhicules premium avec toutes les commodités.
            </p>
            <a href="" class="btn btn-secondary btn-lg me-2 shadow-none">Lire plus</a>
            </div>
        </div>
        </div>

            
        </div>
    </div>
</div>

<div class="container mt-5 section-padding p-3">
        <h2 class="text-center mb-4 title2">Nos Abonnements</h2>
        <?php include_once("controllers.php"); ?>
        <!-- Affichage des abonnements -->
<div class="row">
    <?php if ($abonnements): ?>
        <?php foreach ($abonnements as $abonnement): ?>
            <div class="col-md-3 col-sm-12 mb-4">
                <div class="card border-primary card-box h-100">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?php echo htmlspecialchars($abonnement['name']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($abonnement['description']); ?></p>
                        <h6 class="card-subtitle mb-2 text-muted">Prix : <?php echo htmlspecialchars($abonnement['price']); ?> FCFA</h6>
                        <p class="card-text">Limite de véhicules : <?php echo htmlspecialchars($abonnement['vehicle_limit']); ?></p>
                        <p class="card-text">Durée : <?php echo htmlspecialchars($abonnement['duration_in_months']); ?> mois</p>
                        <a href="subscribe_email.php?id=<?php echo htmlspecialchars($abonnement['id']); ?>" class="btn btn-primary btn-subscribe">Souscrire <i class="fas fa-check"></i></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <p>Aucun abonnement disponible pour le moment.</p>
        </div>
    <?php endif; ?>
</div>

    </div>



<?php include_once("footer.php");?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>