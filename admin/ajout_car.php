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

<div class="col-md-12 col-sm-12">
    <div class="card-box p-3">
        <form action="" method="post">
            <div class="row">
                <!-- Marque -->
                <div class="col-md-6 col-sm-12 mb-3">
                    <div class="mb-2">
                        <label for="brand">Marque <span class="text-danger">*</span></label>
                        <select name="brand" id="brand" class="form-control select-custom shadow-none">
                            <option disabled selected value="">Sélectionner une marque</option>
                            <?php if (!empty($carBrands)): ?>
                                <?php foreach ($carBrands as $brand): ?>
                                    <option value="<?php echo htmlspecialchars($brand['id']); ?>">
                                        <?php echo htmlspecialchars($brand['name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option disabled>Aucune marque disponible</option>
                            <?php endif; ?>
                        </select>
                    </div>

                <div class="mb-2">
                <label for="carYear">Année de fabrication <span class="text-danger">*</span></label>
                <select name="carYear" id="carYear" class="form-control select-custom shadow-none">
                    <option disabled selected value="">Sélectionner une année</option>
                    <?php foreach ($years as $year): ?>
                        <option value="<?php echo htmlspecialchars($year); ?>"><?php echo htmlspecialchars($year); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="mb-2">
            <label for="transmissionType">Type de transmission <span class="text-danger">*</span></label>
            <select name="transmissionType" id="transmissionType" class="form-control select-custom shadow-none">
                <option disabled selected value="">Sélectionner un type de transmission</option>
                <?php foreach ($transmissionTypes as $transmission): ?>
                    <option value="<?php echo htmlspecialchars($transmission); ?>"><?php echo htmlspecialchars($transmission); ?></option>
                <?php endforeach; ?>
            </select>
                </div>

                <div class="mb-2">
                <label for="color">Couleur <span class="text-danger">*</span></label>
                <select name="color" id="color" class="form-control select-custom shadow-none">
                    <option disabled selected value="">Sélectionner une couleur</option>
                    <?php foreach ($colors as $color): ?>
                        <option value="<?php echo htmlspecialchars($color); ?>"><?php echo htmlspecialchars($color); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>

                <div class="mb-2">
                <label for="price_per_day">Prix par jour <span class="text-danger">*</span></label>
                <input type="text" class="form-control shadow-none">

                </div>
                <div class="mb-2">
                <label for="documents">Documents <span class="text-danger">*</span></label>
        <input type="file" name="documents[]" id="documents" class="form-control shadow-none" multiple accept=".pdf, .doc, .docx, .jpg, .png">
                </div>


                </div>

                <!-- Autre champ -->
                <div class="col-md-6 col-sm-12 mb-3">
                   <div class="mb-2">
                   <label for="">Modèle <span class="text-danger">*</span></label>
                   <select name="" id="" class="form-control select-custom shadow-none">
                    <option disabled selected value="">Sélectionner un modèle</option>
                    <?php foreach ($carModels as $model): ?>
                        <option value="<?php echo htmlspecialchars($model); ?>"><?php echo htmlspecialchars($model); ?></option>
                    <?php endforeach; ?>
                   </select>
                </div>
                   
                <div class="mb-2">
                <!-- Liste des types de carburant -->
                <label for="fuelType">Type de carburant <span class="text-danger">*</span></label>
                <select name="fuelType" id="fuelType" class="form-control select-custom shadow-none">
                    <option disabled selected value="">Sélectionner un type de carburant</option>
                    <?php foreach ($fuelTypes as $fuel): ?>
                        <option value="<?php echo htmlspecialchars($fuel); ?>"><?php echo htmlspecialchars($fuel); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                <div class="mb-2">
                <label for="availableSeats">Nombre de sièges <span class="text-danger">*</span></label>
                <select name="availableSeats" id="availableSeats" class="form-control select-custom shadow-none">
                    <option disabled selected value="">Sélectionner un nombre de sièges</option>
                    <?php foreach ($seats as $seat): ?>
                        <option value="<?php echo htmlspecialchars($seat); ?>"><?php echo htmlspecialchars($seat); ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
                <div class="mb-2">
                <label for="mileage">Kilométrage <span class="text-danger">*</span></label>
<select name="mileage" id="mileage" class="form-control select-custom shadow-none">
    <option disabled selected value="">Sélectionner un kilométrage</option>
    <?php foreach ($mileages as $mileage): ?>
        <option value="<?php echo htmlspecialchars($mileage); ?>">
            <?php echo number_format($mileage, 0, ',', ' '); ?> km
        </option>
    <?php endforeach; ?>
</select>
                </div>

                <div class="mb-2">
                <label for="insurance_expiration">Date d'expiration de l'assurance <span class="text-danger">*</span></label>
                <input type="date" class="form-control">
                </div>

                <div class="mb-2">
                    <label for="">Note <span class="text-danger">*</span></label>
                <textarea  name="notes"  id="notes" class="form-control shadow-none" rows="4"   style="height:100px"></textarea>
                </div>
            </div>
            </div>
            
            
            <div class="row mb-3 align-items-center">
                <!-- Colonne pour le champ de téléchargement -->
                <div class="col-md-6">
                    <label for="photos" class="form-label">Télécharger les photos du véhicule</label>
                    <input
                        type="file"
                        name="photos[]"
                        id="photos"
                        class="form-control"
                        multiple
                        accept=".jpg, .jpeg, .png"
                        onchange="previewPhoto()"
                    >
                </div>
                <!-- Colonne pour l'aperçu de l'image -->
                <div class="col-md-6">
                    <div class="photo-preview" id="photo-preview">
                        <img id="preview-image" src="../v1.png" alt="Aperçu de la photo" class="img-thumbnail">
                    </div>
                </div>
            </div>
            <!-- Ajouter un bouton de soumission si nécessaire
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </div> -->
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