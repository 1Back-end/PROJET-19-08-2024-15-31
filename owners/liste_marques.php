<?php include("../include/menu_owners.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
<div class="col-md-12 col-sm-12 mb-3">
    <div class="d-flex align-items-center justify-content-between">
        <h4 class="text-uppercase mb-0">Liste des marques</h4>
        <!-- Bouton pour ouvrir la modale -->
        <a href="ajout_marque.php" class="btn btn-customize text-white btn-sm" >
            <i class="fa fa-plus mx-2 fa-2x" aria-hidden="true"></i> Ajouter une marque
        </a>
    </div>
</div>


<div class="col-md-12 col-sm-12">
<?php
// Exemple de code à ajouter au début de liste_user.php
$message = $_GET['message'] ?? null;

if ($message == 'success') {
    echo '<div class="alert alert-success text-center" role="alert">Marque supprimée avec succès.</div>';
} elseif ($message == 'error') {
    echo '<div class="alert alert-danger text-center" role="alert">Une erreur est survenue. Veuillez réessayer.</div>';
}
?>
</div>






<div class="col-md-12 col-sm-12">
            <div class="card-box p-3">
            <div class="table-responsive w-100">
                <table class="table table-bordered text-center table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Nom</th>
                            <th>Ajouté le</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($carBrands)): ?>
                            <?php foreach ($carBrands as $index => $brand): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($index + 1); ?></td>
                                    <td><img src="../upload/<?php echo htmlspecialchars($brand['image']); ?>" alt="<?php echo htmlspecialchars($brand['name']); ?>" class="rounded-circle img-fluid" width="60" height="60" style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;"></td>
                                    <td><?php echo htmlspecialchars($brand['name']); ?></td>
                                    <td><?php echo htmlspecialchars(date('d-m-Y H:i:s', strtotime($brand['created_at']))); ?></td>
                                    <!-- Bouton qui déclenche la modale -->
                                        <td>
                                            <a href="#" class="shadow-none btn-danger btn-xs btn-sm" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo htmlspecialchars($brand['id']); ?>">Supprimer</a>
                                        </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">Aucune marque de voiture trouvée.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


</div>


<!-- Modale Bootstrap -->
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
                Êtes-vous sûr de vouloir supprimer cette marque ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-xs btn-sm" data-dismiss="modal">Annuler</button>
                <a href="#" id="confirmDelete" class="btn btn-danger btn-xs btn-sm">Supprimer</a>
            </div>
        </div>
    </div>
</div>


<script>
    // Capture l'événement de l'ouverture de la modale
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Bouton qui a déclenché la modale
        var id = button.data('id'); // Récupère l'ID stocké dans l'attribut data-id

        var modal = $(this);
        // Modifie le lien de suppression dans la modale avec l'ID correspondant
        modal.find('#confirmDelete').attr('href', 'delete_marque.php?id=' + id);
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
