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
  <div class="container mt-5 section-padding p-3 ">
    <div class="card-box p-3">
    <div class="d-flex align-items-center justify-content-between">
          <div class="mr-auto">
            <h4 class="mb-0">Informations de mon agence</h4>
          </div>
          <div class="ml-auto">
           <h4 class="title2">02</h4>
          </div>
          </div>
          <form action="" method="post">
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-3">
                <div class="mb-2">
              <label for="">Nom  <span class="text-danger">*</span></label>
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
                </div>
                <div class="col-md-6 col-sm-12 mb-3">
                <div class="mb-2">
              <label for="">Email <span class="text-danger">*</span></label>
              <input type="email" class="form-control shadow-none">
              </div>
              <div class="mb-2">
              <label for="">Pays <span class="text-danger">*</span></label>
              <input type="text" class="form-control shadow-none">
              </div>
              <div class="mb-2">
              <label for="">Adresse <span class="text-danger">*</span></label>
              <input type="text" class="form-control shadow-none">
              </div>
              <div class="mb-3">
                    <label>Logo <span class="text-danger">*</span></label>
                    <div class="d-flex align-items-center">
                        <div>
                            <!-- Image affichée ici -->
                            <img id="logoPreview" src="vendors/images/logo_agence.jpg" alt="Aperçu du logo" class="rounded-circle img-thumbnail profile-image" style="width: 100px; height: auto;">
                        </div>
                        <div class="ml-3 w-100 mx-2">
                            <!-- Champ d'entrée de fichier pour télécharger le logo -->
                            <input type="file" name="logo" class="shadow-none form-control" id="logoInput" accept="image/*">
                        </div>
                    </div>
                </div>
                </div>
                <div class="mb-2">
                    <label for="">Description <span class="text-danger">*</span></label>
                    <textarea name="comments" id="" class="form-control shadow-none">

                </textarea>
                </div>
                <div class="mb-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Bouton pour enregistrer -->
                <button type="submit" name="submit" class="btn btn-secondary text-white btn-responsive mb-2 mb-md-0">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Enregistrer
                </button>

                <!-- Bouton pour annuler -->
                <a href="liste_agencies.php" class="btn btn-danger btn-responsive mb-2 ml-md-2">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Annuler
                </a>

            </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</body>
</html>