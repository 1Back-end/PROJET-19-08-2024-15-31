<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
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
<?php
// Configuration de la pagination
$itemsPerPage = 10;

// Connexion à la base de données
try {
    // Calcul du nombre total d'éléments
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM cars WHERE is_deleted = 0");
    $stmt->execute();
    $totalItems = $stmt->fetchColumn();
    $totalPages = ceil($totalItems / $itemsPerPage);

    // Récupération de la page actuelle
    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $currentPage = max(1, min($currentPage, $totalPages)); // Assure que la page est dans la plage valide

    // Calcul de l'offset pour la requête
    $offset = ($currentPage - 1) * $itemsPerPage;

    // Récupération des données pour la page actuelle avec jointure pour récupérer le nom de la marque
    $stmt = $pdo->prepare(" SELECT cars.*, carbrands.name AS brand_name FROM cars LEFT JOIN carbrands ON cars.brand_id = carbrands.id
        WHERE cars.is_deleted = 0 LIMIT :offset, :itemsPerPage
    ");
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>

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
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $index => $car): ?>
                <tr>
                    <td><?php echo htmlspecialchars($index + 1); ?></td>
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
                            <!-- Bouton pour supprimer une voiture -->
                            <a href="#" data-id="<?php echo $car['id']; ?>" class="btn btn-danger btn-sm btn-xs mx-2 btn-delete">
                                Supprimer
                            </a>
                        <!-- Bouton pour modifier une voiture -->
                        <a href="modifier_car.php?id=<?php echo $car['id'];?>" class="btn btn-warning text-white btn-sm btn-xs mx-2">
                            Modifier
                        </a>

                        <a href="info_car.php?id=<?php echo $car['id'];?>" class="btn btn-info btn-sm btn-xs mx-2">
                             Détails
                        </a> 
        
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?php echo $currentPage - 1; ?>">&laquo; Précédent</a>
        <?php endif; ?>

        <?php for ($page = 1; $page <= $totalPages; $page++): ?>
            <a href="?page=<?php echo $page; ?>" class="<?php echo $page == $currentPage ? 'active' : ''; ?>">
                <?php echo $page; ?>
            </a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?php echo $currentPage + 1; ?>">Suivant &raquo;</a>
        <?php endif; ?>
    </div>
</div>
</div>
</div>


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

