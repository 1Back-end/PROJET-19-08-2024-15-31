<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">

      <div class="col-md-12 col-sm-12 mb-3">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
    <!-- Titre de la page -->
    <h5 class="text-uppercase fw-bold mb-3 mb-md-0">Liste des propriétaires</h5>
    <!-- Bouton d'ajout d'utilisateur -->
    <a href="ajout_owner.php" class="btn btn-customize text-white btn-sm"><i class="fa fa-plus mx-2 fa-2x" aria-hidden="true"></i> Ajouter un propriétaire</a>
</div>
</div>
<div class="col-md-12 col-sm-12 mb-3">
<?php
// Exemple de code à ajouter au début de liste_owners.php
$message = $_GET['message'] ?? null;
$content = $_GET['content'] ?? null;

if ($message == 'success') {
    echo '<div class="alert alert-success text-center fade show" role="alert">' . htmlspecialchars($content) . '</div>';
} elseif ($message == 'error') {
    echo '<div class="alert alert-danger text-center fade show" role="alert">' . htmlspecialchars($content) . '</div>';
}
?>
</div>
<?php
// Nombre de résultats par page
$limit = 10;

// Numéro de la page actuelle
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcul de l'offset
$offset = ($page - 1) * $limit;

// Récupérer les propriétaires avec pagination
$owners = get_all_owners($pdo, $limit, $offset);

// Calculer le nombre total de propriétaires
$total_owners = get_total_owners_count($pdo);

// Calculer le nombre total de pages
$total_pages = ceil($total_owners / $limit);
?>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
                <thead>
                <th>#</th>
                <th>Photo</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Pays</th>
                <th>Ville</th>
                <th>Statut</th>
                <th>Actions</th>
                </thead>

                <tbody>
                <?php if (empty($owners)) : ?>
                    <tr>
                        <td colspan="8">Aucun élément trouvé</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($owners as $index => $owner): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($index + 1 + $offset); ?></td>
                            <td>
                                 <?php if (!empty($owner['image'])): ?>
                                        <img src="../upload/<?php echo htmlspecialchars($owner['image']); ?>" alt="Photo" class="rounded-circle img-fluid" width="40" height="40" style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;">
                                    <?php else: ?>
                                        <img src="../vendors/images/profile.jpg" alt="Photo" class="rounded-circle img-fluid" width="40" height="40" style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;">
                                    <?php endif; ?>
                                </td>
                            <td><?php echo htmlspecialchars($owner['name']);?></td>
                            <td><?php echo htmlspecialchars($owner['email']);?></td>
                            <td><?php echo htmlspecialchars($owner['country']);?></td>
                            <td><?php echo htmlspecialchars($owner['city']);?></td>
                            <td>
                                <?php if ($owner['status'] == 'active'): ?>
                                    <span class="badge bg-success text-white">Actif</span>
                                <?php else: ?>
                                    <span class="badge bg-danger text-white">Inactif</span>
                                <?php endif; ?>
                            </td>
                            <td>
    <div class="d-flex align-items-center justify-content-center">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Actions
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php if ($owner['status'] == 'active'): ?>
                    <li>
                        <a href="#" data-id="<?php echo htmlspecialchars($owner['id']); ?>" data-toggle="modal" data-target="#deactivateModal" class="dropdown-item text-danger">
                            <i i class="fa fa-ban mr-2"></i> Désactiver
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="#" data-id="<?php echo htmlspecialchars($owner['id']); ?>" data-toggle="modal" data-target="#activateModal" class="dropdown-item text-success">
                            <i class="fas fa-user-check"></i> Activer
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="details_owner.php?id=<?php echo htmlspecialchars($owner['id']); ?>" class="dropdown-item text-info">
                        <i class="fas fa-info-circle"></i> Détails
                    </a>
                </li>
                <li>
                    <a href="#" data-id="<?php echo htmlspecialchars($owner['id']); ?>" data-toggle="modal" data-target="#deleteModal" class="dropdown-item text-danger">
                        <i class="fas fa-trash-alt"></i> Supprimer
                    </a>
                </li>
            </ul>
        </div>
    </div>
</td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
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
        <h5 class="modal-title" id="deactivateModalLabel">Confirmer la désactivation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir désactiver ce propriétaire ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
        <a id="confirmDeactivate" href="#" class="btn btn-danger btn-sm btn-xs">Désactiver</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal pour l'activation -->
<div class="modal fade" id="activateModal" tabindex="-1" role="dialog" aria-labelledby="activateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="activateModalLabel">Confirmer l'activation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir activer ce propriétaire ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
        <a id="confirmActivate" href="#" class="btn btn-success btn-sm btn-xs">Activer</a>
      </div>
    </div>
  </div>
</div>

<!-- Modal pour la suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce propriétaire ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
        <a id="confirmDelete" href="#" class="btn btn-danger btn-sm btn-xs">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        // Gestion de la désactivation
        $('#deactivateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var ownerId = button.data('id');
            var modal = $(this);
            modal.find('#confirmDeactivate').attr('href', 'deactivate_owner.php?id=' + ownerId);
        });

        // Gestion de l'activation
        $('#activateModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var ownerId = button.data('id');
            var modal = $(this);
            modal.find('#confirmActivate').attr('href', 'activate_owner.php?id=' + ownerId);
        });

        // Gestion de la suppression
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var ownerId = button.data('id');
            var modal = $(this);
            modal.find('#confirmDelete').attr('href', 'delete_owner.php?id=' + ownerId);
        });

        // Faire disparaître les alertes après 2 secondes
        setTimeout(function() {
            $(".alert").alert('close');
        }, 2000);
    });
</script>