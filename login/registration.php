<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../v1.png" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));?></title>
	<!-- Bootstrap 5 CDN Link -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom CSS Link -->
	<link rel="stylesheet" href="registration.css">
</head>
<body> 
    <section class="wrapper">
		<div class="container">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 text-center">
				<div class="logo">
					<img decoding="async" src="../logo.png" class="img-fluid" alt="logo">
				</div>
				<form class="rounded bg-white shadow p-5">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Créer un compte</h3>

					<div class="fw-normal text-muted mb-2">
                    Vous avez déjà un compte ? <a href="login.php" class="text-primary fw-bold text-decoration-none">Connectez-vous ici</a>
					</div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingFirstName" placeholder="name@example.com">
                        <label for="floatingFirstName">Prénom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingLastName" placeholder="name@example.com">
                        <label for="floatingLastName">Nom</label>
                    </div> 
					<div class="form-floating mb-3">
						<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Email</label>
					</div>
                    <div class="form-floating mb-3">
						<input type="tel" class="form-control" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Numéro de téléphone</label>
					</div>
                    <div class="form-floating mb-3">
						<input type="TEL" class="form-control" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Adresse</label>
					</div>
					<div class="form-floating mb-3">
						<input type="password" class="form-control" id="floatingPassword" placeholder="Password">
						<label for="floatingPassword">Mot de passe</label>
                        <span class="password-info mt-2">Utilisez 8 caractères ou plus avec un mélange de lettres, de chiffres et de symboles.</span>
					</div> 
                    <div class="form-floating mb-3">
						<input type="password" class="form-control" id="floatingPassword" placeholder="Password">
						<label for="floatingPassword">Confirmez le mot de passe</label>
                        
					</div> 
                    <!-- <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" id="gridCheck" checked>
                        <label class="form-check-label ms-2" for="gridCheck">
                          I Agree <a href="#">Terms and conditions</a>.
                        </label>
                    </div> -->
					<button type="submit" class="btn btn-primary submit_btn w-100 my-4">Enregistrer</button> 
				</form>
			</div>
		</div>
	</section>
</body>
</html>


