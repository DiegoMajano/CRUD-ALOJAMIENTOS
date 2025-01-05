<?php require_once "../classes/AdminAccommodation.php"; ?>
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
	<link rel="stylesheet" href="../assets/css/style.css">
    <!--JQUERY-->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
					<a href="../index.php" class="nav-link">
						<i class="bi bi-house pe-none me-2" width="16" height="16"></i>
						<span>Inicio</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link active">
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
            <button type="button" class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Alojamiento</button>
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="accommodationTable">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
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
                                    echo "<td><img width='100px' src='" . htmlspecialchars($accommodation['image_url']) . "' alt='" . htmlspecialchars($accommodation['name']) . "'></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>Aún no hay alojamientos</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registra un Alojamiento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nombre Hotel</label>
                                <input class="form-control" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea class="form-control" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Precio</label>
                                <input type="number" class="form-control" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Usuarios</label>
                                <select class="form-select" name="idUser" required>
                                    <option selected disabled value="">Selecciona una opción</option>
                                    <?php
                                        $info = AdminAccommodation::getUsers();
                                        if (is_array($info)) {
                                            foreach ($info as $inf) {
                                                echo "<option value=".$inf['id_user'].">".$inf['name']."</option>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='5'>Aún no hay usuarios</td></tr>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Imagen</label>
                                <input type="file" name="image" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-dark">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--DIV PRINCIPAL-->
        <?php
            if (isset($_POST['name'], $_POST['description'], $_POST['price'], $_FILES['image'], $_POST['idUser'])) {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $imageFile = $_FILES['image'];
                $idUser = $_POST['idUser'];
                $result = AdminAccommodation::addAccommodation($name, $description, $price, $imageFile, $idUser);
                echo "<p>$result</p>";
            }
        ?>
		</div>
	</main>
	<script src="../assets/js/script.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#accommodationTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "emptyTable": "No hay datos disponibles en la tabla"
                }
            });
        });
    </script>
</body>

</html>