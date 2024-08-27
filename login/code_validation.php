

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
				<div class="text-center">
	
				<?php include("verify_code.php");?>
				<?php if (!empty($ErreurMessage)) : ?>
            <div id="successAlert" class="alert alert-danger">
                <?php echo $ErreurMessage; ?>
            </div>
			<?php endif; ?>
			<?php if (!empty($SuccesMessage)) : ?>
				<div id="errorAlert" class="alert alert-success">
					<?php echo $SuccesMessage; ?>
				</div>
			<?php endif; ?>

				

				
				<form class="rounded bg-white shadow p-5" action="" method="POST">
					<h3 class="text-dark fw-bolder fs-4 mb-2">Taper votre code</h3>

					<div class="fw-normal text-muted mb-4">
                    Vous avez reçu un code dans votre compte e-mail !
					</div>  
					<div class="otp_input text-start mb-2">
					<div class="d-flex align-items-center justify-content-between mt-2">
						<input type="text" class="form-control otp-input font-14" placeholder="" name="code1" id="code1" maxlength="1">
						<input type="text" class="form-control otp-input font-14" placeholder="" name="code2" id="code2" maxlength="1">
						<input type="text" class="form-control otp-input font-14" placeholder="" name="code3" id="code3" maxlength="1">
						<input type="text" class="form-control otp-input font-14" placeholder="" name="code4" id="code4" maxlength="1">
						<input type="text" class="form-control otp-input font-14" placeholder="" name="code5" id="code5" maxlength="1">
						<input type="text" class="form-control otp-input font-14" placeholder="" name="code6" id="code6" maxlength="1">
					</div>
				</div>
				<input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_GET['user_id']); ?>">

				<button type="submit" name="submit" class="btn btn-primary submit_btn my-4">Soumettre</button> 

				<div class="fw-normal text-muted mb-2">
					Vous n'avez pas reçu le code ? 
					<a href="?resend_code=1&user_id=<?php echo isset($_GET['user_id']) ? htmlspecialchars($_GET['user_id']) : ''; ?>" class="text-primary fw-bold text-decoration-none">Renvoyer</a>
				</div>

				</form>
			</div>
		</div>
	</section>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll(".otp-input");

    inputs.forEach((input, index) => {
        input.addEventListener("keyup", (e) => {
            if (e.key >= "0" && e.key <= "9") {
                // Si l'utilisateur entre un chiffre, passer au champ suivant
                if (index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            } else if (e.key === "Backspace") {
                // Si l'utilisateur appuie sur Backspace, revenir au champ précédent
                if (index > 0 && !input.value) {
                    inputs[index - 1].focus();
                }
            }
        });
    });
});

	</script>
<script>
    // Fonction pour masquer l'élément après un délai
    function hideAlert(id) {
        const element = document.getElementById(id);
        if (element) {
            setTimeout(() => {
                element.style.transition = 'opacity 0.5s ease';
                element.style.opacity = '0';
                setTimeout(() => element.style.display = 'none', 500); // Masquer complètement après l'animation
            }, 3000); // 3000 ms = 3 secondes
        }
    }

    // Masquer les messages après 3 secondes
    hideAlert('errorAlert');
    hideAlert('successAlert');
</script>
</script>
</body>
</html>

