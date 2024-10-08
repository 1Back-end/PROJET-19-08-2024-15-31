
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
	<link rel="stylesheet" href="forgot_password.css">
</head>
<body> 
    <section class="wrapper">
		<div class="container">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
				<div class="logo text-center">
					<img decoding="async" src="../logo.png" class="img-fluid" alt="logo">
				</div>
				
				<div class="text-center">
				<?php include_once("script_forgot_password.php");?>
				<?php if (!empty($erreur)): ?>
					<div class="alert alert-danger text-center" role="alert">
						<?= htmlspecialchars($erreur) ?>
					</div>
				<?php endif; ?>
				</div>
				
				<form class="rounded bg-white shadow p-5" action="" method="POST">
					<h3 class="text-dark fw-bolder fs-4 mb-2 text-center">Mot de passe oublié ?</h3>

					<div class="fw-normal text-muted mb-4 text-center">
                    Entrez votre email pour réinitialiser votre mot de passe.
					</div>  

					<div class="form-floating mb-3">
						<input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
						<label for="floatingInput">Adresse email</label>
						<?php if(isset($erreur_champ)): ?>
						<small class="text-danger"><?=$erreur_champ?></small>
						<?php endif; ?>
					</div> 
                    <div class="mb-2">
					<button type="submit"  name="submit" class="btn btn-primary submit_btn w-100 my-4">Réinitialiser</button>
					</div>
					<div class="mb-2 text-center">
						<div class="text-muted">
							Je me souviens de mon mot de passe ! <a href="login.php" class="text-primary fw-bold text-decoration-none">Me connecter</a>
						</div>
					</div>

					<!-- <button type="submit" class="btn btn-primary submit_btn my-4">Soumettre</button>
                    <a href="" class="btn btn-secondary submit_btn my-4 ms-3">Annuler</a>
                    <button type="submit" class="btn btn-secondary submit_btn my-4 ms-3">Cancel</button>  -->
				</form>
			</div>
		</div>
	</section>
</body>
</html>

