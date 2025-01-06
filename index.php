<?php
session_start();

require_once (__DIR__ ."/classes/AdminDashboard.php");

// Configuración de la base de datos
$host = "bdhai6vihoylt4skgtxu-mysql.services.clever-cloud.com";
$dbname = "bdhai6vihoylt4skgtxu";
$username = "uf2tsl7fm6fnbepm";
$password = "VUoe32z9QGUr2TfuDf39";

// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

// Consulta para obtener los alojamientos
$query = "SELECT * FROM accommodations";
$stmt = $pdo->prepare($query);
$stmt->execute();
$accommodations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--BOOTSTRAP-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<!--ICONOS-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--STYLESHEET-->
	<link rel="stylesheet" href="./assets/css/style.css">
    <title>Landing Page de Alojamientos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .accommodation-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #fff;
            margin: 15px 0;
            padding: 20px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .accommodation-card img {
            max-width: 150px;
            max-height: 100px;
            margin-right: 20px;
            border-radius: 4px;
        }
        .accommodation-card h3 {
            margin: 0 0 10px;
            font-size: 1.5em;
            color: #333;
        }
        .accommodation-card p {
            margin: 0 0 5px;
            color: #666;
        }
        .accommodation-card .price {
            font-weight: bold;
            color: #007BFF;
        }
    </style>

    <!-- Agregando el favicon -->
    <link rel="icon" type="image/png" href="./assets/images/alojamiento.png" />
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
						<i class="material-icons card-icon icono2">attach_money</i>
						<div class="card-content">
							<h5 class="card-title">Alojamientos de $50 a $100</h5>
                            <?php
                                $total = AdminDashboard::getAccommodationByPriceRange();
                                echo "<p class='card-text'>$total</p>";
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

