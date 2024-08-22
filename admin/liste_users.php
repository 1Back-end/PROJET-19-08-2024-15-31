<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">

      <div class="col-md-12 col-sm-12 mb-3">
         <div class="d-flex justify-content-between align-items-center">
            <!-- Titre de la page -->
            <h5 class="text-uppercase fw-bold mb-0">Liste des administrateurs</h5>
            <!-- Bouton d'ajout d'utilisateur -->
            <a href="ajout_user.php" class="btn btn-customize text-white  btn-sm"><i class="fa fa-plus mx-2 fa-2x" aria-hidden="true"></i> Ajouter un administrateur</a>
         </div>
      </div>



<div class="col-md-12 col-sm-12">
<?php
// Exemple de code à ajouter au début de liste_user.php
$message = $_GET['message'] ?? null;

if ($message == 'success') {
    echo '<div class="alert alert-success text-center" role="alert">Utilisateur désactivé avec succès.</div>';
} elseif ($message == 'error') {
    echo '<div class="alert alert-danger text-center" role="alert">Une erreur est survenue. Veuillez réessayer.</div>';
}
?>

<?php
// Exemple de code à ajouter au début de liste_user.php
$msg = $_GET['msg'] ?? null;

if ($msg == 'success') {
    echo '<div class="alert alert-success text-center" role="alert">Utilisateur activé avec succès.</div>';
} elseif ($msg == 'error') {
    echo '<div class="alert alert-danger text-center" role="alert">Une erreur est survenue. Veuillez réessayer.</div>';
}
?>

<?php
// Exemple de code à ajouter au début de liste_user.php
$delete = $_GET['delete'] ?? null;

if ($delete == 'success') {
    echo '<div class="alert alert-success text-center" role="alert">Utilisateur supprimé avec succès.</div>';
} elseif ($delete == 'error') {
    echo '<div class="alert alert-danger text-center" role="alert">Une erreur est survenue. Veuillez réessayer.</div>';
}
?>

</div>



      <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-2">
        <div class="table-responsive">
            <table class="table table-striped text-center table-bordered">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($admins): ?>
                        <?php foreach ($admins as $index => $admin): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($index + 1); ?></td>
                                <td>
                                    <?php if (!empty($admin['photo'])): ?>
                                        <img src="../upload<?php echo htmlspecialchars($admin['photo']); ?>" alt="Photo" width="50" height="50">
                                    <?php else: ?>
                                        <img src="../vendors/images/profile.jpg" alt="Photo"  class="photo_profil">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($admin['lastname']); ?></td>
                                <td><?php echo htmlspecialchars($admin['firstname']); ?></td>
                                <td><?php echo htmlspecialchars($admin['email']); ?></td>
                                <td><?php echo htmlspecialchars($admin['contact']); ?></td>
                                <td>
                                    <?php if ($admin['is_active'] == 1): ?>
                                        <span class="badge bg-success text-white">Actif</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger text-white">Inactif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="d-flex align-items-center justify-content-center mb-3">
                                        <?php if ($admin['is_active'] == 1): ?>
                                            <a href="#" data-id="<?php echo htmlspecialchars($admin['id']); ?>" data-toggle="modal" data-target="#deactivateModal" class="btn btn-danger btn-xs text-white btn-sm mx-2">Désactiver</a>
                                        <?php else: ?>
                                            <a href="#" data-id="<?php echo htmlspecialchars($admin['id']); ?>" data-toggle="modal" data-target="#activateModal" class="btn btn-success btn-xs text-white btn-sm mx-2">Activer</a>
                                        <?php endif; ?>
                                        <a href="#" data-id="<?php echo htmlspecialchars($admin['id']); ?>" data-toggle="modal" data-target="#editUserModal" class="btn btn-customize btn-xs text-white btn-sm mx-2">Modifier</a>
                                        <a href="#" data-id="<?php echo htmlspecialchars($admin['id']); ?>" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-xs btn-sm mx-2">Supprimer</a>
                                </td>

                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Aucun élément trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>



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
        Êtes-vous sûr de vouloir désactiver cet utilisateur ?
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
        Êtes-vous sûr de vouloir activer cet utilisateur ?
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
        Êtes-vous sûr de vouloir supprimer cet utilisateur ?
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
        var userId = button.data('id');
        var modal = $(this);
        modal.find('#confirmDeactivate').attr('href', 'deactivate_user.php?id=' + userId);
    });

    // Gestion de l'activation
    $('#activateModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var userId = button.data('id');
        var modal = $(this);
        modal.find('#confirmActivate').attr('href', 'activate_user.php?id=' + userId);
    });

    // Gestion de la suppression
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var userId = button.data('id');
        var modal = $(this);
        modal.find('#confirmDelete').attr('href', 'delete_user.php?id=' + userId);
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
