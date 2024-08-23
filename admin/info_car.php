<?php include("../include/menu.php");?>
<?php include("../controllers/controllers.php");?>
<link rel="stylesheet" href="style.css">

<?php
include_once("../database/database.php");

// Récupération de l'ID de la voiture depuis l'URL
$id_car = $_GET["id"] ?? null;

if ($id_car) {
    try {
        $query = "
            SELECT 
                cars.*, 
                carbrands.name AS brand_name
            FROM 
                cars
            INNER JOIN 
                carbrands ON cars.brand_id = carbrands.id
            WHERE 
                cars.id = :id AND cars.is_deleted = 0;
        ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id_car);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($car) {
            // Les informations de la voiture sont maintenant disponibles dans la variable $car
            // Vous pouvez les utiliser pour afficher les détails à l'utilisateur
        } else {
            // Voiture non trouvée ou déjà supprimée
            echo "Voiture non trouvée ou déjà supprimée.";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs PDO
        echo "Erreur: " . $e->getMessage();
    }
} else {
    echo "ID de la voiture non fourni.";
}
?>



<div class="main-container mt-2 pb-3">
<div class="col-md-12 mx-auto col-sm-12 mb-3">
    <div class="card-box p-2">
    <div class="d-flex align-items-center">
        <!-- Icône de retour -->
        <a href="liste_car.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle"></i>
        </a>
        <!-- Titre centré -->
        <h4 class="text-uppercase fw-bold flex-grow-1 text-center mb-0">Détails du véhicule</h4>
    </div>
</div>
</div>
<?php if ($car): ?>
<div class="col-md-12 col-sm-12">
    <div class="row">
        <div class="col-md-6 mb-3 col-sm-12">
            <div class="card-box p-2 h-100">
            <div class="car-details">
            <div class="detail-item mb-2">
                <strong>N° Immatriculation :</strong> 
                <?php echo htmlspecialchars($car['registration_number']); ?>
            </div>
            <div class="detail-item mb-2">
                <strong>Marque :</strong> 
                <?php echo htmlspecialchars($car['brand_name']); ?>
            </div>
            <div class="detail-item mb-2">
                <strong>Modèle :</strong> 
                <?php echo htmlspecialchars($car['model']); ?>
            </div>
            <div class="detail-item mb-2">
                <strong>Type carburant :</strong> 
                <?php echo htmlspecialchars($car['fuel_type']); ?>
            </div>
            <div class="detail-item mb-2">
                <strong>Transmission :</strong>
                <?php echo htmlspecialchars($car['transmission']); ?>
            </div>
            <div class="detail-item mb-2">
                <strong>Couleur:</strong>
                <?php echo htmlspecialchars($car['color']); ?>
            </div>
            <div class="mb-2 detail-item">
                <strong>Nombres de places :</strong>
                <?php echo htmlspecialchars($car['seats']); ?>
            </div>
            <div class="mb-2 detail-item">
                <strong>Kilométrage : </strong>
                <?php echo htmlspecialchars($car['mileage']); ?> Km
            </div>
            <div class="mb-2 detail-item">
                <strong>Prix par jour : </strong>
                <?php echo htmlspecialchars($car['price_per_day']);?> FCFA 
            </div>
            <div class="mb-2 detail-item">
                <strong>Statut de Disponibilité : </strong>
                <?php echo htmlspecialchars($car['availability_status']);?>
            </div>
            <div class="mb-2 detail-item">
            <strong>Expiration de l'Assurance : </strong>
            <?php echo date('d/m/Y', strtotime($car['insurance_expiration'])); ?>

            </div>
            <div class="detail-item">
            <strong>Notes : </strong>
            </div>
            <p>
            <?php echo htmlspecialchars($car['notes']);?>
            </p>
        </div>

            </div>
        </div>
        <div class="col-md-6 mb-3 col-sm-12">
            <div class="card-box p-3 h-100">
            <div class="mb-2">
            <strong>Images :</strong>
                    <?php if (!empty($car['image'])): ?>
                <?php 
                // Séparer les chemins des images en un tableau
                $images = explode(',', $car['image']); 
                ?>
                <div class="car-images">
                    <?php foreach ($images as $image): ?>
                        <img src="../upload/<?php echo htmlspecialchars($image); ?>" alt="Image de la voiture" class="car-image img-thumbnail">
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Aucune image disponible</p>
            <?php endif; ?>
            </div>


            <div class="mb-2">
            <strong>Documents :</strong>
            <?php if (!empty($car['documents'])): ?>
    <?php 
    // Séparer les chemins des documents en un tableau
    $documents = explode(',', $car['documents']); 
    ?>
    <div class="car-documents">
        <?php foreach ($documents as $document): ?>
            <?php 
            $fileExtension = strtolower(pathinfo($document, PATHINFO_EXTENSION));
            $filePath = "../documents/" . htmlspecialchars($document); // Chemin complet du fichier
            ?>
            <div class="document-item">
                <?php if ($fileExtension === 'pdf' || $fileExtension === 'pdf'): ?>
                    <div class="pdf-preview">
                    <div class="document-preview align-items-center">
                        <img src="../icons/pdf.png" alt="Word document" class="document-icon">
                        <a href="<?php echo $filePath; ?>" target="_blank">
                            <?php echo htmlspecialchars(pathinfo($document, PATHINFO_BASENAME)); ?>
                        </a>
                    </div>
                    </div>
                <?php elseif ($fileExtension === 'doc' || $fileExtension === 'docx'): ?>
                    <div class="document-preview align-items-center">
                        <img src="../icons/word.png" alt="Word document" class="document-icon">
                        <a href="<?php echo $filePath; ?>" target="_blank">
                            <?php echo htmlspecialchars(pathinfo($document, PATHINFO_BASENAME)); ?>
                        </a>
                    </div>
                <?php elseif ($fileExtension === 'xls' || $fileExtension === 'xlsx'): ?>
                    <div class="document-preview align-items-center">
                        <img src="../icons/excel.png" alt="Excel document" class="document-icon">
                        <a href="<?php echo $filePath; ?>" target="_blank">
                            <?php echo htmlspecialchars(pathinfo($document, PATHINFO_BASENAME)); ?>
                        </a>
                    </div>
                <?php else: ?>
                    <p>Document de type inconnu: <?php echo htmlspecialchars(pathinfo($document, PATHINFO_BASENAME)); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun document disponible</p>
<?php endif; ?>

            
            </div>

            </div>

            
        </div>
    </div>

    <?php else: ?>
            <p>Voiture non trouvée ou déjà supprimée.</p>
        <?php endif; ?>
</div>




















</div>

