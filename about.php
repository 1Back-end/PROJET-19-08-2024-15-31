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
   
  <nav class="navbar navbar-expand-lg bg-white px-lg-2 py-3 shadow-sm fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <img src="logo.png" alt="Company Logo" width="150" height="40" class="d-inline-block align-top me-2">
      </a>
    </a>
    <button class="navbar-toggler shadow-none border-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0 text-center">
        <li class="nav-item">
          <a class="nav-link  mx-3" aria-current="page" href="index.php">Acceuil</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active mx-3" aria-current="page" href="about.php">À propos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link mx-3" href="car.php">Nos véhicules</a>
        </li>

        <li class="nav-item">
          <a class="nav-link mx-3" href="contact.php">Nous contactez</a>
        </li>
      </ul>
      <div class="d-flex justify-content-center">
        <a href="login/login.php" class="login-btn shadow-none">Se connecter</a>
        </div>
    </div>
    
  </div>
</nav> 

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



<footer class="text-white pt-5 pb-4 bg-dark">
    <div class="container text-md-left">
        <div class="row text-md-left">
            <!-- Contact -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="mb-3 font-weight-bold">Contact</h5>
                <div class="mb-3">
                    <i class="fa fa-map-marker-alt me-3"></i>
                    <span>Yaoundé, Cameroun</span>
                </div>
                <div class="mb-3">
                    <i class="fa fa-envelope me-3"></i>
                    <span>example@gmail.com</span>
                </div>
                <div class="mb-3">
                    <i class="fa fa-clock me-3"></i>
                    <span>Lundi - Vendredi: 9 h - 17 h</span>
                </div>
            </div>

            <!-- Liens Rapides -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="mb-3 font-weight-bold">Liens Rapides</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-3">
                        <a href="index.php" class="text-decoration-none text-white"><i class="fa fa-chevron-right me-3" aria-hidden="true"></i>Accueil</a>
                    </li>
                    <li class="mb-3">
                        <a href="about.php" class="text-decoration-none text-white"><i class="fa fa-chevron-right me-3" aria-hidden="true"></i>À propos</a>
                    </li>
                    <li class="mb-3">
                        <a href="services.php" class="text-decoration-none text-white"><i class="fa fa-chevron-right me-3" aria-hidden="true"></i>Nos véhicules</a>
                    </li>
                    <li class="mb-3">
                        <a href="destinations.php" class="text-decoration-none text-white"><i class="fa fa-chevron-right me-3" aria-hidden="true"></i>Nous contactez</a>
                    </li>

                </ul>
            </div>

            <!-- Réseaux Sociaux -->
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="mb-4 font-weight-bold">Réseaux Sociaux</h5>
                <div class="social-icons">
                    <a href="https://facebook.com" class="text-decoration-none text-white mb-3 me-3" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com" class="text-decoration-none text-white mb-3 me-3" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
                    <a href="https://instagram.com" class="text-decoration-none text-white mb-3 me-3" target="_blank" rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>