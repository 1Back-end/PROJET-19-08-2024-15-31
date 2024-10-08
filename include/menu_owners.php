<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php echo ucfirst(str_replace(".php", "", basename($_SERVER['PHP_SELF'])));?></title>
    <link rel="shortcut icon" href="../v1.png" type="image/x-icon">
	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/main.css">
	

</head>
<body>


	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
			
		</div>
		<div class="header-right">
			
			<div class="user-notification">
				<div class="dropdown">
					<a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
						<i class="icon-copy dw dw-notification"></i>
						<span class="badge notification-active"></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<div class="notification-list mx-h-350 customscroll">
							<ul>
								<li>
									<a href="#">
										<img src="../vendors/images/user_profile.jpg" alt="" class="shadow-none">
										<h3>Jean Dupont</h3>
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed...</p>
									</a>
								</li>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
			<?php include("../owners/session_owners.php");?>
			<?php include_once '../owners/controllers_owners.php'; ?>
			<div class="user-info-dropdown">
				<div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
					<span class="user-icon shadow-none">
						<img src="../upload/<?= htmlspecialchars($_SESSION['owner_image'] ?? '../vendors/images/profile.jpg') ?>" alt="Photo de profil" class="rounded-circle img-fluid"  width="50" height="auto"  style="border-radius: 50%; object-fit: cover; aspect-ratio: 1/1;">
					</span>
					<span class="user-name ml-3">
						<?= htmlspecialchars($_SESSION['owner_name']); ?>
					</span>

					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <small><a class="dropdown-item" href="../login/profile.php"><i class="fa fa-user-md" aria-hidden="true"></i> Profile</a></small>
						<small><a class="dropdown-item" href="../login/Changer_Mot_De_Passe.php"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Changer mot de passe</a></small>
						<small><a class="dropdown-item" href="../owners/logout_owners.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a></small>
					</div>
				</div>
			</div>
			
		</div>
	</div>
<style>
.agency-name {
  max-width: 400px; /* Limite la largeur du texte */
  white-space: nowrap; /* Empêche le texte de s'étendre sur plusieurs lignes */
  overflow: hidden; /* Cache le texte qui dépasse */
  text-overflow: ellipsis; /* Ajoute des points de suspension si le texte est trop long */
}
</style>				
  <?php 
  $owner_id = $_SESSION['owner_id'] ?? null;
  $agency_info=get_information_by_owner($pdo, $owner_id);
  ?>

	<div class="left-side-bar">
		<div class="brand-logo">
		<h3 class="text-white mb-3 text-uppercase fw-bold mt-2 p-3 agency-name">
    <?php echo !empty($agency_info['name']) ? htmlspecialchars($agency_info['name']) : 'Nom de l\'agence indisponible'; ?>
</h3>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
					<li>
						<a href="../owners/dashboard.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-analytics1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>


					<li>
						<a href="../owners/liste_marques.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-fuel"></span><span class="mtext">Marques</span>
						</a>
					</li>
					<li>
						<a href="../owners/liste_modeles.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-package"></span><span class="mtext">Modèles</span>
						</a>
					</li>

				
                    <li>
						<a href="../owners/liste_car.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-delivery-truck-2"></span><span class="mtext">Véhicules</span>
						</a>
					</li>

                   

                    <li>
						<a href="../owners/liste_reservation.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar-1"></span><span class="mtext">Réservation</span>
						</a>
					</li>

                    <li>
						<a href="../owners/payment.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-money-1"></span><span class="mtext">Payements</span>
						</a>
					</li>
                   

                    <li>
						<a href="../owners/settings.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-settings1"></span><span class="mtext">Paramètres</span>
						</a>
					</li>

					<li>
						<a href="../owners/liste_users.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user-13"></span><span class="mtext">Utilisateurs</span>
						</a>
					</li>

					<li>
						<a href="../owners/my_account.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-name"></span><span class="mtext">Mon compte</span>
						</a>
					</li>
                 
				</ul>
			</div>
		</div>
	</div>
	
		
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="../vendors/scripts/dashboard.js"></script>
</body>
</html>
