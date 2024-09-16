<?php include("../include/menu.php");?>
<link rel="stylesheet" href="style.css">
<?php include("../controllers/controllers.php");?>

<?php $defaultDate = date('Y-m-d', strtotime('1990-09-12'));?>

<div class="main-container mt-3">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-2">
    <div class="d-flex align-items-center">
        <!-- Icône de retour -->
        <a href="liste_users.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0 fs-5 fs-md-4 fs-lg-3">Ajouter un administrateur</h4>

    </div>
</div>
</div>

<div class="col-md-12 col-sm-12">
    <?php include_once("script_add.php"); ?>

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
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                     <div class="mb-2">
                        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                        <input type="text" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['nom'] ?? '') ?>" class="form-control shadow-none" id="nom" name="nom">
                        <?php if(isset($erreur_champ) && empty($_POST['nom'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                     </div>
                     <div class="mb-2">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['email'] ?? '') ?>" class="form-control shadow-none" id="email" name="email">
                        <?php if(isset($erreur_champ) && empty($_POST['email'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                     </div>
                     <div class="mb-2">
                        <label for="tel">Numéro de téléphone <span class="text-danger">*</span></label><br>
                        <input type="tel" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['telephone'] ?? '') ?>" class="form-control shadow-none" id="telephone" name="telephone">
                        <?php if(isset($erreur_champ) && empty($_POST['telephone'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="">Role <span class="text-danger">*</span></label>
                        <select name="" id="role_id" class="shadow-none form-control select-custom">
                            <option disabled selected>Sélectionner un role</option>
                            <?php foreach ($all_admin_role as $all_admin_roles): ?>
                            <option value="<?php echo htmlspecialchars($all_admin_roles['id']); ?>">
                                <?php echo htmlspecialchars($all_admin_roles['role']); ?>
                            </option>
                        <?php endforeach; ?>
                        </select>
                        <?php if(isset($erreur_champ) && empty($_POST['role_id'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                   
                    </div>
                    
                    <div class="col-md-6 col-sm-12">
                        <div class="mb-2">
                            <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
                            <input type="text" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['prenom'] ?? '') ?>" class="form-control shadow-none" id="prenom" name="prenom">
                            <?php if(isset($erreur_champ) && empty($_POST['prenom'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                        </div>
                        <div class="mb-2">
                            <label for="adresse" class="form-label">Adresse <span class="text-danger">*</span></label>
                            <input type="text" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['adresse'] ?? '') ?>" class="form-control shadow-none" id="adresse" name="adresse">
                            <?php if(isset($erreur_champ) && empty($_POST['adresse'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                        </div>

                    <div class="mb-2">
                        <label for="date" class="form-label">Date de Naissance <span class="text-danger">*</span></label>
                        <input type="date" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['birthday'] ?? '') ?>" class="form-control shadow-none" id="date" name="birthday" value="<?php echo $defaultDate; ?>">
                        <?php if(isset($erreur_champ) && empty($_POST['birthday'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
    
                    <div class="mb-3">
                    <label>Photo <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                        <div>
                            <!-- L'image affichée ici -->
                            <img id="avatar" src="../vendors/images/profile.jpg" alt="Aperçu de l'image" class="rounded-circle img-fluid" width="60" height="60" style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;">
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
                    <a href="liste_users.php" class="btn btn-secondary btn-responsive ml-md-2 mb-2">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Annuler
                    </a>
                    <!-- <button type="reset" class="btn btn-secondary ml-md-2 mb-2">Annuler</button> -->
                </div>

            </form>
        </div>
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



<script src="app.js"></script>