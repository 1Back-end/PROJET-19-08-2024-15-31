<?php include("../include/menu.php");?>
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
        <div class="table-responsive">
            <div class="card-box p-3">
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
                                    <td><img src="../upload/<?php echo htmlspecialchars($brand['image']); ?>" alt="<?php echo htmlspecialchars($brand['name']); ?>" class="img-thumbnail img-marque"></td>
                                    <td><?php echo htmlspecialchars($brand['name']); ?></td>
                                    <td><?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($brand['created_at']))); ?></td>
                                    <td>
                                       <a href="" class="btn-danger btn-xs btn-sm">Supprimer</a>
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

