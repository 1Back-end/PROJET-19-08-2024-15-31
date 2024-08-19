
<title>
	Se Connecter
	</title>
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5 pb-5 p-2">
    <div class="col-md-6 col-sm-12 mx-auto">
   
    </div>
    <div class="col-md-6 mx-auto col-sm-12">
    <div class="card-box p-3">
        <div class="mb-2 text-center">
        <h2 class="text-capitalize big_tilte">Se connecter</h2>
        </div>
        <div class="mb-2 text-center">
         <p>
            Nous sommes ravis de vous revoir ! 👍
         </p>
        </div>

        <form method="POST">
            <!-- Email Input -->
            <div class="mb-2">
                <label for="username" class="form-label">Adresse mail</label>
                <input type="email" id="username" name="username"  class="form-control form-control input-form shadow-none"  placeholder="Adresse mail">
                
            </div>

            <!-- Password Input with Toggle Visibility -->
            <div class="mb-2">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" id="password" class="shadow-none form-control form-control input-form" placeholder="***************">
            </div>

            <div class="mb-2">
            <a href="forgot_password.php" class="btn-link text-decoration-none">Mot de passe oublié</a>
            </div>
            

            <!-- Submit Button -->
            <div class="mb-2">
                <!-- Bouton avec loader -->
                    <button id="btnSubmit" name="submit" type="submit" class="btn btn-form btn-customize btn_submit btn-block text-white">
                        <span class="btn-text">Se Connecter</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                <!-- <a href="../include/menu.php" class="btn btn-form btn-customize btn_submit btn-block text-white">Se Connecter 
                </a> -->
            </div>
            <div class="mb-2">
                <div class="text-center">
                    <p>Pas encore de compte? <a href="register.php" class="btn-link text-decoration-none">Créer un compte</a></p>
                </div>
            </div>
            </div>
        </form>
    </div>
    </div>
</div>

<script>
    $(document).ready(function() {
    // Cacher l'alerte après 2 secondes (2000 ms)
    setTimeout(function() {
        $(".alert").alert('close');
    }, 2000);
});
</script>

</body>
</html>
