<?php
session_start();
// Configuración de la base de datos
$host = "bdhai6vihoylt4skgtxu-mysql.services.clever-cloud.com";
$dbname = "bdhai6vihoylt4skgtxu";
$username = "uf2tsl7fm6fnbepm";
$password = "VUoe32z9QGUr2TfuDf39";

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
    <title>Landing Page de Alojamientos</title>
    <!-- Bootstrap CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="./assets/css/styles.css" rel="stylesheet">
    <!-- Agregando el favicon -->
    <link rel="icon" type="image/png" href="./assets/images/alojamiento.png" />
</head>
<body class="bg-light">
    <?php
        include_once "./views/menu.php";
    ?>
    <!-- Hero Section -->
    <section class="hero">
        <div>
            <h1>Bienvenido a los Mejores Alojamientos</h1>
            <p>Explora y encuentra el lugar ideal para tus viajes</p>
        </div>
    </section>

    <!-- Alojamientos Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Nuestros Alojamientos</h2>
        <div class="row">
            <?php foreach ($accommodations as $accommodation): ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <img src="<?= htmlspecialchars($accommodation['image_url'] ?: 'https://via.placeholder.com/350x200') ?>" 
                            class="card-img-top" alt="<?= htmlspecialchars($accommodation['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($accommodation['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($accommodation['description']) ?></p>
                            <p class="text-primary fw-bold">$<?= number_format($accommodation['price'], 2) ?></p>
                            <a href="#" class="btn btn-primary w-100">Más Información</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y') ?> Alojamientos. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="./assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>