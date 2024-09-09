<?php include("../include/menu_owners.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
    <div class="mb-3 mb-md-0">
        <h4 class="text-uppercase">Liste des réservations</h4>
    </div>
    <form action="" method="get">
    <div class="d-flex flex-column flex-md-row ml-md-auto">
        <input type="text" class="form-control shadow-none mb-2 mb-md-0 mx-md-2" placeholder="Rechercher">
        <button class="btn btn-customize text-white btn-sm shadow-none">Rechercher</button>
    </div>
    </form>
</div>

    </div>

    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-2">
        <div class="table-responsive">
            <table class="table table-striped text-center table-bordered">
                <thead class="text-center">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client</th>
                        <th scope="col">Véhicule</th>
                        <th scope="col">Début</th>
                        <th scope="col">Fin</th>
                        <th scope="col">Prix Total</th>
                        <th scope="col">Ajouté le</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($reservations && is_array($reservations)): ?>
                        <?php foreach ($reservations as $index => $reservation): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($index + 1 + ($currentPage - 1) * $itemsPerPage); ?></td>
                                <td><?php echo htmlspecialchars($reservation['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($reservation['registration_number']); ?></td>
                                <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($reservation['start_date']))); ?></td>
                                <td><?php echo htmlspecialchars(date('d-m-Y', strtotime($reservation['end_date']))); ?></td>
                                <td><?php echo htmlspecialchars($reservation['total_cost']); ?></td>
                                <td><?php echo htmlspecialchars(date('d-m-Y H:i:s', strtotime($reservation['created_at']))); ?></td>
                                <td>
                                    <?php if ($reservation['status'] == 'pending'): ?>
                                        <span class="badge badge-warning text-white">En attente</span>
                                    <?php elseif ($reservation['status'] == 'accepted'): ?>
                                        <span class="badge badge-success">Accepté</span>
                                    <?php elseif ($reservation['status'] == 'rejected'): ?>
                                        <span class="badge badge-danger">Refusé</span>
                                    <?php endif; ?>
                                </td>
                                <td class="d-flex align-items-center justify-content-center">
                                    <a href="details_reservation.php?id=<?php echo htmlspecialchars($reservation['id']); ?>" class="shadow-none btn-sm btn-info btn-xs mx-2">Détails</a>
                                    <a href="#" class="shadow-none btn-sm btn-danger btn-xs" data-toggle="modal" data-target="#deleteModal" data-id="<?php echo htmlspecialchars($reservation['id']); ?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">Aucune réservation trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage - 1 ?>" aria-label="Précédent">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php for ($page = 1; $page <= $totalPages; $page++): ?>
                        <li class="page-item <?= ($page == $currentPage) ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $page ?>"><?= $page ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=<?= $currentPage + 1 ?>" aria-label="Suivant">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
