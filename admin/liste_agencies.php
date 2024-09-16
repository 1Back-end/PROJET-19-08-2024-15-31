<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">

      <div class="col-md-12 col-sm-12 mb-3">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
    <!-- Titre de la page -->
    <h5 class="text-uppercase fw-bold mb-3 mb-md-0">Liste des agences</h5>
    <!-- Bouton d'ajout d'utilisateur -->
    <a href="ajout_agencies.php" class="btn btn-customize text-white btn-sm"><i class="fa fa-plus mx-2" aria-hidden="true"></i> Ajouter une agence</a>
</div>
</div>


<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <form action="" method="get">
            <div class="row g-3">
                <div class="col-md-3 mb-2">
                    <input type="text" class="form-control shadow-none" placeholder="Rechercher">
                </div>
                <div class="col-md-3 mb-2">
                    <input type="date" name="" id="" class="form-control shadow-none">
                </div>
                <div class="col-md-1 mb-2">
                    <select name="" id=""  class="form-control shadow-none select-custom">
                        <?php foreach($number_agencies as $number_agencie):?>
                            <option value="<?php echo htmlspecialchars($number_agencie);?>">
                                <?php echo htmlspecialchars($number_agencie);?>
                            </option>
                            <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-3 mb-2">
                    <select name="" id="" class="form-control shadow-none select-custom">
                            <option disabled selected>Sélectionner un statut</option>
                            <?php foreach($StatusAgencies as $StatusAgencie):?>
                                <option value="<?php echo htmlspecialchars($StatusAgencie);?>">
                                    <?php echo htmlspecialchars($StatusAgencie);?>
                                </option>
                            <?php endforeach;?>
                    </select>
                </div>
                <div class="col-md-2 mb-2">
                    <button type="submit" class="btn btn-customize text-white shadow-none btn-lg w-100">Afficher</button>
                </div>
            </div>
        </form>
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

// Pagination settings
$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get total count
$total_agencies = get_total_agencies_count($pdo);
$total_pages = ceil($total_agencies / $limit);

// Fetch agencies
$agencies = get_agencies($pdo, $limit, $offset);
?>

<div class="col-md-12 col-sm-12">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-bordered text-center table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Propriétaire</th>
                        <th>Nom</th>
                        <th>Code</th>
                        <th>Pays</th>
                        <th>Ajouté le</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($agencies)) : ?>
                    <tr>
                        <td colspan="8">Aucun élément trouvé</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($agencies as $index => $agency) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($index + 1 + $offset); ?></td>
                            <td>
                                <?php if (!empty($agency['logo'])): ?>
                                    <img src="../upload/<?php echo htmlspecialchars($agency['logo']); ?>" alt="Logo" class="rounded-circle img-fluid" width="60" height="60" style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;">
                                <?php else: ?>
                                    <img src="../vendors/images/default_logo.jpg" alt="Logo" class="img-thumbnail" class="rounded-circle img-fluid" width="60" height="60" style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;">
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($agency['owner_name']); ?></td>
                            <td><?php echo htmlspecialchars($agency['name']); ?></td>
                            <td><?php echo htmlspecialchars($agency['agency_code']); ?></td>
                            <td><?php echo htmlspecialchars($agency['country']); ?></td>
                            <td><?php echo htmlspecialchars($agency['created_at']); ?></td>
                            <td>
                                <?php if ($agency['is_active']) : ?>
                                    <span class="badge bg-success text-white">Actif</span>
                                <?php else : ?>
                                    <span class="badge bg-danger text-white">Inactif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div  class="d-flex align-items-center justify-content-center">
                                <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Actions
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <!-- Bouton pour désactiver l'agence -->
                                <?php if ($agency['is_active']) : ?>
                                    <a href="#" data-id="<?php echo htmlspecialchars($agency['id']); ?>" data-toggle="modal" data-target="#deactivateModal" class="dropdown-item text-danger">
                                        <i class="fa fa-ban mr-2"></i> Désactiver
                                    </a>
                                <?php else : ?>
                                    <!-- Bouton pour activer l'agence -->
                                    <a href="#" data-id="<?php echo htmlspecialchars($agency['id']); ?>" data-toggle="modal" data-target="#activateModal" class="dropdown-item text-success">
                                        <i class="fa fa-check-circle mr-2"></i> Activer
                                    </a>
                                <?php endif; ?>

                                <!-- Bouton pour voir les détails de l'agence -->
                                <a href="info_agence.php?id=<?php echo htmlspecialchars($agency['id']); ?>" class="dropdown-item text-info">
                                    <i class="fa fa-info-circle mr-2"></i> Détails
                                </a>


                                <!-- Bouton pour supprimer l'agence -->
                                <a href="#" data-id="<?php echo htmlspecialchars($agency['id']); ?>" data-toggle="modal" data-target="#deleteModal" class="dropdown-item text-danger">
                                    <i class="fa fa-trash mr-2"></i> Supprimer
                                </a>
                            </div>
                        </div>
                        </div>
                        <!-- Dropdown pour les actions --> 
                    </td>


                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div><br>

 <!-- Pagination -->
 <nav>
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
        Êtes-vous sûr de vouloir désactiver cette agence ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
        <a id="confirmDeactivate" href="#" class="btn btn-customize text-white btn-sm btn-xs">Désactiver</a>
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
        Êtes-vous sûr de vouloir activer cette agence ?
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
        Êtes-vous sûr de vouloir supprimer cette agence ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm btn-xs" data-dismiss="modal">Annuler</button>
        <a id="confirmDelete" href="#" class="btn btn-danger btn-sm btn-xs">Supprimer</a>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Gestion de la désactivation
    $('#deactivateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var agencyId = button.data('id');
        var modal = $(this);
        modal.find('#confirmDeactivate').attr('href', 'deactivate_agency.php?id=' + agencyId);
    });

    // Gestion de l'activation
    $('#activateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var agencyId = button.data('id');
        var modal = $(this);
        modal.find('#confirmActivate').attr('href', 'activate_agency.php?id=' + agencyId);
    });

    // Gestion de la suppression
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var agencyId = button.data('id');
        var modal = $(this);
        modal.find('#confirmDelete').attr('href', 'delete_agency.php?id=' + agencyId);
    });


    // Faire disparaître les alertes après 2 secondes
        setTimeout(function() {
            $(".alert").alert('close');
        }, 2000);
});


</script>