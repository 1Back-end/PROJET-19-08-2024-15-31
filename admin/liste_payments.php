<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">

      <div class="col-md-12 col-sm-12 mb-3">
    <h5 class="text-uppercase fw-bold mb-3 mb-md-0">Liste des paiements</h5>
    <!-- Bouton d'ajout d'utilisateur -->
</div>

<?php
// Nombre de résultats par page
$limit = 10;

// Page actuelle
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Récupérer les paiements
$payments = get_all_payment($pdo, $limit, $offset);

// Récupérer le nombre total de paiements
$total_payments = get_payment_count($pdo);

// Calculer le nombre total de pages
$total_pages = ceil($total_payments / $limit);
?>

<div class="col-md-12 col-sm-12">
   <div class="card-box p-3">
    <div class="table-responsive">
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Abonnement</th>
                <th>Agence</th>
                <th>Montant</th>
                <th>Date de paiement</th>
                <th>Mode de paiement</th>
                <th>Statut</th>
                <th>Transaction ID</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($payments)) : ?>
                <tr>
                    <td colspan="10">Aucun élément trouvé</td>
                </tr>
            <?php else : ?>
            <?php foreach ($payments as $index => $payment): ?>
            <tr>
                <td><?= $offset + $index + 1 ?></td>
                <td><?= htmlspecialchars($payment['subscription_name']) ?></td>
                <td><?= htmlspecialchars($payment['agency_name']) ?></td>
                <td><?= number_format($payment['amount'], 0, ',', ' ') ?> FRCFA</td>
                <td><?= date('d-m-Y H:i', strtotime($payment['payment_date'])) ?></td>
                <td>
                        <?php if ($payment['payment_method'] == 'card'): ?>
                            <span class="badge badge-primary">Carte bancaire</span>
                        <?php else: ?>
                            <span class="badge badge-secondary"><?= htmlspecialchars($payment['payment_method']) ?></span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($payment['status'] == 'completed'): ?>
                            <span class="badge badge-success">Terminé</span>
                        <?php elseif ($payment['status'] == 'pending'): ?>
                            <span class="badge badge-warning">En attente</span>
                        <?php elseif ($payment['status'] == 'failed'): ?>
                            <span class="badge badge-danger">Échoué</span>
                        <?php else: ?>
                            <span class="badge badge-secondary"><?= htmlspecialchars($payment['status']) ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($payment['transaction_id']) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    </div>
   </div><br>
    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>