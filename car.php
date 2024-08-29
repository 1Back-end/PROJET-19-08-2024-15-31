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
          <a class="nav-link  mx-3" aria-current="page" href="about.php">À propos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active mx-3" href="car.php">Nos véhicules</a>
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
        <div class="text-center">
            <h2 class="fw-bold text-uppercase title2">
                Nos véhicules à votre portée
            </h2>
            <p class="mt-3">
                Découvrez notre vaste sélection de véhicules adaptés à tous vos besoins. Que vous recherchiez une berline élégante, un SUV spacieux, ou une voiture économique, nous avons ce qu'il vous faut pour vous déplacer en toute sérénité. Explorez nos offres et trouvez le véhicule qui vous correspond.
            </p>
        </div>
    </div>
</div>



    <div class="container section-padding p-3 pb-5">
    <div class="row">
    <?php include_once("controllers.php"); ?>
    <!-- Search Section on the Left -->
    <div class="col-md-4 col-sm-12 mb-3">
        <div class="card-info p-3">
          <h4 class="card-title mb-3">Options de recherche</h4>
            <form method="get" action="">
                <div class="mb-3">
                    <label for="carBrand">Marque</label>
                    <select name="carBrand" id="carBrand" class="form-select shadow-none py-3">
                        <option disabled selected>Sélectionner une marque</option>
                        <?php if ($carBrands && count($carBrands) > 0): ?>
                            <?php foreach ($carBrands as $brand): ?>
                                <option value="<?= htmlspecialchars($brand['id']) ?>" <?= isset($_GET['carBrand']) && $_GET['carBrand'] == $brand['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($brand['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option disabled>Aucune marque disponible</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="carModel">Modèle</label>
                    <select name="carModel" id="carModel" class="form-select shadow-none py-3">
                        <option disabled selected>Sélectionner un modèle</option>
                        <?php foreach ($carModels as $model): ?>
                            <option value="<?= htmlspecialchars($model) ?>" <?= isset($_GET['carModel']) && $_GET['carModel'] == $model ? 'selected' : '' ?>>
                                <?= htmlspecialchars($model) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="transmission">Transmission</label>
                    <select name="transmission" id="transmission" class="form-select shadow-none py-3">
                        <option disabled selected>Sélectionner une transmission</option>
                        <?php foreach ($transmissionTypes as $transmissionType): ?>
                            <option value="<?= htmlspecialchars($transmissionType) ?>" <?= isset($_GET['transmission']) && $_GET['transmission'] == $transmissionType ? 'selected' : '' ?>>
                                <?= htmlspecialchars($transmissionType) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="fuelType">Type de carburant</label>
                    <select name="fuelType" id="fuelType" class="form-select shadow-none py-3">
                        <option disabled selected>Sélectionner un type de carburant</option>
                        <?php foreach ($fuelTypes as $fuelType): ?>
                            <option value="<?= htmlspecialchars($fuelType) ?>" <?= isset($_GET['fuelType']) && $_GET['fuelType'] == $fuelType ? 'selected' : '' ?>>
                                <?= htmlspecialchars($fuelType) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mileage">Kilométrage</label>
                    <select name="mileage" id="mileage" class="form-select shadow-none py-3">
                        <option disabled selected>Sélectionner un kilométrage</option>
                        <?php foreach ($mileages as $mileage): ?>
                            <option value="<?= htmlspecialchars($mileage) ?>" <?= isset($_GET['mileage']) && $_GET['mileage'] == $mileage ? 'selected' : '' ?>>
                                <?= number_format($mileage, 0, ',', ' ') ?> Km
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn-search btn-block">Rechercher</button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Vehicle Section on the Right -->
    <div class="col-md-8 col-sm-12 mb-3">              
        <div class="row">
            <?php
            include("database/database.php");

            // Retrieve search term and current page
            $search = $_GET['search'] ?? '';
            $carBrand = $_GET['carBrand'] ?? '';
            $carModel = $_GET['carModel'] ?? '';
            $transmission = $_GET['transmission'] ?? '';
            $fuelType = $_GET['fuelType'] ?? '';
            $mileage = $_GET['mileage'] ?? '';
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 4;
            $offset = ($page - 1) * $limit;

            // Construct SQL query with search criteria
            $query = "SELECT id, model, price_per_day, seats, transmission, fuel_type, image 
                      FROM cars 
                      WHERE is_deleted = 0 AND availability_status = 'Disponible'";

            // Add search conditions
            if ($carBrand) {
                $query .= " AND brand_id = :carBrand";
            }
            if ($carModel) {
                $query .= " AND model LIKE :carModel";
            }
            if ($transmission) {
                $query .= " AND transmission LIKE :transmission";
            }
            if ($fuelType) {
                $query .= " AND fuel_type LIKE :fuelType";
            }
            if ($mileage) {
                $query .= " AND mileage LIKE :mileage";
            }

            // Add pagination
            $query .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";

            $stmt = $pdo->prepare($query);

            // Bind parameters for search and pagination
            if ($carBrand) {
                $stmt->bindValue(':carBrand', $carBrand, PDO::PARAM_INT);
            }
            if ($carModel) {
                $stmt->bindValue(':carModel', "%$carModel%", PDO::PARAM_STR);
            }
            if ($transmission) {
                $stmt->bindValue(':transmission', "%$transmission%", PDO::PARAM_STR);
            }
            if ($fuelType) {
                $stmt->bindValue(':fuelType', "%$fuelType%", PDO::PARAM_STR);
            }
            if ($mileage) {
                $stmt->bindValue(':mileage', "%$mileage%", PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();
            $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($cars)) {
                echo '<div class="alert alert-danger text-center" role="alert">Aucun résultat trouvé.</div>';
            } else {
                foreach ($cars as $car):
                    // Separate images by comma
                    $images = explode(',', $car['image']);
                    $firstImage = !empty($images[0]) ? $images[0] : 'default.jpg'; // Ensure default image exists
            ?>
                    <div class="col-md-6 col-sm-12 mb-4">
                        <div class="card car-card h-100 p-3 text-center">
                            <img src="upload/<?php echo htmlspecialchars($firstImage); ?>" class="card-img-top car-image mb-3" alt="Image de <?php echo htmlspecialchars($car['model']); ?>">
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
                                            <?php echo number_format($car['price_per_day']).' / Jour'; ?>
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
            <?php } ?>
        </div>

        <!-- Pagination -->
        <?php if (!empty($cars)): ?>
            <nav>
                <ul class="pagination justify-content-center shadow-none">
                    <?php if($page > 1): ?>
                        <li class="page-item shadow-none">
                            <a class="page-link shadow-none" href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>&carBrand=<?php echo urlencode($carBrand); ?>&carModel=<?php echo urlencode($carModel); ?>&transmission=<?php echo urlencode($transmission); ?>&fuelType=<?php echo urlencode($fuelType); ?>&mileage=<?php echo urlencode($mileage); ?>">
                                Précédent
                            </a>
                        </li>
                    <?php endif; ?>
                    <li class="page-item shadow-none">
                        <a class="page-link shadow-none" href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>&carBrand=<?php echo urlencode($carBrand); ?>&carModel=<?php echo urlencode($carModel); ?>&transmission=<?php echo urlencode($transmission); ?>&fuelType=<?php echo urlencode($fuelType); ?>&mileage=<?php echo urlencode($mileage); ?>">
                            Suivant
                        </a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
</div>


<?php include_once("footer.php");?>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>