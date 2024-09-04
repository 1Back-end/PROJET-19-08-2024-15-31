<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-2 d-flex align-items-center">
    
        <!-- Icône de retour -->
        <a href="liste_subscriptions.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0 fs-5 fs-md-4 fs-lg-3">Ajouter un abonnement</h4>

    </div>
</div>

<div class="col-md-12 col-sm-12">
    <?php include_once("registration_subscriptions.php"); ?>

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
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 col-sm-12 mb-2">
                    <div class="mb-2">
                        <label for="subscription_type">Type d'abonnement <span class="text-danger">*</span></label>
                        <select id="subscription_type" name="subscription_type" class="shadow-none form-control select-custom">
                            <option disabled selected>Sélectionner un type d'abonnement</option>
                            <?php foreach ($subscriptionTypes as $type): ?>
                                <option value="<?php echo htmlspecialchars($type['id']); ?>">
                                    <?php echo htmlspecialchars($type['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($erreur_champ) && empty($_POST['subscription_type'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label for="price">Date de début <span class="text-danger">*</span></label>
                        <input type="date" id="" name="start_date" class="shadow-none form-control" placeholder="Prix">
                        <?php if(isset($erreur_champ) && empty($_POST['start_date'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 mb-2">
                  <div class="mb-2">
                  <label for="">Agence</label>
                  <select id="agency" name="agency" class="shadow-none form-control select-custom">
                            <option disabled selected>Sélectionner une agence</option>
                            <?php foreach ($agencies as $agency): ?>
                                <option value="<?php echo htmlspecialchars($agency['id']); ?>">
                                    <?php echo htmlspecialchars($agency['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if(isset($erreur_champ) && empty($_POST['agency'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                  </div>
                  <div class="mb-2">
                        <label for="price">Date de fin <span class="text-danger">*</span></label>
                        <input type="date" id="" name="end_date" class="shadow-none form-control" placeholder="Prix">
                        <?php if(isset($erreur_champ) && empty($_POST['end_date'])): ?>
                        <small class="text-danger"><?=$erreur_champ?></small>
                        <?php endif; ?>
                </div>
                </div>
            </div>
            <div class="mb-2">
                    <label for="">Description <span class="text-danger">*</span></label>
                    <textarea name="comments" id="" class="form-control shadow-none"></textarea>
            </div>
            <div class="mb-5 d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <button type="submit" name="submit" class="btn btn-customize text-white btn-responsive submit_btn mb-2 mb-md-0">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            Enregistrer
                    </button>
                    <a href="liste_subscriptions.php" class="btn btn-secondary btn-responsive ml-md-2 mb-2">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Annuler
                    </a>
                    <!-- <button type="reset" class="btn btn-secondary ml-md-2 mb-2">Annuler</button> -->
            </div>
        </form>
    </div>
</div>