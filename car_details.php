<?php
include_once("database/database.php");

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

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="v1.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3010b1eaf1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
   
  <nav class="navbar navbar-expand-lg bg-white px-lg-2 py-3 shadow-sm fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <img src="logo.png" alt="Company Logo" width="150" height="40" class="d-inline-block align-top me-2">
      </a>
    </a>
    <button class="navbar-toggler shadow-none border-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0 text-center">
        <li class="nav-item">
          <a class="nav-link  mx-3" aria-current="page" href="index.php">Acceuil</a>
        </li>

        <li class="nav-item">
          <a class="nav-link  mx-3" aria-current="page" href="about.php">À propos</a>
        </li>

        <li class="nav-item">
          <a class="nav-link active mx-3" href="car.php">Nos véhicules</a>
        </li>

        <li class="nav-item">
          <a class="nav-link mx-3" href="contact.php">Nous contactez</a>
        </li>
      </ul>
      <div class="d-flex justify-content-center">
        <a href="login/login.php" class="login-btn shadow-none">Se connecter</a>
        </div>
    </div>
    
  </div>
</nav> 

<div class="container mt-5 section-padding p-3">
</div>


<div class="container mt-5 section-padding p-3 pb-5">
<div class="col-md-12 mx-auto col-sm-12 mb-3">
    <div class="card-box p-2">
    <div class="d-flex align-items-center">
        <!-- Icône de retour -->
        <a href="car.php" class="me-auto icon">
            <i class="bi bi-arrow-left-circle bi-2x"></i>
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
            <div class="card-box h-100 p-3 order-sm-1">
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
           
            <div class="detail-item">
            <strong>Notes : </strong>
            </div>
            <p class="notes">
            <?php echo htmlspecialchars($car['notes']);?>
            </p>
        </div>
        

            </div>
        </div>
        <div class="col-md-6 mb-3 col-sm-12">
            <div class="card-box h-100 p-3 h-100 order-sm-2">
            <div class="mb-2">
            <strong>Images :</strong>
                    <?php if (!empty($car['image'])): ?>
                <?php 
                // Séparer les chemins des images en un tableau
                $images = explode(',', $car['image']); 
                ?>
                <div class="car-images">
                    <?php foreach ($images as $image): ?>
                        <img src="upload/<?php echo htmlspecialchars($image); ?>" alt="Image de la voiture" class="card-img img-thumbnail">
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
            $filePath = "documents/" . htmlspecialchars($document); // Chemin complet du fichier
            ?>
            <div class="document-item">
                <?php if ($fileExtension === 'pdf' || $fileExtension === 'pdf'): ?>
                    <div class="pdf-preview">
                    <div class="document-preview align-items-center">
                        <img src="icons/pdf.png" alt="Word document" class="document-icon">
                        <a href="<?php echo $filePath; ?>" class="text-decoration-none" target="_blank">
                            <?php echo htmlspecialchars(pathinfo($document, PATHINFO_BASENAME)); ?>
                        </a>
                    </div>
                    </div>
                <?php elseif ($fileExtension === 'doc' || $fileExtension === 'docx'): ?>
                    <div class="document-preview align-items-center">
                        <img src="icons/word.png" alt="Word document" class="document-icon">
                        <a href="<?php echo $filePath; ?>" class="text-decoration-none" target="_blank">
                            <?php echo htmlspecialchars(pathinfo($document, PATHINFO_BASENAME)); ?>
                        </a>
                    </div>
                <?php elseif ($fileExtension === 'xls' || $fileExtension === 'xlsx'): ?>
                    <div class="document-preview align-items-center">
                        <img src="icons/excel.png" alt="Excel document" class="document-icon">
                        <a href="<?php echo $filePath; ?>" class="text-decoration-none" target="_blank">
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

    <a href="reservation.php?id=<?php echo $car['id']; ?>" class="reservation-button">Réserver</a>

    
    
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>