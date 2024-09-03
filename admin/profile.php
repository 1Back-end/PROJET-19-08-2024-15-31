<?php include("../include/menu.php");?>
<?php include("../database/database.php");?>
<?php include("../controllers/controllers.php");?>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="profile.css">

<div class="main-container mt-3">
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="#" target="__blank">Profile</a>
       
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0 h-100">
            <div class="card-header">Photo de profile</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                     <?php $profile_image = !empty($user_info['photo']) ? 'upload/' . htmlspecialchars($user_info['photo']) : 'http://bootdey.com/img/Content/avatar/avatar1.png';?>
                     <img class="img-account-profile rounded-circle mb-2" src="<?= $profile_image ?>" alt="Photo de profil">
                     <form action="" method="POST" enctype="multipart/form-data">
                        <!-- Profile picture image-->
                        <!-- Profile picture upload button-->
                        <label for="photoInput" style="cursor: pointer;color: #1F4283;font-size:14px;">
                            <i class="fas fa-edit fa-2x"></i> Modifier la photo
                        </label>
                        <!-- Profile picture input -->
                        <input type="file" id="photoInput" name="photo" style="display: none;">
                        <!-- Profile picture help block-->
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4 h-100">
                <div class="card-header">Détails du compte</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Prénom</label>
                                <input class="form-control shadow-none" id="inputFirstName" type="text" value="<?php echo $user_info['firstname']; ?>">
                            </div>

                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Nom</label>
                                <input class="form-control shadow-none" id="inputLastName" value="<?php echo $user_info['lastname']; ?>" type="text">
                            </div>
                        </div>
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                            <label class="small mb-1" for="inputEmailAddress">Email </label>
                            <input class="form-control shadow-none" id="inputEmailAddress" value="<?php echo $user_info['email']; ?>" type="email">
                        </div>
                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Numéro de téléphone</label>
                                <input class="form-control shadow-none" id="inputPhone" value="<?php echo $user_info['contact']; ?>" type="tel">
                            </div>
                        </div>
                        

                        <button class="btn btn-customize text-white" type="button">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    document.getElementById('photoInput').addEventListener('change', function(event) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
</script>