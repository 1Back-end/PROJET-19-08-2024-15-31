<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
    <!-- Header -->
   <?php include("navbar.php");?>
  
  <div class="container mt-5 section-padding p-3 ">
  </div>
  <div class="container mt-5 section-padding p-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
       <h2 class="title2">Créer votre compte pour bénéficier des services de notre plateforme</h2>
    </div>
    <div class="col-md-12 col-sm-12 mb-2">
      <p>Créez votre compte pour accéder à nos services exclusifs et simplifier la gestion de vos opérations. Profitez d'une expérience personnalisée et de nombreux avantages dès aujourd'hui !</p>
    </div>
    <div class="col-md-12 col-sm-12 mb-3">
      <div class="card-box p-3">
        <div class="d-flex align-items-center justify-content-between">
          <div class="mr-auto">
            <h4 class="mb-0">Informations personnelles</h4>
          </div>
          <div class="ml-auto">
           <h4 class="title2">01</h4>
          </div>
        </div>
        <form action="" method="post">
          <div class="row">
            <div class="col-md-6 col-sm-12 mb-3">
              <div class="mb-2">
              <label for="">Nom complet <span class="text-danger">*</span></label>
              <input type="text" class="form-control shadow-none">
              </div>
              <div class="mb-2">
              <label for="">Numéro de téléphone <span class="text-danger">*</span></label>
              <input type="tel" class="form-control shadow-none">
              </div>
              <div class="mb-2">
                <label for="">Ville <span class="text-danger">*</span></label>
                <input type="text" class="form-control shadow-none">
              </div>
              <div class="mb-2">
                <label for="">Code postal <span class="text-danger">*</span></label>
                <input type="text" class="form-control shadow-none">
              </div>
              <div class="mb-2">
              <label for="">Mot de passe<span class="text-danger">*</span></label>
              <input type="password" class="form-control shadow-none py-2">
             </div>
            </div>
            <div class="col-md-6 col-sm-12 mb-3">
             <div class="mb-2">
             <label for="">Email <span class="text-danger">*</span></label>
             <input type="email" class="shadow-none form-control">
             </div>
             <div class="mb-2">
             <label for="">Pays <span class="text-danger">*</span></label>
             <input type="text" class="shadow-none form-control">
             </div>
             <div class="mb-2">
              <label for="">Adresse</label>
              <input type="text" class="form-control shadow-none">
             </div>
             
             <div class="mb-2">
                    <label>Photo <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                        <div>
                            <!-- L'image affichée ici -->
                            <img id="avatar" src="vendors/images/profile.jpg" alt="Aperçu de l'image" class="rounded-circle img-fluid" width="60" height="60" style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;">
                        </div>
                        <div class="ml-3 w-100 mx-3">
                            <!-- Champ d'entrée de fichier pour télécharger l'image -->
                            <input type="file" name="photo" class="shadow-none form-control" id="photoInput" accept="image/*">
                        </div>
                    </div>
                    </div>
                    <div class="mb-2">
              <label for="">Confirmer votre mot de passe<span class="text-danger">*</span></label>
              <input type="password" class="form-control shadow-none py-2">
             </div>
                </div>
                
            </div>
            <div class="mb-5 d-flex flex-column flex-md-row align-items-center justify-content-between">
            <a href="liste_owners.php" class="btn btn-danger btn-responsive ml-md-2 mb-2">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Annuler
                    </a>
                    <a href="create_agency.php" class="btn btn-secondary btn-responsive ml-md-2 mb-2">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Suivant
                    </a>
                    <!-- <button type="submit" name="submit" class="btn btn-secondary btn-lg">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Suivant
                    </button> -->
                    
                    <!-- <button type="reset" class="btn btn-secondary ml-md-2 mb-2">Annuler</button> -->
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>