<?php include("../include/menu_owners.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-8 mx-auto col-sm-12 mb-3">
    <div class="card-box p-2">
    <div class="d-flex align-items-center">
        <!-- Icône de retour -->
        <a href="liste_modeles.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0">Ajouter un modèle</h4>
    </div>
</div>
</div>
<div class="col-md-8 mx-auto col-sm-12">
<?php include("ajout_modele_traitement.php");?>

<?php if ($erreur): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($erreur) ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success text-center"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>
</div>


<div class="col-md-8 col-sm-12 mb-3 mx-auto">
    <div class="card-box p-3">
        <form action="" method="post">
            <div class="mb-2">
                <label for="">Marque <span class="text-danger">*</span></label>
                <select name="id_marque" id="" class="form-control shadow-none select-custom">
                    <option disabled selected>Sélectionner une marque</option>
                    <?php if (!empty($carBrands)): ?>
                                <?php foreach ($carBrands as $brand): ?>
                                    <option value="<?php echo htmlspecialchars($brand['id']); ?>" 
                                        <?= (isset($_POST['brand']) && $_POST['brand'] == $brand['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($brand['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option disabled>Aucune marque disponible</option>
                            <?php endif; ?>
                </select>
                <?php if(isset($erreur_champ) && empty($_POST['id_marque'])): ?>
                    <small class="text-danger"><?=$erreur_champ?></small>
                <?php endif; ?>
                
            </div>
            <div class="mb-2">
                <label for="">Modèle <span class="text-danger">*</span></label>
                <input type="text" name="modele" value="<?= !empty($success) ? '' : htmlspecialchars($_POST['modele'] ?? '') ?>" class="form-control shadow-none">
                <?php if(isset($erreur_champ) && empty($_POST['modele'])): ?>
                    <small class="text-danger"><?=$erreur_champ?></small>
                <?php endif; ?>
            </div>
            <div class="mb-2">
                <label for="">Description <span class="text-danger">*</span></label>
                <textarea name="" id="" name="description" class="form-control shadow-none"></textarea>
            </div>
            <div class="mb-5 d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <button type="submit" name="submit" class="btn btn-customize text-white btn-responsive submit_btn mb-2 mb-md-0">
                        <i class="fa fa-floppy-o fa-2x" aria-hidden="true"></i>
                            Enregistrer
                    </button>
                    <a href="liste_modeles.php" class="btn btn-secondary btn-responsive ml-md-2 mb-2">
                        <i class="fa fa-times fa-2x" aria-hidden="true"></i>
                        Annuler
                    </a>
                    <!-- <button type="reset" class="btn btn-secondary ml-md-2 mb-2">Annuler</button> -->
                </div>
        </form>
    </div>
</div>