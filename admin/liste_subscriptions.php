<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">

      <div class="col-md-12 col-sm-12 mb-3">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
    <!-- Titre de la page -->
    <h5 class="text-uppercase fw-bold mb-3 mb-md-0">Liste des Abonnements</h5>
    <!-- Bouton d'ajout d'utilisateur -->
    <a href="ajout_subscriptions.php" class="btn btn-customize text-white btn-sm"><i class="fa fa-plus mx-2 fa-2x" aria-hidden="true"></i> Ajouter un abonnement</a>
</div>
</div>


<div class="col-md-12 col-sm-12">
  <div class="card-box p-2">
    <div class="table-responsive">
      <table class="table table-striped table-bordered text-center">
        <thead>
        <th>#</th>
        
        <th>Agence</th>
        <th>Date de début</th>
        <th>Date de fin</th>
        <th>Montant</th>
        <th>Statut</th>
        <th>Ajouté le </th>
        <th>Actions</th>
        </thead>
      
      <tbody>
      <tr>
          <td colspan="8">Aucun élément trouvé</td>
        </tr>
      </tbody>
      </table>
    </div>
  </div>

</div>