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
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/main.css">
</head>
<body>
<div class="main-container mt-5 p-0">
        <div class="col-md-4 col-sm-12 mx-auto">
            <div class="card-box p-3 text-center">
            <div class="mb-3">
            <img src="vendors/images/logo.png" alt="" class="shadow-none logo-image">
            </div>
            <div class="mb-3">
            <h5>Bienvenue sur DriveMate!</h5>
            <p>Bienvenue sur DriveMate ! Louez facilement votre voiture idéale et transformez chaque trajet en une aventure sans tracas.</p>
            </div>
            <div class="mb-2">
                <a href="admin/liste_car.php" class="btn btn-customize text-white">Cliquer pour continuer</a>
            </div>
            </div>
        </div>
    </div>
</body>
</html>