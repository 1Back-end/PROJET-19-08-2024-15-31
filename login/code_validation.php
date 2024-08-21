

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
	<link rel="stylesheet" href="code_validation.css">
</head>
<body> 
    <section class="wrapper">
		<div class="container">
			<div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3 text-center">
				<div class="logo">
					<img decoding="async" src="../logo.png" class="img-fluid" alt="logo">
				</div>
				<form class="rounded bg-white shadow p-5">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Taper votre code</h3>

					<div class="fw-normal text-muted mb-4">
                    Vous avez reçu un code dans votre compte e-mail !
					</div>  
					<div class="otp_input text-start mb-2">
						<div class="d-flex align-items-center justify-content-between mt-2">
                            <input type="text" class="form-control" placeholder="">
                            <input type="text" class="form-control" placeholder="">
                            <input type="text" class="form-control" placeholder="">
                            <input type="text" class="form-control" placeholder="">
                            <input type="text" class="form-control" placeholder="">
                            <input type="text" class="form-control" placeholder="">
                        </div> 
					</div>  

					<button type="submit" class="btn btn-primary submit_btn my-4">Soumettre</button> 

                    <div class="fw-normal text-muted mb-2">
                    Vous n'avez pas reçu le code ? <a href="#" class="text-primary fw-bold text-decoration-none">Renvoyer</a>
					</div>
				</form>
			</div>
		</div>
	</section>
</body>
</html>

