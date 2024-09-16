<?php include("../include/menu_owners.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-8 mx-auto col-sm-12 mb-3">
    <div class="card-box p-2">
    <div class="d-flex align-items-center">
        <!-- Icône de retour -->
        <a href="liste_marques.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0">Ajouter une marque</h4>
    </div>
</div>
</div>

<div class="col-md-8 mx-auto col-sm-12">
<?php include("ajout_marque_traitement.php");?>

<?php if ($erreur): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success text-center"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
</div>



<div class="col-md-8 mx-auto col-sm-12">
            <div class="card-box p-3">
            <form action="" method="post"  enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="marque">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control shadow-none" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['marque'] ?? '') ?>" id="marque" name="marque">
                            <?php if(isset($erreur_champ) && empty($_POST['marque'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="mb-2">
                            <label for="logo">Logo <span class="text-danger">*</span></label>
                            <div class="d-flex align-items-center">
                                <!-- Conteneur pour l'image affichée -->
                                <div>
                                    <img id="avatar" src="../Peugeot.png" alt="Aperçu de l'image" class="rounded-circle img-fluid" width="80" height="80" style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;">
                                </div>
                                <!-- Conteneur pour le champ d'entrée de fichier -->
                                <div class="ml-3 w-100">
                                    <input type="file" name="photo" class="form-control-file shadow-none" id="photoInput" accept="image/*">
                                </div>
                            </div>
                        </div>

                     <div class="mb-2">
                            <label for="">Description <span class="text-danger">*</span></label>
                            <textarea name="description"  class="form-control shadow-none" style="height:120px;" id="description"><?= !empty($success) ? '' : htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                            <?php if(isset($erreur_champ) && empty($_POST['description'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                            <?php endif; ?>
                </div>

                        <div class="mb-5 d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <button type="submit" name="submit" class="btn btn-customize text-white btn-responsive submit_btn mb-2 mb-md-0">
                        <i class="fa fa-floppy-o fa-2x" aria-hidden="true"></i>
                            Enregistrer
                    </button>
                    <a href="liste_users.php" class="btn btn-secondary btn-responsive ml-md-2 mb-2">
                        <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                        Annuler
                    </a>
                    <!-- <button type="reset" class="btn btn-secondary ml-md-2 mb-2">Annuler</button> -->
                </div>
                    </form>
            </div>
        </div>
           


<!-- Script pour afficher l'aperçu de l'image -->
<script>
        document.getElementById('photoInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.getElementById('avatar');
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

