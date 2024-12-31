<?php
    require_once "../classes/Connection.php";

    class UsersAuth {
        public static function register($name, $email, $password, $confirm_password){
            $conection = Connection::connect();

            if(!isset($name, $email, $password)){
                return ['status' => 'error', 'message' => 'Por favor ingrese un nombre, correo y contraseña'];
                exit;
            }

            $query = $conection->prepare("SELECT email FROM users WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            if($query->rowCount() > 0){
                return ['status' => 'error', 'message' => 'El correo ya esta registrado'];
                exit;
            }

            if($password != $confirm_password){
                return ['status' => 'error', 'message' => 'Las contraseñas no coinciden'];
                exit;
            }

            $password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);

            $query = $conection->prepare("INSERT INTO users (name, email, password, id_role) VALUES (:name, :email, :password, 2)");
            $query->bindParam(':name', $name);
            $query->bindParam(':email', $email);
            $query->bindParam(':password', $password);
            $query->execute();

            return ['status' => 'success', 'message' => 'Usuario registrado correctamente'];
        }

        public static function login($email, $password){
            $conection = Connection::connect();

            if(!isset($email, $password)){
                return "Por favor ingrese un correo y una contraseña";
                exit;
            }

            $query = $conection->prepare("SELECT id_user, name, email, password FROM users WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            $user = $query->fetch(PDO::FETCH_ASSOC);

            if($user){
                if(password_verify($password, $user['password'])){
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['user'] = $user['name'];

                    //redirigir a la pagina de inicio con js
                    echo "<script>window.location.replace('../index(landing_page).php')</script>";
                } else {
                    return "Credenciales Incorrectas password";
                }
            }

            return "Usuario o contraseña incorrectos email";
        }

        public static function logOut(){
            session_start();
            session_destroy();
            session_unset();
            header("location: ../views/login.php");
            exit;
        }

        public static function verifySession(){
            session_start();

            if(!isset($_SESSION['id_user'])){
                header("location: ../views/login.php?error=Debes iniciar sesion");
                exit;
            }
        }
    }
?>