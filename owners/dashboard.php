<?php include("../include/menu_owners.php");?>
<?php include_once("controllers_owners.php");?>

<div class="main-container mt-2">
    <div class="col-md-12 col-sm-12 mb-3">
        <h4>Tableau de bord</h4>
    </div>


<div class="col-md-12 col-sm-12 mb-3">
        <div class="row">

        <div class="col-lg-3 col-md-12 col-sm-12 mb-3">
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
                                <span class="micon dw dw-list"></span> <!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            0
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total des marques
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <span class="micon dw dw-list"></span>
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $count_cardbrand;?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="col-lg-3 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total des modèles
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <span class="micon dw dw-list"></span>
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $count_models_car;?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-3 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total des véhicules
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <span class="micon dw dw-list"></span>
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $count_car;?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>