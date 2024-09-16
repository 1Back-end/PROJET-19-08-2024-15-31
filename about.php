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
      <h1 class="title1">Un Service de location fiable et rapide</h1>
            <p class="lead">
                Chez nous, la satisfaction du client est une priorité. Nous vous offrons un service de location de véhicules rapide, fiable et sécurisé. Que vous ayez besoin d'un véhicule pour un voyage professionnel ou pour des vacances, notre équipe est là pour vous remettre les clés en toute simplicité et vous accompagner tout au long du processus.
            </p>
      <!-- <a href="#" class="btn btn-primary btn-lg me-2 shadow-none">Voir les véhicules</a> -->
      <a href="#" class="btn btn-primary btn-lg me-2 shadow-none">Nous contacter</a>
    </div>
    <!-- Section Image -->
    <div class="col-md-6 col-sm-12 mb-3">
      <img src="about.png" alt="Voiture de location" class="img-fluid">
    </div>
  </div>
</div>
<div class="container mt-5 section-padding p-3">
  <div class="col-md-12 col-sm-12 mb-3">
    <div class="row align-items-center">
      <h1 class="title1">Nos Agences</h1>
      <p class="description">
        Découvrez notre réseau d'agences réparties dans tout le pays. Chaque agence est équipée pour vous offrir un service client exceptionnel et répondre à tous vos besoins. Que vous recherchiez des conseils personnalisés, des solutions sur mesure ou un soutien local, nos agences sont prêtes à vous assister avec professionnalisme et expertise.
      </p>
    </div>
  </div>

  <div class="col-md-12 col-sm-12 mb-3">
    <?php include_once("controllers.php"); ?>
    <div class="row">
      <?php if ($agencies): ?>
        <?php foreach ($agencies as $agencie): ?>
          <div class="col-md-4 col-sm-12 mb-3">
            <div class="card-box p-3 h-100 text-center">
              <div class="card-body text-center">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="mr-auto">
                    <h5 class="card-title"><?php echo htmlspecialchars($agencie['name']); ?></h5>
                  </div>
                  <div class="ml-auto">
                    <?php if (!empty($agencie['logo'])): ?>
                      <img src="upload/<?php echo htmlspecialchars($agencie['logo']); ?>" alt="Logo" class="rounded-circle img-fluid" width="60" height="60" style="object-fit: cover; aspect-ratio: 1/1;">
                    <?php else: ?>
                      <img src="vendors/images/default_logo.jpg" alt="Logo" class="img-thumbnail rounded-circle img-fluid" width="60" height="60" style="object-fit: cover; aspect-ratio: 1/1;">
                    <?php endif; ?>  
                  </div>
                </div>
                <p class="card-text">Site web : <a href="<?php echo htmlspecialchars($agencie['url_link']); ?>" target="_blank"><?php echo htmlspecialchars($agencie['url_link']); ?></a></p>
                <p class="card-text">Adresse : <?php echo htmlspecialchars($agencie['address']); ?></p>
                <p class="card-text">Email : <?php echo htmlspecialchars($agencie['email']); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <p>Aucune agence disponible pour le moment.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>


<?php include_once("footer.php");?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>