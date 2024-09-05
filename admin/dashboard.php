<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="main-container mt-2 pb-5">
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

    <div class="col-lg-3 col-md-12 col-sm-12 mb-3">
        <div class="card-box p-3">
            <div class="text-center">
                <h6 class="mb-3 h6">
                    Total agences
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <i class="fas fa-building fs-3"></i> <!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $countAgencies;?>
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
                    Total propriétaires
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <i class="fas fa-user-tie fs-3"></i> <!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $countOwners;?>
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
                    Total des paiements (FRCFA)
                </h6>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                        <div class="logo">
                            <span class="icon-admin text-white font-weight-bold">
                                <!-- Utilisation d'une icône d'administrateur -->
                                <i class="fas fa-credit-card-alt fs-3"></i> <!-- Faible épaisseur -->
                            </span>
                        </div>
                    </div>
                    <div class="ml-auto">
                        <h6 class="mr-2 fs-3">
                            <?php echo $somme_payment;?> 
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 mb-3">
        <div class="card-box p-3">
            <h6 class="mb-3 h6">
                Répartition des paiements par agence
            </h6>
            <div class="flot-chart-container mt-3">
            <canvas id="paymentsChart"></canvas>
            </div>
        </div>
    </div>
   
    <div class="col-md-6 col-sm-12 mb-3">
        <div class="card-box p-3">
            <h6 class="mb-3 h6">
                Répartition des propriétaires par agences
            </h6>
            <div class="chart-container mt-3">
            <canvas id="ownerAgencyChart"></canvas>
            </div>
        </div>
    </div>
    </div>
    </div>

    







       
    </div>

</div>


<script>
        // Données pour le graphique des paiements
        const paymentsLabels = <?php echo json_encode($payment_labels); ?>;
        const paymentsData = <?php echo json_encode($payment_data); ?>;

        const ctxPayments = document.getElementById('paymentsChart').getContext('2d');
        new Chart(ctxPayments, {
            type: 'line',
            data: {
                labels: paymentsLabels,
                datasets: [{
                    label: 'Paiements Totaux',
                    data: paymentsData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    tension: 1.5, // Ajouter de la tension à la courbe
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + ' FRCFA'; // Ajouter le texte "FRCFA" aux valeurs sur l'axe Y
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'Montant: ' + tooltipItem.raw.toLocaleString('fr-FR') + ' FRCFA';
                            }
                        },
                        caretPadding: 10,
                        bodyFont: {
                            size: 14,
                        },
                        bodyColor: '#fff',
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        displayColors: false
                    }
                }
            }
        });

        // Données pour le graphique des agences
        const ownerLabels = <?php echo json_encode($owner_labels); ?>;
        const ownerAgencyCounts = <?php echo json_encode($owner_agency_counts); ?>;

        const ctxOwners = document.getElementById('ownerAgencyChart').getContext('2d');
        new Chart(ctxOwners, {
            type: 'bar',
            data: {
                labels: ownerLabels,
                datasets: [{
                    label: 'Nombre d\'Agences par Propriétaire',
                    data: ownerAgencyCounts,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + ' agences'; // Ajouter le texte "agences" aux valeurs sur l'axe Y
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'Nombre d\'agences: ' + tooltipItem.raw;
                            }
                        },
                        caretPadding: 10,
                        bodyFont: {
                            size: 14,
                        },
                        bodyColor: '#fff',
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        displayColors: false
                    }
                }
            }
        });
    </script>