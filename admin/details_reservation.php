<?php include("../include/menu.php"); ?>
<?php include("../controllers/controllers.php"); ?>
<?php include("../database/database.php"); ?>


<?php

// Récupérer l'identifiant de réservation depuis la requête GET
$id_reservation = $_GET['id'] ?? null;

$reservation = null; // Initialisation de la variable $reservation

if ($id_reservation) {
    // Préparer la requête SQL pour obtenir les détails de la réservation
    $sql = "
        SELECT 
            reservations.*,
            cars.registration_number,
            cars.price_per_day,
            (reservations.number_of_days * cars.price_per_day) AS total_cost
        FROM 
            reservations
        INNER JOIN 
            cars 
        ON 
            reservations.id_car = cars.id
        WHERE 
            reservations.id = :id_reservation;
    ";
    try {
        // Préparer et exécuter la requête
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_reservation', $id_reservation);
        $stmt->execute();
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des détails de la réservation : " . $e->getMessage();
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="main-container mt-3 pb-5">
    
    <div class="col-md-12 col-sm-12">
    <div class="card-box p-3">
        <div class="row">
            <div class="col-md-6 mb-3 col-sm-12">
                <?php if ($reservation): ?>
                    <h4 class="mb-3 px-0">Informations de la réservation</h4>
                    <div class="mb-2">
                        <strong>N° réservation :</strong> 
                        <?php echo htmlspecialchars($reservation['num_reservation']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>N° Immatriculation :</strong> 
                        <?php echo htmlspecialchars($reservation['registration_number']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Prix par jour :</strong> 
                        <?php echo htmlspecialchars(number_format($reservation['price_per_day'], 2, ',', ' ')); ?> €
                    </div>
                    <div class="mb-2">
                        <strong>Nombre de jours de location :</strong> 
                        <?php echo htmlspecialchars($reservation['number_of_days']); ?> jours
                    </div>
                    <div class="mb-2">
                        <strong>Coût total :</strong> 
                        <?php echo htmlspecialchars(number_format($reservation['total_cost'], 2, ',', ' ')); ?> €
                    </div>
                    <div class="mb-2">
                        <strong>Date de début :</strong> 
                        <?php echo htmlspecialchars(date('d M Y', strtotime($reservation['start_date']))); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Date de fin :</strong> 
                        <?php echo htmlspecialchars(date('d M Y', strtotime($reservation['end_date']))); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Commentaires :</strong> 
                        <?php echo htmlspecialchars($reservation['comments'] ?: 'Aucun commentaire'); ?>
                    </div>
                <?php else: ?>
                    <p>Aucune réservation trouvée.</p>
                <?php endif; ?>
            </div>
            
            <div class="col-md-6 mb-2 col-sm-12">
                <?php if ($reservation): ?>
                    <h4 class="mb-3">Informations du client</h4>
                    <div class="mb-2">
                        <strong>Nom complet :</strong> 
                        <?php echo htmlspecialchars($reservation['full_name']); ?>
                    </div>
                    <div class="item mb-2">
                        <strong>Email :</strong> 
                        <?php echo htmlspecialchars($reservation['email']); ?>
                    </div>
                    <div class="mb-2">
                        <strong>Téléphone :</strong> 
                        <?php echo htmlspecialchars($reservation['phone']); ?>
                    </div>
                    
                    <div class="mb-3">
                        <h4 class="mb-3">Pièces fournies</h4>
                        <div class="photos">
                            <?php 
                            // Récupérer les chemins des fichiers de pièces fournies
                            $cni_file = $reservation['cni_file'] ?? null;
                            $permis_file = $reservation['permis_file'] ?? null;

                            // Afficher les fichiers si disponibles
                            if ($cni_file || $permis_file): ?>
                                <?php if ($cni_file): ?>
                                    <div class="card-photos">
                                        <strong>CNI :</strong>
                                        <img src="../upload/<?php echo htmlspecialchars($cni_file); ?>" class="card-img img-thumbnail" alt="CNI">
                                    </div>
                                <?php endif; ?>
                                <?php if ($permis_file): ?>
                                    <div class="card-photos">
                                        <strong>Permis :</strong>
                                        <img src="../upload/<?php echo htmlspecialchars($permis_file); ?>" class="card-img img-thumbnail" alt="Permis">
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <p>Aucune pièce fournie.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p>Aucune réservation trouvée.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
