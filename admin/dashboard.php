<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>

<div class="main-container mt-2 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
        <h4>Tableau de bord</h4>
    </div>

    <div class="col-md-12 col-sm-12 mb-3">
        <div class="row">

        <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total utilisateurs
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <i class="fas fa-user-cog fs-3"></i> <!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $countUsers;?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total marques
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <i class="micon dw dw-fuel"></i> <!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $countMarques;?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total véhicules
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <i class="fas fa-car fs-3"></i> <!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $countVoitures;?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total réservations
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <i class="fas fa-calendar-check fs-3"></i><!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $countCar;?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total clients
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <i class="fas fa-users fs-3"></i><!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $total_clients;?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>





       
    </div>

</div>