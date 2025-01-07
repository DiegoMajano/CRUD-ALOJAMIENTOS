<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION["id_user"];
$user = $_SESSION["user"];

require_once "../classes/UserAuth.php";

$accommodations = UsersAuth::getAccomodation($id_user)

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/accommodation.css">

    <!-- Agregando el favicon -->
    <link rel="icon" type="image/png" href="../assets/images/alojamiento.png" />

    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>User view</title>
</head>

<body>

    <?php
        include_once("./menu.php");
    ?>
    <div class="container">
        <h2>Bienvenido <b><?php echo $user ?></b> </h2>
        <p>Alojamientos seleccionados:</p>
        <?php

            if(count($accommodations) > 0) {
            foreach ($accommodations as $accommodation): ?>
                <div class="accommodation-card">
                    <?php if (!empty($accommodation['image_url'])): ?>
                        <img src="<?= htmlspecialchars($accommodation['image_url']) ?>"
                            alt="<?= htmlspecialchars($accommodation['name']) ?>">
                    <?php endif; ?>
                    <div>
                        <h3><?= htmlspecialchars($accommodation['name']) ?></h3>
                        <p><?= htmlspecialchars($accommodation['description']) ?></p>
                        <p class="price">$<?= number_format($accommodation['price'], 2) ?></p>
                    </div>
                </div>

        <?php 
            endforeach; } else {
                echo 'No existen alojamientos seleccionados';
            }
        ?>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; <?= date('Y') ?> Alojamientos. Todos los derechos reservados.</p>
    </footer>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>