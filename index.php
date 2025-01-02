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
    <?php require_once "./classes/AdminAccommodation.php";  ?>
    <div class="container">
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Alojamiento</button>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $accommodations = AdminAccommodation::getAccommodation();
                    if (is_array($accommodations)) {
                        foreach ($accommodations as $accommodation) {
                            echo "<tr>";
                            echo "<th scope='row'>" . htmlspecialchars($accommodation['id_accommodation']) . "</th>";
                            echo "<td>" . htmlspecialchars($accommodation['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($accommodation['description']) . "</td>";
                            echo "<td>$" . htmlspecialchars($accommodation['price']) . "</td>";
                            echo "<td>";
                            echo "<img width='200px' src='" . htmlspecialchars($accommodation['image_url']) . "' alt='" . htmlspecialchars($accommodation['name']) . "'>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<caption>Aún no hay alojamientos</caption>";
                    }
                ?>
                
            </tbody>
        </table>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registra un Alojamiento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nombre Hotel</label>
                            <input class="form-control" name="name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input class="form-control" name="price">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagen</label>
                            <input class="form-control" name="image_url">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <?php
            if(isset($_POST['name'], $_POST['description'], $_POST['price'], $_POST['image_url'],)){
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $image_url = $_POST['image_url'];
            
                $result = AdminAccommodation::addAccommodation($name, $description, $price, $image_url);
                echo "<p>$result</p>";
            }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

