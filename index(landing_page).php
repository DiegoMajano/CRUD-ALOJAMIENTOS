<?php
session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
</head>
<body>
    <?php
        require_once "./views/menu.php";
    ?>
    <div class="container">
        <h1>Bienvenido a los Alojamientos</h1>
        <p>Encuentra el mejor lugar para alojarte:</p>  
        <?php foreach ($accommodations as $accommodation): ?>
            <div class="accommodation-card">
                <?php if (!empty($accommodation['image_url'])): ?>
                    <img src="<?= htmlspecialchars($accommodation['image_url']) ?>" alt="<?= htmlspecialchars($accommodation['name']) ?>">
                <?php endif; ?>
                <div>
                    <h3><?= htmlspecialchars($accommodation['name']) ?></h3>
                    <p><?= htmlspecialchars($accommodation['description']) ?></p>
                    <p class="price">$<?= number_format($accommodation['price'], 2) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

