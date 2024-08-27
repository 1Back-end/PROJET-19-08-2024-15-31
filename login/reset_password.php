
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
	<link rel="stylesheet" href="style.css">
</head>
<body>

    <section class="wrapper">
		<div class="container">
		
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
				<div class="logo text-center">
					<img decoding="async" src="../logo.png" class="img-fluid" alt="Logo">
				</div>
				<div class="text-center">
				
				</div>
				<form class="rounded bg-white shadow py-5 px-4" method="post" id="loginForm">
					<h4 class="text-dark fw-bolder mb-3 text-center">Créer votre mot de passe</h4>
					<!-- <div class="fw-normal text-muted mb-4 text-center"> Nouveau ici ?
						<a href="registration.php" class="text-primary fw-bold text-decoration-none text-center ">Créer un compte</a>
					</div> -->
					<div class="form-floating mb-3">
						<input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
						<label for="floatingPassword">Créer un mot de passe</label>
					</div>
					
					<div class="form-floating">
						<input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
						<label for="floatingPassword">confirmer votre mot de passe</label>
					</div>
					<!-- <div class="mt-2 text-end">
						<a href="forgot_password.php" class="text-primary fw-bold text-decoration-none">Mot de passe oublié ?</a>
					</div> -->
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label ms-2" for="gridCheck">
                          Afficher le mot de passe.
                        </label>
                    </div>
					<button type="submit" name="submit" class="btn btn-primary submit_btn w-100 my-4">Soumettre</button>

				</form>
			</div>
		</div>
	</section>


	

    
</body>
</html>

