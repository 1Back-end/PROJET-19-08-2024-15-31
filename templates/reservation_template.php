<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservation Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  </head>
  <style>
    body{
        font-family: "Poppins", sans-serif;
    }
    .logo{
        max-width: 150px;
    }
    .description{
        text-align: justify;
        font-size: 14px;
        line-height: 1.5;
    }
    .fw-bold{
        font-weight: bold;
        font-size: 18px;
    }
    .card-box{
        -webkit-box-shadow: 0 0 28px rgba(0,0,0,.08);
        box-shadow: 0 0 28px rgba(0,0,0,.08);
    }
    @media (max-width: 576px) {
       .description{
            font-size: 14px;
        }
        .fw-bold{
            font-size: 16px;
            font-weight:700;
        }
        .logo{
            max-width: 120px;
        }
        p{
            font-size: 16px;
            line-height: 1.4;
            margin-bottom: 10px;
            margin-top: 10px;
            margin-bottom: 0;
           
        }


    }
  </style>
  <body>
    <div class="container mt-5">
        <div class="col-md-6 col-sm-12 p-3 mb-5 card-box rounded mx-auto">
                <div class="d-flex align-items-center  justify-content-between mb-3">
                    <h4 class="fw-bold text-uppercase mb-0">Nouvelle réservation</h4>
                    <img src="https://i.imgur.com/u5s20o2.png" alt="Logo de l'Entreprise" class="img-fluid rounded" style="max-width: 100px;">
                </div>

                <div class="mb-3">
                    <div class="description">
                    <p>Découvrez les détails de votre nouvelle réservation ci-dessous.</p>
                    </div>
                </div>
                <div class="row">
            <!-- Reservation Details -->
            <div class="col-md-6 mb-3">
                <h6 class="text-uppercase fw-bold">Détails de la réservation</h6>
                <p><i class="bi bi-list"></i> Date de début : <span class="text-muted">{{ date_debut }}</span></p>
                <p><i class="bi bi-list"></i> Date de fin : <span class="text-muted">{{ date_fin }}</span></p>
                <p><i class="bi bi-list"></i> Nombre de jours : <span class="text-muted">{{ nombre_jours }}</span></p>
                <p><i class="bi bi-list"></i> Client : <span class="text-muted">{{ nom_client }}</span></p>
                <p><i class="bi bi-list"></i> Email : <span class="text-muted">{{ email_client }}</span></p>
                <p><i class="bi bi-list"></i> Téléphone : <span class="text-muted">{{ telephone_client }}</span></p>
            </div>
            
            <!-- Vehicle Details -->
            <div class="col-md-6 mb-3">
                <h6 class="text-uppercase fw-bold">Détails du véhicule</h6>
                <p><i class="bi bi-list"></i> Marque : <span class="text-muted">{{ marque_vehicule }}</span></p>
                <p><i class="bi bi-list"></i> Modèle : <span class="text-muted">{{ modele_vehicule }}</span></p>
                <p><i class="bi bi-list"></i> Couleur : <span class="text-muted">{{ couleur_vehicule }}</span></p>
                <p><i class="bi bi-list"></i> Prix par jour : <span class="text-muted">{{ prix_vehicule }} Frcfa</span></p>
                <p><i class="bi bi-list"></i> Kilométrage : <span class="text-muted">{{ kilometrage_vehicule }} Km</span></p>
                <p><i class="bi bi-list"></i> Immatriculation : <span class="text-muted">{{ immatriculation_vehicule }}</span></p>
            </div>
        </div>

        <div class="mb-2 text-center">
            <a href="{{ lien_reservation }}" class="btn btn-primary shadow-none border-none py-2">Voir la réservation</a>
        </div>
        <footer class="footer mb-2 text-center">
        <small class="text-muted text-center" id="copyright"></small>
    </footer>

    </div>

   

        </div>
    </div>

    <script>
        // JavaScript to set the current year
        document.addEventListener('DOMContentLoaded', function() {
            var currentYear = new Date().getFullYear();
            document.getElementById('copyright').textContent = '© ' + currentYear + ' Copyright. Tous droits réservés.';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

