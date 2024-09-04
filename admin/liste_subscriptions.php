<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">

      <div class="col-md-12 col-sm-12 mb-3">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
    <!-- Titre de la page -->
    <h5 class="text-uppercase fw-bold mb-3 mb-md-0">Liste des Abonnements</h5>
    <!-- Bouton d'ajout d'utilisateur -->
    <a href="ajout_subscriptions.php" class="btn btn-customize text-white btn-sm"><i class="fa fa-plus mx-2" aria-hidden="true"></i> Ajouter un abonnement</a>
</div>
</div>

<?php
include_once("../database/database.php");

$limit = 10; // Nombre d'abonnements à afficher par page
$page = $_GET['page'] ?? 1; // Numéro de la page courante
$offset = ($page - 1) * $limit; // Calcul de l'offset

// Récupérer les abonnements avec pagination
$subscriptions = getSubscriptionsWithPagination($pdo, $limit, $offset);

// Compter le nombre total d'abonnements
$totalSubscriptions = getTotalSubscriptions($pdo);

// Calculer le nombre total de pages
$totalPages = ceil($totalSubscriptions / $limit);

// Définir les paramètres régionaux en français
setlocale(LC_TIME, 'fr_FR.UTF-8', 'fr_FR', 'fr', 'fr_CA');

// Afficher les dates en format français
?>

<div class="col-md-12 col-sm-12">
    <div class="card-box p-2">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center">
                <thead>
                    <th>#</th>
                    <th>Agence</th>
                    <th>Abonnement</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Montant</th>
                    <th>Statut</th>
                    <th>Ajouté le</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <?php if ($subscriptions): ?>
                        <?php foreach ($subscriptions as $index => $subscription): ?>
                            <tr>
                                <td><?= ($offset + $index + 1) ?></td>
                                <td><?= htmlspecialchars($subscription['agency_name']) ?></td>
                                <td><?= htmlspecialchars($subscription['subscription_type']) ?></td>
                                <td><?= date('d-m-Y', strtotime($subscription['start_date'])) ?></td>
                                <td><?= date('d-m-Y', strtotime($subscription['end_date'])) ?></td>
                                <td><?= number_format($subscription['total_amount'], 2) ?> FCFA</td>
                                <td>
                                  <?php if ($subscription['status'] == 'active'): ?>
                                      <span class="badge bg-success text-white">Actif</span>
                                  <?php elseif ($subscription['status'] == 'expired'): ?>
                                      <span class="badge bg-danger text-white">Expired</span>
                                  <?php else: ?>
                                      <span class="badge bg-danger text-white">Inactif</span>
                                  <?php endif; ?>
                              </td>

                                <td><?= htmlspecialchars($subscription['created_at']) ?></td>
                                <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item text-warning text-white" href="edit_subscription.php?id=<?= urlencode($subscription['subscription_id']) ?>">
                                            <i class="fas fa-pencil text-warning text-white"></i> Modifier
                                        </a>
                                        <?php if ($subscription['status'] == 'expired' || $subscription['status'] == 'inactive'): ?>
                                            <a class="dropdown-item text-success" href="pay_subscription.php?id=<?= urlencode($subscription['subscription_id']) ?>">
                                                <i class="fas fa-credit-card-alt text-success"></i> Payer
                                            </a>
                                        <?php else: ?>
                                            <!-- Le bouton est désactivé pour les autres statuts -->
                                            <a class="dropdown-item text-muted" href="#" onclick="return false;">
                                                <i class="fas fa-credit-card-alt text-muted"></i> Payer
                                            </a>
                                        <?php endif; ?>
                                        <a class="dropdown-item text-danger" href="delete_subscription.php?id=<?= urlencode($subscription['subscription_id']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette souscription ?');">
                                            <i class="fas fa-trash-alt text-danger"></i> Supprimer
                                        </a>
                                    </div>
                                </div>
                              </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10">Aucun abonnement trouvé</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div><br>

<!-- Pagination -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Précédent">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Suivant">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
