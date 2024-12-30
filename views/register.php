<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Register</title>
</head>

<body class="bg-light">
    <?php
    require_once "./menu.php";
    ?>
    <section class="container-fluid py-4">
        <div class="text-center py-2">
            <img src="../assets/images/perfil-del-usuario.png" alt="" class="img-fluid" style="width: 5rem;">
            <h2>Registro de usuario</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6">
                <form action="" method="post">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="username" class="form-label">Nombre de usuario</label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" id="username" placeholder="Username" required="">
                            </div>
                        </div>
            
                        <div class="col-12">
                            <label for="email" class="form-label">Correo</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                <input type="email" class="form-control" id="email" placeholder="correo@example.com">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="password" placeholder="Contraseña" required="">
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password" class="form-label">Confirmar contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control" id="confirm_password" placeholder="Confirmar Contraseña" required="">
                            </div>
                        </div>
                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Registrarse</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>