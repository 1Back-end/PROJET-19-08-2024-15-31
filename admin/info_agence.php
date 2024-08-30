<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    <div class="col-md-12 col-sm-12 mb-3">
    <div class="card-box p-2 d-flex align-items-center">
    
        <!-- Icône de retour -->
        <a href="liste_agencies.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0 fs-5 fs-md-4 fs-lg-3">Détails de l'agence</h4>

    </div>
</div>
<?php
include_once("../database/database.php");

// Récupération de l'ID de l'agence depuis l'URL
$agencyId = $_GET['id'] ?? null;

if ($agencyId) {
    try {
        // Préparer la requête SQL pour récupérer les détails de l'agence et les informations du propriétaire
        $query = "
            SELECT a.*, 
                   o.name AS owner_name, 
                   o.email AS owner_email,
                   o.phone AS owner_phone,
                   o.address AS owner_address,
                   o.city AS owner_city,
                   o.country AS owner_country,
                   o.postal_code AS owner_postal_code,
                   o.created_at AS owner_created_at,
                   (SELECT COUNT(*) 
                    FROM agencies 
                    WHERE owner_id = o.id) AS owner_agency_count
            FROM agencies a
            JOIN owners o ON a.owner_id = o.id
            WHERE a.id = :agency_id
        ";

        // Préparer et exécuter la requête
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':agency_id', $agencyId);
        $stmt->execute();
        $agency = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des détails de l'agence : " . $e->getMessage();
    }
}
?>



<div class="col-md-12 col-sm-12">
    <div class="card-box p-3">
        <div class="row">
            <!-- Informations de l'agence -->
            <div class="col-md-6 col-sm-12 mb-3">
                <h4 class="mb-3 px-0">Informations de l'agence</h4>
                <?php if ($agency): ?>
                    <div class="mb-2">
                        <strong>N° agence :</strong> 
                        <?php echo htmlspecialchars($agency['agency_code']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Nom :</strong> 
                        <?php echo htmlspecialchars($agency['name']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Email :</strong> 
                        <?php echo htmlspecialchars($agency['email']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Téléphone :</strong> 
                        <?php echo htmlspecialchars($agency['phone']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Adresse :</strong> 
                        <?php echo htmlspecialchars($agency['address']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Ville :</strong> 
                        <?php echo htmlspecialchars($agency['city']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Pays :</strong> 
                        <?php echo htmlspecialchars($agency['country']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Code postal :</strong> 
                        <?php echo htmlspecialchars($agency['postal_code']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Ajouté le :</strong> 
                        <?php echo htmlspecialchars(date('d-m-Y à H:i', strtotime($agency['created_at']))); ?>
                    </div>
                <?php else: ?>
                    <p>Aucune agence trouvée.</p>
                <?php endif; ?>
            </div>

            <!-- Informations du propriétaire -->
            <div class="col-md-6 col-sm-12 mb-3">
                <h4 class="mb-3 px-0">Informations du propriétaire</h4>
                <?php if ($agency): ?>
                    <div class="mb-2">
                        <strong>Nom :</strong> 
                        <?php echo htmlspecialchars($agency['owner_name']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Email  :</strong> 
                        <?php echo htmlspecialchars($agency['owner_email']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Téléphone :</strong> 
                        <?php echo htmlspecialchars($agency['owner_phone']);?>
                    </div>
                    <div class="mb-2">
                        <strong>Adresse :</strong> 
                        <?php echo htmlspecialchars($agency['owner_address']);?>
                    </div>
                    <div class="mb-2">
                        <strong>Ville  :</strong> 
                        <?php echo htmlspecialchars($agency['owner_city']);?>
                    </div>
                    <div class="mb-2">
                        <strong>Pays :</strong> 
                        <?php echo htmlspecialchars($agency['owner_country']);?>
                    </div>
                    <div class="mb-2">
                        <strong>Code postal :</strong> 
                        <?php echo htmlspecialchars($agency['owner_postal_code']);?>
                    </div>
                    <div class="mb-2">
                        <strong>Ajouté  le :</strong> 
                        <?php echo htmlspecialchars(date('d-m-Y à H:i', strtotime($agency['owner_created_at']))); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Nombre d'agences :</strong> 
                        <?php echo htmlspecialchars($agency['owner_agency_count']); ?>
                    </div>
                <?php else: ?>
                    <p>Aucune information de propriétaire disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
