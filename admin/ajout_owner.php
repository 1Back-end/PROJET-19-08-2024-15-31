<?php include("../include/menu.php");?>
<link rel="stylesheet" href="style.css">

<?php $defaultDate = date('Y-m-d', strtotime('1990-09-12'));?>

<div class="main-container mt-3">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-2 d-flex align-items-center">
    
        <!-- Icône de retour -->
        <a href="liste_owners.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0 fs-5 fs-md-4 fs-lg-3">Ajouter un propriétaire</h4>

    </div>
</div>


<div class="col-md-12 col-sm-12">
    <?php include_once("owner_registration.php"); ?>

    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger text-center" role="alert">
            <?= htmlspecialchars($erreur); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success text-center" role="alert">
            <?= htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>
</div>



<div class="col-md-12 col-sm-12">
    <div class="card-box p-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="mb-2">
                    <label for="">Nom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" name="username" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['username'] ?? '') ?>">
                    <?php if(isset($erreur_champ) && empty($_POST['username'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                  </div>
                  <div class="mb-2">
                    <label for="">Numéro de téléphone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" name="tel" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['tel'] ?? '') ?>">
                    <?php if(isset($erreur_champ) && empty($_POST['tel'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                  </div>
                  <div class="mb-2">
                    <label for="">Pays <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" name="country" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['country'] ?? '') ?>">
                    <?php if(isset($erreur_champ) && empty($_POST['country'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                  </div>

                  <div class="mb-2">
                    <label for="">Code postal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" name="code_postal" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['code_postal'] ?? '') ?>">
                    <?php if(isset($erreur_champ) && empty($_POST['code_postal'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>

                  </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="mb-2">
                        <label for="">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control shadow-none" name="email" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['email'] ?? '') ?>">
                        <?php if(isset($erreur_champ) && empty($_POST['email'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="">Ville <span class="text-danger">*</span></label>
                        <input type="text" class="form-control shadow-none" name="ville" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['ville'] ?? '') ?>">
                        <?php if(isset($erreur_champ) && empty($_POST['ville'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                    <label for="">Adresse <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" name="adresse" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['adresse'] ?? '') ?>">
                    <?php if(isset($erreur_champ) && empty($_POST['adresse'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>

                  </div>
                  <div class="mb-3">
                    <label>Photo <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                        <div>
                            <!-- L'image affichée ici -->
                            <img id="avatar" src="../vendors/images/profile.jpg" alt="Aperçu de l'image" class="img-thumbnail profile-image">
                        </div>
                        <div class="ml-3 w-100">
                            <!-- Champ d'entrée de fichier pour télécharger l'image -->
                            <input type="file" name="photo" class="shadow-none form-control" id="photoInput" accept="image/*">
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <button type="submit" name="submit" class="btn btn-customize text-white btn-responsive submit_btn mb-2 mb-md-0">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Enregistrer
                    </button>
                    <a href="liste_owners.php" class="btn btn-secondary btn-responsive ml-md-2 mb-2">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Annuler
                    </a>
                    <!-- <button type="reset" class="btn btn-secondary ml-md-2 mb-2">Annuler</button> -->
            </div>
        </form>
    </div>
</div>


<script>
    // Sélection de l'élément input de type file
    const photoInput = document.getElementById('photoInput');

    // Écouter les changements dans l'input file
    photoInput.addEventListener('change', function() {
        const file = this.files[0]; // Récupérer le premier fichier sélectionné
        if (file) {
            const reader = new FileReader(); // Créer un objet FileReader

            // Événement déclenché lorsque la lecture du fichier est terminée
            reader.onload = function(e) {
                const imgElement = document.getElementById('avatar');
                imgElement.src = e.target.result; // Mettre à jour l'attribut src de l'élément img avec l'aperçu de l'image
            };

            // Lire le contenu du fichier en tant que URL de données
            reader.readAsDataURL(file);
        }
    });
</script>


