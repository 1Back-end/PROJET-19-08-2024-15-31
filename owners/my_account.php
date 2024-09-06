<?php include("../include/menu_owners.php");?>
<?php include_once 'controllers_owners.php';?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="account.css">
<?php 
  $owner_id = $_SESSION['owner_id'] ?? null;
  $agency_info=get_information_by_owner($pdo, $owner_id);
  ?>
<style>
    input[type="tel"]{
  font-size: 12px;
  font-family: "Poppins", sans-serif;

}
</style>
<div class="main-container mt-3 pb-5 ">

<?php include("update_agency_info.php");?>
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
<hr class="mt-0 mb-4">
<div class="row">
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Logo</div>
            <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img id="logoImage" src="../upload/<?php echo htmlspecialchars($agency_info['logo']); ?>" alt="Logo" class="img-account-profile rounded-circle mb-2">
                    <div class="small font-italic text-muted mb-4">JPG ou PNG ne dépassant pas 5 Mo</div>
                    <form action="" method="post" enctype="multipart/form-data">
                    <!-- Form for uploading a new logo -->
                    <input type="file" id="logoInput" name="logo" accept="image/jpeg, image/png" style="display: none;">
                    <!-- Bouton avec icône -->
                        <button class="btn btn-customize text-white" type="button" onclick="document.getElementById('logoInput').click();">
                            <i class="fas fa-upload"></i> Télécharger un nouveau logo
                        </button>

            </div>
        </div>
    </div>

    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Détails de mon agence</div>
            <div class="card-body">
                    <div class="mb-3">
                        <label class="small mb-1" for="inputName">Nom de l'agence</label>
                        <input class="form-control shadow-none" id="inputName" type="text" name="name" value="<?php echo htmlspecialchars($agency_info['name']); ?>">
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (email)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputEmail">Email</label>
                            <input class="form-control shadow-none" id="inputEmail" type="email" name="email" value="<?php echo htmlspecialchars($agency_info['email']); ?>">
                        </div>
                        <!-- Form Group (contact)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Contact</label>
                            <input class="form-control shadow-none" id="inputPhone" type="tel" name="phone" value="<?php echo htmlspecialchars($agency_info['phone']); ?>">
                        </div>
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (address)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputAddress">Adresse</label>
                            <input class="form-control shadow-none" id="inputAddress" type="text" name="address" value="<?php echo htmlspecialchars($agency_info['address']); ?>">
                        </div>
                        <!-- Form Group (city)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputCity">Ville</label>
                            <input class="form-control shadow-none" id="inputCity" type="text" name="city" value="<?php echo htmlspecialchars($agency_info['city']); ?>">
                        </div>
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (country)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputCountry">Pays</label>
                            <input class="form-control shadow-none" id="inputCountry" type="text" name="country" value="<?php echo htmlspecialchars($agency_info['country']); ?>">
                        </div>
                        <!-- Form Group (postal code)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPostalCode">Code postal</label>
                            <input class="form-control shadow-none" id="inputPostalCode" type="text" name="postal_code" value="<?php echo htmlspecialchars($agency_info['postal_code']); ?>">
                        </div>
                    </div>
                    <input type="hidden" name="owner_id" value="<?php echo htmlspecialchars($agency_info['owner_id']); ?>">
                    <!-- Save changes button-->
                    <button class="btn btn-customize btn-responsive text-white" name="submit" type="submit">Enregistrer les modifications</button>
                    </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('logoInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('logoImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
