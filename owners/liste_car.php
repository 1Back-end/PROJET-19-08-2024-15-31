<?php include("../include/menu_owners.php");?>
<?php include_once 'controllers_owners.php';?>
<link rel="stylesheet" href="style.css">



<div class="main-container pb-5 mt-3">
    
<div class="col-md-12 col-sm-12 mb-3">
    <div class="d-flex align-items-center justify-content-between">
        <h4 class="text-uppercase mb-0">Liste des véhicules</h4>
        <!-- Bouton pour ouvrir la modale -->
        <a href="ajout_car.php" class="btn btn-customize text-white btn-sm" >
            <i class="fa fa-plus mx-2 fa-2x" aria-hidden="true"></i> Ajouter un véhicule
        </a>
    </div>
</div>

<div class="col-md-12 col-sm-12">
<?php
// Vérifiez si un message est présent dans les paramètres de l'URL
if (isset($_GET['message'])) {
    $message = $_GET['message'];
    if ($message === 'success') {
        echo '<div class="alert alert-success text-center" role="alert">La voiture a été supprimée avec succès.</div>';
    } elseif ($message === 'error') {
        echo '<div class="alert alert-danger text-center" role="alert">Une erreur est survenue. Veuillez réessayer.</div>';
    }
}
?>
</div>

<?php
// ID du propriétaire (récupéré via la session ou autre source)
$owner_id = $_SESSION['owner_id'] ?? null;

// Récupérer la page actuelle depuis les paramètres GET
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = 10; // Nombre d'éléments par page

// Récupérer les voitures pour cette page
$cars = get_car_by_owner_id($pdo, $owner_id, $currentPage, $itemsPerPage);

// Récupérer le nombre total de voitures pour la pagination
$totalCarsCount = get_total_cars_count($pdo, $owner_id);
$totalPages = ceil($totalCarsCount / $itemsPerPage);
?>

<div class="col-md-12 col-sm-12"> 
    <div class="card-box p-3">
        <div class="table-responsive">
            <!-- Tableau des voitures -->
            <table class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Immatriculation</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Transmission</th>
                        <th>Sièges</th>
                        <th>Kilométrage</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cars as $index => $car): ?>
                        <tr>
                            <td><?php echo htmlspecialchars(($currentPage - 1) * $itemsPerPage + $index + 1); ?></td>
                            <td><?php echo htmlspecialchars($car['registration_number']); ?></td>
                            <td><?php echo htmlspecialchars($car['brand_name']); ?></td>
                            <td><?php echo htmlspecialchars($car['model']); ?></td>
                            <td><?php echo htmlspecialchars($car['transmission']); ?></td>
                            <td><?php echo htmlspecialchars($car['seats']); ?></td>
                            <td><?php echo htmlspecialchars($car['mileage']); ?> Km</td>
                            <td>
                                <?php if ($car['availability_status'] == "Disponible"): ?>
                                    <span class="badge badge-success">Disponible</span>
                                <?php elseif ($car['availability_status'] == "Réservé"):?>
                                    <span class="badge badge-warning">Réservé</span>
                                <?php else:?>
                                    <span class="badge badge-danger">Hors service</span>
                                <?php endif;?>
                            </td>
                            <td class="d-flex align-items-center justify-content-center">
                            <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Bouton pour supprimer une voiture -->
                                <li><a class="dropdown-item text-danger btn-delete" href="#" data-id="<?php echo $car['id']; ?>"><i class="fas fa-trash-alt"></i> Supprimer</a></li>
                                <!-- Bouton pour modifier une voiture -->
                                <li><a class="dropdown-item text-warning" href="modifier_car.php?id=<?php echo $car['id']; ?>"><i class="fas fa-edit"></i> Modifier</a></li>
                                <!-- Bouton pour afficher les détails d'une voiture -->
                                <li><a class="dropdown-item text-info" href="info_car.php?id=<?php echo $car['id']; ?>"><i class="fas fa-info-circle"></i> Détails</a></li>
                            </ul>
                                </div>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div><br>
<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($currentPage > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Précédent">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($page = 1; $page <= $totalPages; $page++): ?>
            <li class="page-item <?= ($page == $currentPage) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Suivant">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>



<!-- Modal pour la désactivation -->
<div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-labelledby="deactivateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deactivateModalLabel">Confirmer la suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce véhicule ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
        <a id="confirmDeactivate" href="#" class="btn btn-danger btn-sm btn-xs">Supprimer</a>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var deleteButtons = document.querySelectorAll('.btn-delete');
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche la navigation vers la page de suppression
            
            var carId = this.getAttribute('data-id');
            var modal = new bootstrap.Modal(document.getElementById('deactivateModal'));
            var confirmDeleteButton = document.getElementById('confirmDeactivate');
            
            // Met à jour le lien du bouton de confirmation avec l'ID de la voiture
            confirmDeleteButton.setAttribute('href', 'delete_car.php?id=' + carId);
            
            // Affiche la modale
            modal.show();
        });
    });
});
</script>


<script>
    $(document).ready(function() {
    // Cacher l'alerte après 2 secondes (2000 ms)
    setTimeout(function() {
    $(".alert").alert('close');
    }, 2000);
    });
</script>

