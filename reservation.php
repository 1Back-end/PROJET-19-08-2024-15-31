
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="v1.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3010b1eaf1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
   
  <nav class="navbar navbar-expand-lg bg-white px-lg-2 py-3 shadow-sm fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <img src="logo.png" alt="Company Logo" width="150" height="40" class="d-inline-block align-top me-2">
      </a>
    </a>
    <button class="navbar-toggler shadow-none border-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0 text-center">
        <li class="nav-item">
          <a class="nav-link  mx-3" aria-current="page" href="index.php">Acceuil</a>
        </li>

        <li class="nav-item">
          <a class="nav-link  mx-3" aria-current="page" href="about.php">À propos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active mx-3" href="car.php">Nos véhicules</a>
        </li>

        <li class="nav-item">
          <a class="nav-link mx-3" href="contact.php">Nous contactez</a>
        </li>
      </ul>
      <div class="d-flex justify-content-center">
        <a href="login/login.php" class="login-btn shadow-none">Se connecter</a>
        </div>
    </div>
    
  </div>
</nav> 

<div class="container mt-5 section-padding p-3">
</div>
<?php include('script_reservation.php');?>
<div class="container mt-5 section-padding p-3 pb-5">
<div class="col-md-12 col-sm-12">
    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= htmlspecialchars($erreur); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($succes)): ?>
        <div class="alert alert-success text-center" role="alert">
            <?= htmlspecialchars($succes); ?>
        </div>
    <?php endif; ?>
</div>
    <div class="card-box p-3">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Informations Personnelles -->
            <div class="mb-3">
                <h3>Informations Personnelles</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="full_name">Nom complet <span class="text-danger">*</span></label>
                        <input type="text" id="full_name" name="full_name" class="shadow-none form-control" value="<?= !empty($succes) ? '' : htmlspecialchars($_POST['full_name'] ?? '') ?>">
                        <?php if(isset($erreur_champ) && empty($_POST['full_name'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" id="email" name="email" class="shadow-none form-control" value="<?= !empty($succes) ? '' : htmlspecialchars($_POST['email'] ?? '') ?>">
                        <?php if(isset($erreur_champ) && empty($_POST['email'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="phone">Numéro de téléphone <span class="text-danger">*</span></label>
                        <input type="tel" id="phone" name="phone" class="shadow-none form-control" value="<?= !empty($succes) ? '' : htmlspecialchars($_POST['phone'] ?? '') ?>">
                        <?php if(isset($erreur_champ) && empty($_POST['phone'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Informations de Réservation -->
            <div class="mb-3">
                <h3>Informations de Réservation</h3>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="start_date">Date de Début <span class="text-danger">*</span></label>
                        <input type="date" id="start_date" name="start_date" class="shadow-none form-control" value="<?= !empty($succes) ? '' : htmlspecialchars($_POST['start_date'] ?? '') ?>">
                        <?php if(isset($erreur_champ) && empty($_POST['phone'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                      <?php $carId = $_GET["id"];?>
                        <label for="end_date">Date de Fin <span class="text-danger">*</span></label>
                        <input type="date" id="end_date" name="end_date" class="shadow-none form-control" value="<?= !empty($succes) ? '' : htmlspecialchars($_POST['end_date'] ?? '') ?>">
                        <?php if(isset($erreur_champ) && empty($_POST['phone'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                        <input type="hidden" id="id_car" name="id_car" value="<?php echo $carId; ?>" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="number_of_days">Nombre de Jours de la Location <span class="text-danger">*</span></label>
                        <input type="number" id="number_of_days" name="number_of_days" class="shadow-none form-control">
                        <?php if(isset($erreur_champ) && empty($_POST['phone'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Options Supplémentaires -->
            <div class="mb-3">
                <h3>Options Supplémentaires</h3>
            </div>
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="cni">Photocopie de la CNI (Format JPG, PNG, PDF) <span class="text-danger">*</span></label>
                        <input type="file" id="cni" name="cni" accept=".jpg, .jpeg, .png, .pdf" class="form-control shadow-none">
                        <?php if(isset($erreur_champ) && empty($_POST['phone'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-2">
                        <label for="cni">Photocopie du permis (Format JPG, PNG, PDF) <span class="text-danger">*</span></label>
                        <input type="file" id="permis" name="permis" accept=".jpg, .jpeg, .png, .pdf" class="form-control shadow-none">
                        <?php if(isset($erreur_champ) && empty($_POST['phone'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-2"><br>
                        <label for="cni">Domicile <span class="text-danger">*</span></label>
                        <input type="file" id="preuve_domicile" name="preuve_domicile" class="form-control shadow-none" accept="image/*,application/pdf">
                        <?php if(isset($erreur_champ) && empty($_POST['phone'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>


                    </div>
                </div>

                <!-- <div class="col-md-4">
                    <div class="mb-2">
                    <label for="preuve_domicile">Preuve de domicile <span class="text-danger">*</span></label>
                  <input type="file" id="preuve_domicile" name="preuve_domicile" class="form-control shadow-none" accept="image/*,application/pdf" required><br><br>

                    </div>
                </div> -->
            </div>
            <div class="mb-2">
                        <label for="comments">Commentaires ou Instructions Spéciales <span class="text-danger">*</span></label>
                        <textarea id="comments" name="comments" class="shadow-none form-control" rows="3"></textarea>
              </div>

            <div class="mb-3">
                <button type="submit" name="submit" class="reservation-button border-0">Confirmer la Réservation</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const startDateInput = document.getElementById('start_date');
  const endDateInput = document.getElementById('end_date');
  const numberOfDaysInput = document.getElementById('number_of_days');

  function calculateDays() {
    const startDate = new Date(startDateInput.value);
    const endDate = new Date(endDateInput.value);
    
    if (startDate && endDate && endDate >= startDate) {
      const differenceInTime = endDate - startDate;
      const differenceInDays = Math.ceil(differenceInTime / (1000 * 3600 * 24));
      numberOfDaysInput.value = differenceInDays;
    } else {
      numberOfDaysInput.value = '';
    }
  }

  startDateInput.addEventListener('change', calculateDays);
  endDateInput.addEventListener('change', calculateDays);
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const today = new Date().toISOString().split('T')[0]; // Format YYYY-MM-DD

        // Définir la date minimale pour le champ start_date
        startDateInput.setAttribute('min', today);
        endDateInput.setAttribute('min', today);
        // Définir la date maximale pour le champ end_date

    });
    </script>
</body>
</html>
