<?php include("../include/menu_owners.php");?>
<?php include_once 'controllers_owners.php';?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
<div class="col-md-12 col-sm-12 mb-3">
    <div class="d-flex align-items-center justify-content-between">
        <h4 class="text-uppercase mb-0">Liste des modèles</h4>
        <!-- Bouton pour ouvrir la modale -->
        <a href="ajout_modele.php" class="btn btn-customize text-white btn-sm" >
            <i class="fa fa-plus mx-2 fa-2x" aria-hidden="true"></i> Ajouter un modèle
        </a>
    </div>
</div>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Marque</th>
                        <th>Modèle</th>
                        <th>Ajouté le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($model_car)): ?>
                        <tr>
                            <td colspan="5">Aucun élément trouvé</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($model_car as $index => $model_cars): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($index + 1); ?></td>
                                <td><?php echo htmlspecialchars($model_cars['brand_name']); ?></td>
                                <td><?php echo htmlspecialchars($model_cars['name']); ?></td>
                                <td><?php echo htmlspecialchars($model_cars['created_at']); ?></td>
                                <td>
                                   <div class="d-flex align-items-center justify-content-center">
                                     <!-- Vous pouvez ajouter des boutons d'action ici, comme modifier ou supprimer -->
                                     <a href="edit.php?id=<?php echo htmlspecialchars($model_cars['id']); ?>" class="btn btn-success btn-sm btn-xs mx-3">Modifier</a>
                                    <a href="delete.php?id=<?php echo htmlspecialchars($model_cars['id']); ?>" class="btn btn-danger btn-sm btn-xs" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ?');">Supprimer</a>
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


