<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-2 d-flex align-items-center">
    
        <!-- Icône de retour -->
        <a href="liste_owners.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0 fs-5 fs-md-4 fs-lg-3">Détails du propriétaire</h4>

    </div>
</div>
<?php
include_once("../database/database.php");

// Récupération de l'ID du propriétaire depuis l'URL
$ownerId = $_GET['id'] ?? null;

if ($ownerId) {
    try {
        // Requête pour récupérer les détails du propriétaire
        $queryOwner = "
            SELECT *
            FROM owners
            WHERE id = :owner_id
        ";

        // Requête pour récupérer les agences du propriétaire
        $queryAgencies = "
            SELECT *
            FROM agencies
            WHERE owner_id = :owner_id AND is_deleted = 0
            ORDER BY created_at DESC
        ";

        // Préparation et exécution de la requête pour le propriétaire
        $stmtOwner = $pdo->prepare($queryOwner);
        $stmtOwner->bindParam(':owner_id', $ownerId);
        $stmtOwner->execute();
        $owner = $stmtOwner->fetch(PDO::FETCH_ASSOC);

        // Préparation et exécution de la requête pour les agences
        $stmtAgencies = $pdo->prepare($queryAgencies);
        $stmtAgencies->bindParam(':owner_id', $ownerId);
        $stmtAgencies->execute();
        $agencies = $stmtAgencies->fetchAll(PDO::FETCH_ASSOC);

        // Compter le nombre d'agences
        $agencyCount = count($agencies);

    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des détails : " . $e->getMessage();
        exit;
    }
} else {
    echo "ID propriétaire manquant.";
    exit;
}
?>

<div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-3">
        <div class="row">
        <div class="col-md-6 col-sm-12">
            <h4 class="mb-3">Informations du propriétaire</h4>
            <?php if ($owner): ?>
                <div class="mb-2">
                    <strong>Nom :</strong> <?php echo htmlspecialchars($owner['name']); ?>
                </div>
                <div class="mb-2">
                    <strong>Email :</strong> <?php echo htmlspecialchars($owner['email']); ?>
                </div>
                <div class="mb-2">
                    <strong>Téléphone :</strong> <?php echo htmlspecialchars($owner['phone']); ?>
                </div>
                <div class="mb-2">
                    <strong>Adresse :</strong> <?php echo htmlspecialchars($owner['address']); ?>
                </div>
                <div class="mb-2">
                    <strong>Ville :</strong> <?php echo htmlspecialchars($owner['city']); ?>
                </div>
                <div class="mb-2">
                    <strong>Pays :</strong> <?php echo htmlspecialchars($owner['country']); ?>
                </div>
                <div class="mb-2">
                    <strong>Date d'ajout :</strong> <?php echo date('d/m/Y H:i', strtotime($owner['created_at'])); ?>
                </div>
            <?php else: ?>
                <p>Aucun propriétaire trouvé.</p>
            <?php endif; ?>
        </div>

        <!-- Détails des agences -->
        <div class="col-md-6 col-sm-12">
            <h4 class="mb-3">Agences du propriétaire (<?php echo $agencyCount; ?>)</h4>
            <?php if ($agencyCount > 0): ?>
                <ul class="list-group">
                    <?php foreach ($agencies as $agency): ?>
                        <li class="list-group-item">
                            <strong>Nom :</strong> <?php echo htmlspecialchars($agency['name']); ?><br>
                            <strong>Code :</strong> <?php echo htmlspecialchars($agency['agency_code']); ?><br>
                            <strong>Adresse :</strong> <?php echo htmlspecialchars($agency['address']); ?><br>
                            <strong>Ville :</strong> <?php echo htmlspecialchars($agency['city']); ?><br>
                            <strong>Pays :</strong> <?php echo htmlspecialchars($agency['country']); ?><br>
                            <strong>Ajouté le :</strong> <?php echo date('d/m/Y H:i', strtotime($agency['created_at'])); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucune agence trouvée pour ce propriétaire.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
        </div>
    </div>
</div>