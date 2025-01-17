<?php
session_start();
// Configuración de la base de datos
$host = "bdhai6vihoylt4skgtxu-mysql.services.clever-cloud.com";
$dbname = "bdhai6vihoylt4skgtxu";
$username = "uf2tsl7fm6fnbepm";
$password = "VUoe32z9QGUr2TfuDf39";

require_once (__DIR__ . "/classes/UserAuth.php");

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

if(isset($_SESSION['id_user'])){
    $id_user = $_SESSION['id_user'];
}

if (isset($_POST['add_favorite'])) {
    
    $response = UsersAuth::addFavorite($id_user, $_POST['add_favorite']); // Reemplaza con valores dinámicos

    if ($response['status'] === 'success') {
        // Guardar el mensaje de éxito en la sesión     
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "' . addslashes($response['message']) . '",
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: "top",
                    timerProgressBar: true
                });
            });
        </script>';
    } else {
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "' . addslashes($response['message']) . '",
                    showConfirmButton: false,
                    timer: 3000,
                    toast: true,
                    position: "top",
                    timerProgressBar: true
                });
            });
        </script>';
    }
    $response = json_encode($response);
}


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
    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                <?php
                                    if (isset($_SESSION['id_user'])) {
                                ?>                            
                            <form method="POST">
                                <input type="hidden" name="add_favorite" value="<?php echo $accommodation['id_accommodation'] ?>">
                                <button class="btn btn-primary w-100" type="submit">Agregar a mi cuenta</button>
                            </form>
                                <?php
                                    } 
                                ?>

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
