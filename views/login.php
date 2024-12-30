<?php
    session_start();
    require_once "../classes/UserAuth.php";
    $login = '';
?>
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

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Login</title>
</head>
<body>
    <?php
        require_once "./menu.php";
    ?>
    <section class="background_login">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center vh-100">
                <div class="col-12 col-md-6 col-lg-5 col-xl-5">
                    <div class="card bg-dark text-white login">
                        <div class="card-body px-4 py-4 text-center">
                            <div class="mb-md-1 mt-md-1 pb-1">
                                <h2 class="fw-bold mb-2"><i class="bi bi-box-arrow-in-right"></i> Iniciar Session</h2>
                                <p class="text-white-50 mb-4">
                                    <i class="bi bi-info-circle-fill"></i>
                                    Ingresa tus credenciales para acceder al sistema
                                </p>
                                <form action="" method="POST">
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label fw-bold d-flex" htmlFor="typeEmailX">Correo</label>
                                        <input
                                            type="email"
                                            class="form-control form-control-lg"
                                            placeholder='Ingresa tu correo...'
                                            name="email"
                                            required
                                        />
                                    </div>

                                    <div class="form-outline form-white mb-1">
                                        <label class="form-label d-flex fw-bold" htmlFor="typePasswordX">Contraseña</label>
                                        <input
                                            type="password"
                                            class="form-control form-control-lg"
                                            placeholder='Ingresa tu contraseña...'
                                            name="password"
                                            required
                                        />
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5 mt-4" type="submit">Ingresar</button>
                                </form>
                            </div>
                            <div class="d-flex justify-content-center align-items-center py-3">
                                <span class="me-2">
                                    <i class="bi bi-question-circle-fill"></i>
                                    ¿No tienes una cuenta?
                                </span>
                                <p class="mb-0"><a href="#" class="link-info link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Registrarse</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
        if(isset($_POST['email'], $_POST['password'])){
            $password = $_POST['password'];
            $email = $_POST['email'];

            $login = UsersAuth::login($email, $password);
        }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        let loginMessage = '<?php echo $login; ?>';
    </script>
    <script src="../assets/js/login_alert.js"></script>
</body>
</html>