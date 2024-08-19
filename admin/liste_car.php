<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php
	echo strtoupper(ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF']))));
	?>
    </title>
        	<!-- Google Font -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
</head>
<body>
    <?php include("../controllers/controllers.php");?>
<div class="main-container mt-3 pb-5 p-2">
        <div class="col-md-12 col-sm-12">
        <div class="row mb-3">
    <div class="col-md-12">
        <div class="card-box p-3 h-100">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Texte en haut en mode mobile et à gauche en mode desktop -->
                <div class="mb-3 mb-md-0">
                    <h2 class="text-uppercase mb-0">Vos véhicules de luxe</h2>
                </div>
                <!-- Formulaire en bas en mode mobile et à droite en mode desktop -->
                <div class="d-flex flex-column flex-md-row align-items-center">
                    <form class="form-inline">
                        <input type="text" class="form-control shadow-none mb-2 mb-md-0" placeholder="Rechercher">
                        <button class="btn btn-customize text-white ml-md-2" type="submit">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
<div class="col-md-12 col-sm-12 mb-3">
            <div class="row">
            <div class="col-md-3 col-sm-12 mb-4">
                <div class="card-box p-3 h-100">
                    <div class="mb-2">
                        <img src="../vendors/images/pngegg(9).png" alt="DriveMate Logo" class="shadow-none car-image">
                    </div>
                    <div class="card-content text-center">
                        <h5>Voiture: E-Class</h5>
                        <p><strong>Numéro d'immatriculation:</strong> JKL7890</p>
                        <p><strong>Modèle:</strong> E-Class</p>
                        <p><strong>Sièges:</strong> 5</p>
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <a href="../login/login.php" class="btn btn-customize text-white mb-2 mb-md-0 w-100 w-md-auto mx-2">Réserver</a>
                            <a href="#" class="btn btn-customize text-white w-100 w-md-auto">Voir détails</a>
                        </div>


                    </div>
                </div>
            </div>


            <div class="col-md-3 col-sm-12 mb-4">
                <div class="card-box p-3 h-100">
                    <div class="mb-2">
                        <img src="../vendors/images/pngegg(6).png" alt="DriveMate Logo" class="shadow-none car-image">
                    </div>
                    <div class="card-content text-center">
                        <h5>Voiture: E-Class</h5>
                        <p><strong>Numéro d'immatriculation:</strong> JKL7890</p>
                        <p><strong>Modèle:</strong> E-Class</p>
                        <p><strong>Sièges:</strong> 5</p>
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <a href="../login/login.php" class="btn btn-customize text-white mb-2 mb-md-0 w-100 w-md-auto mx-2">Réserver</a>
                            <a href="#" class="btn btn-customize text-white w-100 w-md-auto">Voir détails</a>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-3 col-sm-12 mb-4">
                <div class="card-box p-3 h-100">
                    <div class="mb-2">
                        <img src="../vendors/images/pngegg(7).png" alt="DriveMate Logo" class="shadow-none car-image">
                    </div>
                    <div class="card-content text-center">
                        <h5>Voiture: E-Class</h5>
                        <p><strong>Numéro d'immatriculation:</strong> JKL7890</p>
                        <p><strong>Modèle:</strong> E-Class</p>
                        <p><strong>Sièges:</strong> 5</p>
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <a href="../login/login.php" class="btn btn-customize text-white mb-2 mb-md-0 w-100 w-md-auto mx-2">Réserver</a>
                            <a href="#" class="btn btn-customize text-white w-100 w-md-auto">Voir détails</a>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Car Information Section -->
            <div class="col-md-3 col-sm-12 mb-4">
                <div class="card-box p-3 h-100">
                    <div class="mb-2">
                        <img src="../vendors/images/pngegg(8).png" alt="Car Image" class="car-image">
                    </div>
                    <div class="card-content text-center">
                        <h5>Voiture: E-Class</h5>
                        <p><strong>Numéro d'immatriculation:</strong> JKL7890</p>
                        <p><strong>Modèle:</strong> E-Class</p>
                        <p><strong>Sièges:</strong> 5</p>
                        <div class="d-flex flex-column flex-md-row align-items-center">
                            <a href="../login/login.php" class="btn btn-customize text-white mb-2 mb-md-0 w-100 w-md-auto mx-2">Réserver</a>
                            <a href="#" class="btn btn-customize text-white w-100 w-md-auto">Voir détails</a>
                        </div>

                    </div>
                </div>
            </div>
            </div>
            <!-- Ajoutez d'autres sections ici si nécessaire -->
        </div>
    </div>


</body>
</html>