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
      <h1 class="title1">Découvrez nos véhicules d'exception : Trouvez votre prochain compagnon de route !</h1>
            <p class="lead">
            Explorez notre large gamme de véhicules sélectionnés avec soin pour répondre à tous vos besoins. Que vous cherchiez une citadine économique, un SUV spacieux ou une voiture de luxe, nous avons le modèle parfait pour vous. Faites votre choix et partez à l'aventure dès aujourd'hui !
            </p>
      <!-- <a href="#" class="btn btn-primary btn-lg me-2 shadow-none">Voir les véhicules</a> -->
      <!-- <a href="#" class="btn btn-primary btn-lg me-2 shadow-none">Nous contacter</a> -->
    </div>
    <!-- Section Image -->
    <div class="col-md-6 col-sm-12 mb-3">
      <img src="car.png" alt="Voiture de location" class="img-fluid">
    </div>
  </div>
</div>
<div class="container mt-5 section-padding p-3 pb-5">
<div class="col-md-12 col-sm-12 mb-5">
        <div class="d-flex align-items-center justify-content-between">
            <div class="ml-auto">
            <h3 class="title2 fw-bold">
             Nos véhicules à votre portée
            </h3>
            </div>
            <form method="GET" action="">
            <div class="d-flex align-items-center gap-2 ml-auto">
                <input type="text" name="search" class="form-control py-3 shadow-none me-2" placeholder="Rechercher..." value="<?php echo htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES); ?>">
                <button type="submit" class="btn-search">Rechercher</button>
           
            </div>
            </form>

        </div>
    </div>
    
    <div class="col-md-12 col-sm-12 mb-5">
<?php include("database/database.php");?>

<div class="row">
<?php
    // Récupérer le terme de recherche
    $search = $_GET['search'] ?? '';

    // Construction de la requête SQL avec le critère de recherche
    $query = "SELECT id, model, price_per_day, seats,transmission,fuel_type, image FROM cars WHERE is_deleted = 0 AND availability_status = 'Disponible'";
    
    // Ajout de la condition de recherche si le terme est présent
    if ($search) {
        $query .= " AND (model LIKE :search OR price_per_day LIKE :search OR mileage LIKE :search OR transmission LIKE :search OR color LIKE :search)";
    }

    $stmt = $pdo->prepare($query);

    // Exécution de la requête avec le paramètre de recherche
    if ($search) {
        $stmt->execute(['search' => "%$search%"]);
    } else {
        $stmt->execute();
    }
    
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cars)) {
        echo '<div class="alert alert-danger" role="alert">Aucun résultat trouvé.</div>';
    }

    foreach ($cars as $car):
        // Séparer les images par virgule
        $images = explode(',', $car['image']);
        $firstImage = !empty($images[0]) ? $images[0] : 'default.jpg'; // Assurez-vous d'avoir une image par défaut
    ?>
    <div class="col-md-4 col-sm-6 mb-4">
        <div class="card car-card shadow-sm h-100 p-3 text-center">
            <img src="upload/<?php echo htmlspecialchars($firstImage); ?>" class="card-img-top car-image" alt="Image de <?php echo htmlspecialchars($car['model']); ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($car['model']); ?></h5>
                <p class="card-text d-flex align-items-center justify-content-between mb-3">
                    <span><?php echo htmlspecialchars($car['transmission']); ?></span>
                    <span><?php echo htmlspecialchars($car['fuel_type']); ?></span>
                    <span><?php echo htmlspecialchars($car['seats']); ?> Places</span>
                </p>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="ml-auto">
                        <h5 class="fw-bold">
                            <?php echo number_format($car['price_per_day']).'/ Jour';?>
                            
                        </h5>
                    </div>
                    <div class="mr-auto">
                    <a href="car_details.php?id=<?php echo $car['id']; ?>" class="btn btn-primary btn-sm">Voir plus</a>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>


</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>