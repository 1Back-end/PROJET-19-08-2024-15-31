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
			
			<div class="user-info-dropdown">
				<div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon shadow-none">
							<img src="../vendors/images/user_profile.png" alt="">
						</span>
						<span class="user-name">Jean Dupont</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <small><a class="dropdown-item" href="../login/profile.php"><i class="fa fa-user-md" aria-hidden="true"></i> Profile</a></small>
						<small><a class="dropdown-item" href="../login/Changer_Mot_De_Passe.php"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Changer mot de passe</a></small>
						<small><a class="dropdown-item" href="../login/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</a></small>
					</div>
				</div>
			</div>
			
		</div>
	</div>

	
				
					

	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="##">
				<img src="../logo.png" alt="" class="">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
					<li>
						<a href="../admin/dashboard.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-analytics1"></span><span class="mtext">Dashboard</span>
						</a>
					</li>

                    <li>
						<a href="../admin/liste_marques.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-fuel"></span><span class="mtext">Marques</span>
						</a>
					</li> 
                   

                    <li>
						<a href="invoice.html" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-settings1"></span><span class="mtext">Paramètres</span>
						</a>
					</li>

					<li>
						<a href="../admin/liste_users.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-user-13"></span><span class="mtext">Utilisateurs</span>
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