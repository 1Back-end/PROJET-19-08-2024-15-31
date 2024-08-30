<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 mx-auto col-sm-12 mb-3">
    <div class="card-box p-2">
    <div class="d-flex align-items-center">
        <!-- Icône de retour -->
        <a href="liste_car.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0">Ajouter un véhicule</h4>
    </div>
</div>
</div>

<?php include("ajout_car_traitement.php");?>
<div class="col-md-12 col-sm-12">
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
                <!-- Marque -->
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="mb-2">
                        <label for="brand">Marque <span class="text-danger">*</span></label>
                        <select name="brand" id="brand" class="form-control select-custom shadow-none">
                            <option  disabled selected value="">Sélectionner une marque</option>
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
                        <?php if(isset($erreur_champ) && empty($_POST['brand'])): ?>
                            <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>

                <div class="mb-2">
                <label for="carYear">Année de fabrication <span class="text-danger">*</span></label>
                <select name="carYear" id="carYear" class="form-control select-custom shadow-none">
                    <option disabled selected value="">Sélectionner une année</option>
                    <?php foreach ($years as $year): ?>
                        <option value="<?php echo htmlspecialchars($year); ?>" 
                            <?= (isset($_POST['carYear']) && $_POST['carYear'] == $year) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($year); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if(isset($erreur_champ) && empty($_POST['carYear'])): ?>
                    <small class="text-danger"><?=$erreur_champ?></small>
                <?php endif; ?>
                </div>

                <div class="mb-2">
            <label for="transmissionType">Type de transmission <span class="text-danger">*</span></label>
            <select name="transmissionType" id="transmissionType" class="form-control select-custom shadow-none">
                <option disabled selected value="">Sélectionner un type de transmission</option>
                <?php foreach ($transmissionTypes as $transmission): ?>
                    <option value="<?php echo htmlspecialchars($transmission); ?>" 
                        <?= (isset($_POST['transmissionType']) && $_POST['transmissionType'] == $transmission) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($transmission); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if(isset($erreur_champ) && empty($_POST['transmissionType'])): ?>
                    <small class="text-danger"><?=$erreur_champ?></small>
                <?php endif; ?>
                </div>

                <div class="mb-2">
                <label for="color">Couleur <span class="text-danger">*</span></label>
                <select name="color" id="color" class="form-control select-custom shadow-none">
                    <option disabled selected value="">Sélectionner une couleur</option>
                    <?php foreach ($colors as $color): ?>
                        <option value="<?php echo htmlspecialchars($color); ?>" 
                            <?= (isset($_POST['color']) && $_POST['color'] == $color) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($color); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if(isset($erreur_champ) && empty($_POST['color'])): ?>
                    <small class="text-danger"><?=$erreur_champ?></small>
                <?php endif; ?>
                </div>

                <div class="mb-2">
                    <label for="price_per_day">Prix par jour <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        id="price_per_day" 
                        name="price_per_day" 
                        class="form-control shadow-none"
                        value="<?php echo isset($_POST['price_per_day']) ? htmlspecialchars($_POST['price_per_day']) : ''; ?>"
                    >
                    <?php if(isset($erreur_champ) && empty($_POST['price_per_day'])): ?>
                    <small class="text-danger"><?=$erreur_champ?></small>
                    <?php endif; ?>
                </div>

                <div class="mb-2">
                    <label for="documents" class="mb-0">Documents <span class="text-danger">*</span></label>
                    <input 
                        
                        type="file" 
                        name="documents[]" 
                        id="documents" 
                        class="form-control shadow-none" 
                        multiple 
                        accept=".pdf, .doc, .docx, .jpg, .png"
                    >
                    <?php if (isset($erreur_champ) && empty($_POST['documents'])): ?>
                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                <?php endif; ?>
                </div>
                

</div>

                <!-- Autre champ -->
                <div class="col-md-6 col-sm-12 mb-3">
                   <div class="mb-2">
                   <label for="modele" class="mb-0">Modèle <span class="text-danger">*</span></label>
                   <select 
                            name="modele" 
                            id="modele" 
                            class="form-control select-custom shadow-none"
                        >
                            <option disabled <?= empty($_POST['modele']) ? 'selected' : ''; ?> value="">Sélectionner un modèle</option>
                            <?php foreach ($carModels as $model): ?>
                                <option 
                                    value="<?php echo htmlspecialchars($model); ?>" 
                                    <?= (isset($_POST['modele']) && $_POST['modele'] === $model) ? 'selected' : ''; ?>
                                >
                                    <?php echo htmlspecialchars($model); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                    <?php if (isset($erreur_champ) && empty($_POST['modele'])): ?>
                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                <?php endif; ?>
                </div>
                   
                <div class="mb-2">
                    <label for="">Type de carburant <span class="text-danger">*</span></label>
                <select 
                        name="fuelType" 
                        id="fuelType" 
                        class="form-control select-custom shadow-none"
                    >
                        <option disabled <?= empty($_POST['fuelType']) ? 'selected' : ''; ?> value="">Sélectionner un type de carburant</option>
                        <?php foreach ($fuelTypes as $fuel): ?>
                            <option 
                                value="<?php echo htmlspecialchars($fuel); ?>" 
                                <?= (isset($_POST['fuelType']) && $_POST['fuelType'] === $fuel) ? 'selected' : ''; ?>
                            >
                                <?php echo htmlspecialchars($fuel); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <?php if (isset($erreur_champ) && empty($_POST['fuelType'])): ?>
                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                <?php endif; ?>
                </div>

                <div class="mb-2">
                <label for="availableSeats">Nombre de sièges <span class="text-danger">*</span></label>
                <select 
                    name="availableSeats" 
                    id="availableSeats" 
                    class="form-control select-custom shadow-none"
                >
                    <option disabled <?= empty($_POST['availableSeats']) ? 'selected' : ''; ?> value="">Sélectionner un nombre de sièges</option>
                    <?php foreach ($seats as $seat): ?>
                        <option 
                            value="<?php echo htmlspecialchars($seat); ?>" 
                            <?= (isset($_POST['availableSeats']) && $_POST['availableSeats'] == $seat) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($seat); ?>
                        </option>
                    <?php endforeach; ?>
            </select>
                <?php if (isset($erreur_champ) && empty($_POST['availableSeats'])): ?>
                <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                <?php endif; ?>
            </div>
                <div class="mb-2">
                <label for="mileage">Kilométrage <span class="text-danger">*</span></label>
                <select 
                    name="mileage" 
                    id="mileage" 
                    class="form-control select-custom shadow-none"
                >
                    <option disabled <?= empty($_POST['mileage']) ? 'selected' : ''; ?> value="">Sélectionner un kilométrage</option>
                    <?php foreach ($mileages as $mileage): ?>
                        <option 
                            value="<?php echo htmlspecialchars($mileage); ?>" 
                            <?= (isset($_POST['mileage']) && $_POST['mileage'] == $mileage) ? 'selected' : ''; ?>
                        >
                            <?php echo number_format($mileage, 0, ',', ' '); ?> km
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if (isset($erreur_champ) && empty($_POST['mileage'])): ?>
                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                <?php endif; ?>
            </div>
            
                            <!-- Date d'expiration de l'assurance -->
    <div class="mb-2">
        <label for="insurance_expiration" class="mb-0">
            Date d'expiration de l'assurance <span class="text-danger">*</span>
        </label>
        <input 
            type="date" 
            id="insurance_expiration" 
            name="insurance_expiration" 
            class="form-control shadow-none"
            value="<?= isset($_POST['insurance_expiration']) ? htmlspecialchars($_POST['insurance_expiration']) : ''; ?>"
        >
        <?php if (isset($erreur_champ) && empty($_POST['insurance_expiration'])): ?>
            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
        <?php endif; ?>
    </div>



    <div class="row mb-3 align-items-center">
            <div class="col-md-6">
                <label for="photos" class="form-label">Télécharger les photos du véhicule <span class="text-danger">*</span></label>
                <input
                    type="file"
                    name="photos[]"
                    id="photos"
                    class="form-control"
                    multiple
                    accept=".jpg, .jpeg, .png"
                    onchange="previewPhoto()"
                >
                <?php if (isset($erreur_champ) && empty($_FILES['photos']['name'][0])): ?>
                    <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
                <?php endif; ?>
            </div>

    
        </div>
        </div>
            </div>

            <div class="mb-2">
        <label for="notes" class="mb-0">Note <span class="text-danger">*</span></label>
        <textarea 
            name="notes" 
            id="notes" 
            class="form-control shadow-none" 
            rows="4" 
            style="height:100px"
        ><?= isset($_POST['notes']) ? htmlspecialchars($_POST['notes']) : ''; ?></textarea>
        <?php if (isset($erreur_champ) && empty($_POST['notes'])): ?>
            <small class="text-danger"><?= htmlspecialchars($erreur_champ) ?></small>
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


<script>
        function previewPhoto() {
            var input = document.getElementById('photos');
            var preview = document.getElementById('photo-preview');
            var previewImage = document.getElementById('preview-image');

            // Assurez-vous que le champ de fichier contient des fichiers
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Afficher l'image dans la zone de prévisualisation
                    preview.style.display = 'block';
                    previewImage.src = e.target.result;
                };

                // Lire le premier fichier sélectionné
                reader.readAsDataURL(input.files[0]);
            } else {
                // Cacher la zone de prévisualisation si aucun fichier n'est sélectionné
                preview.style.display = 'none';
                previewImage.src = '';
            }
        }
    </script>
