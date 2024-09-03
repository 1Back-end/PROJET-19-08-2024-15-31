<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-2 d-flex align-items-center">
    
        <!-- Icône de retour -->
        <a href="liste_agencies.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0 fs-5 fs-md-4 fs-lg-3">Ajouter une agence</h4>

    </div>
</div>



<div class="col-md-12 col-sm-12">
    <?php include_once("agencies_registration.php"); ?>

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

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 mb-2 col-sm-12">
                   <div class="mb-2">
                   <label for="nom" class="form-label">Propriétaire <span class="text-danger">*</span></label>
                    <select id="ownerSelect" name="owner_id" class="shadow-none form-control select-custom">
                        <option disabled selected>Sélectionner un propriétaire</option>
                        <?php foreach ($name_owners as $name_owner): ?>
                            <option value="<?php echo htmlspecialchars($name_owner['id']); ?>">
                                <?php echo htmlspecialchars($name_owner['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if(isset($erreur_champ) && empty($_POST['owner_id'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                   </div>
                <div class="mb-2">
                    <label for="adresse" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control shadow-none" id="email" name="email">
                    <?php if(isset($erreur_champ) && empty($_POST['email'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                <div class="mb-2">
                    <label for="ville" class="form-label">Pays <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" id="country" name="country">
                    <?php if(isset($erreur_champ) && empty($_POST['country'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                <div class="mb-2">
                    <label for="adresse" class="form-label">Adresse <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" id="adresse" name="adresse">
                    <?php if(isset($erreur_champ) && empty($_POST['adresse'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label>Logo <span class="text-danger">*</span></label>
                    <div class="d-flex align-items-center">
                        <div>
                            <!-- Image affichée ici -->
                            <img id="logoPreview" src="../vendors/images/logo_agence.jpg" alt="Aperçu du logo" class="img-thumbnail profile-image" style="width: 100px; height: auto;">
                        </div>
                        <div class="ml-3 w-100">
                            <!-- Champ d'entrée de fichier pour télécharger le logo -->
                            <input type="file" name="logo" class="shadow-none form-control" id="logoInput" accept="image/*">
                        </div>
                    </div>
                    <?php if(isset($erreur_champ) && empty($_POST['logo'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                </div>
                <div class="col-md-6 mb-2 col-sm-12">
                <div class="mb-2">
                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" id="name" name="name">
                    <?php if(isset($erreur_champ) && empty($_POST['name'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                <div class="mb-2">
                    <label for="tel" class="form-label">Téléphone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" id="phone" name="phone">
                    <?php if(isset($erreur_champ) && empty($_POST['phone'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                <div class="mb-2">
                    <label for="code_postal" class="form-label">Code postal <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" id="code_postal" name="code_postal">
                    <?php if(isset($erreur_champ) && empty($_POST['code_postal'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                <div class="mb-2">
                    <label for="ville" class="form-label">Ville <span class="text-danger">*</span></label>
                    <input type="text" class="form-control shadow-none" id="ville" name="ville">
                    <?php if(isset($erreur_champ) && empty($_POST['ville'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                </div>
            </div>
            <div class="mb-2">
                <textarea name="comments" id="" class="form-control shadow-none">

                </textarea>
            </div>
            <div class="mb-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
                <!-- Bouton pour enregistrer -->
                <button type="submit" name="submit" class="btn btn-customize text-white btn-responsive mb-2 mb-md-0">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                    Enregistrer
                </button>

                <!-- Bouton pour annuler -->
                <a href="liste_agencies.php" class="btn btn-secondary btn-responsive mb-2 ml-md-2">
                    <i class="fa fa-times" aria-hidden="true"></i>
                    Annuler
                </a>

            </div>

        </form>
    </div>
</div>

<script>
document.getElementById('logoInput').addEventListener('change', function(event) {
    var input = event.target;
    var preview = document.getElementById('logoPreview');

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // Réinitialiser l'image si aucun fichier n'est sélectionné
        preview.src = '../vendors/images/logo_agence.jpg';
    }
});
</script>