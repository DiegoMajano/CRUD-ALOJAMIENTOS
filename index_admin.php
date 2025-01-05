<?php require_once "classes/AdminDashboard.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!--BOOTSTRAP-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<!--ICONOS-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--STYLESHEET-->
	<link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
	<main>
		<!--sidebar-->
		<div class="menu">
			<i class="bi bi-list"></i>
			<i class="bi bi-x"></i>
		</div>
		<div class="d-flex flex-column flex-shrink-0 p-3 sidebar">
			<a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
				<i class="material-icons me-2" id="logo">bedroom_parent</i>
				<span class="fs-4 name">Dashboard</span>
			</a>
			<hr>
			<ul class="nav nav-pills flex-column mb-auto">
				<li class="nav-item">
					<a href="#" class="nav-link active">
						<i class="bi bi-house pe-none me-2" width="16" height="16"></i>
						<span>Inicio</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="views/accommodations.php" class="nav-link">
						<i class="bi bi-clipboard pe-none me-2" width="16" height="16"></i>
						<span>Alojamientos</span>
					</a>
				</li>
				<li>
					<a href="#" class="nav-link link-body-emphasis">
						<i class="bi bi-bar-chart pe-none me-2" width="16" height="16"></i>
						<span>Análisis</span>
					</a>
				</li>
				<li>
					<a href="#" class="nav-link link-body-emphasis">
						<i class="bi bi-file-earmark-arrow-down pe-none me-2" width="16" height="16"></i>
						<span>Reportes</span>
					</a>
				</li>
				<li>
					<a href="#" class="nav-link link-body-emphasis">
						<i class="bi bi-gear pe-none me-2" width="16" height="16"></i>
						<span>Ajustes</span>
					</a>
				</li>
			</ul>
			<hr>
			<div class="dropdown">
				<a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
					data-bs-toggle="dropdown" aria-expanded="false">
					<img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
					<strong>Opciones</strong>
				</a>
				<ul class="dropdown-menu text-small shadow">
					<li><a class="dropdown-item" href="#">Ajustes</a></li>
					<li><a class="dropdown-item" href="#">Perfil</a></li>
					<li>
						<hr class="dropdown-divider">
					</li>
					<li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
				</ul>
			</div>
		</div>
		<!--sidebar-->
        
        <!--DIV PRINCIPAL-->
		<div class="div-main">
			<div class="banner">
				<div class="content">
					<h1>Bienvenido Administrador:</h1>
					<p>__nombre__usuario__</p>
				</div>
			</div>
			<div class="row mt-3">
				<div class="col-lg-4">
					<div class="card-custom">
						<i class="material-icons card-icon icono1">checklist</i>
						<div class="card-content">
							<h5 class="card-title">Total de Alojamientos</h5>
                            <?php
                                $total = AdminDashboard::getTotalAccommodations();
                                echo "<p class='card-text'>$total</p>";
                            ?>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card-custom">
						<i class="material-icons card-icon icono2">history</i>
						<div class="card-content">
							<h5 class="card-title">Alojamientos Agregados Hoy</h5>
                            <?php
                                $today = AdminDashboard::getAccommodationsAddedToday();
                                echo "<p class='card-text'>$today</p>";
                            ?>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="card-custom">
						<i class="material-icons card-icon icono3">favorite</i>
						<div class="card-content">
							<h5 class="card-title">Alojamientos Más Populares</h5>
                            <?php
                                $popular = AdminDashboard::getPopularAccommodations();
                                if (is_array($popular)) {
                                    foreach ($popular as $accommodation) {
                                        echo "<p class='card-text'>".htmlspecialchars($accommodation['name'])."</p>";
                                    }
                                } else {
                                    echo "<p>Error: " . htmlspecialchars($popular) . "</p>";
                                }
                            ?>
						</div>
					</div>
				</div>
			</div>
		</div>
        <!--DIV PRINCIPAL-->
	</main>
	<script src="./assets/js/script.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>