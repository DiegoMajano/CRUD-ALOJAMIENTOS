<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/CRUD-ALOJAMIENTOS/classes/Connection.php";

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

            $query = $conection->prepare("SELECT id_user, name, email, password, id_role FROM users WHERE email = :email");
            $query->bindParam(':email', $email);
            $query->execute();

            $user = $query->fetch(PDO::FETCH_ASSOC);

            if($user){
                if(password_verify($password, $user['password'])){
                    $_SESSION['id_user'] = $user['id_user'];
                    $_SESSION['user'] = $user['name'];
                    $_SESSION['id_role'] = $user['id_role'];

                    //redirigir a la pagina de inicio
                    if($user['id_role'] == 1){
                        echo "<script>window.location.replace('../index_admin.php')</script>";
                    } else {
                        echo "<script>window.location.replace('../views/user.php')</script>";
                    }
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

        public static function menuOptions($id_role) {
            $conection = Connection::connect();

            $query = $conection->prepare("SELECT r.name, m.option_name, m.route_url FROM roles r JOIN privileges p ON r.id_role = p.id_role JOIN menus m ON p.id_menu = m.id_menu WHERE r.id_role = :id_role");
            $query->bindParam(':id_role', $id_role);
            $query->execute();

            $response = $query->fetchAll(PDO::FETCH_ASSOC);

            return $response;
        }

        public static function getAccomodation($id_user) {
            $conection = Connection::connect();

            $sql = "SELECT a.id_accommodation, a.name, a.description, a.price, a.image_url
                    FROM accommodations a
                    JOIN user_accommodation ua ON a.id_accommodation = ua.id_accommodation
                    WHERE ua.id_user = :id_user";

            $stmt = $conection-> prepare($sql);
            $stmt->bindParam('id_user',$id_user, PDO::PARAM_INT);
            $stmt->execute();

            $response = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $response;
        }

        public static function addFavorite($id_user, $id_accommodation) {

            $conection = Connection::connect();

            $sqlCheck = 'SELECT COUNT(*) as count 
                     FROM user_accommodation 
                     WHERE id_user = :id_user AND id_accommodation = :id_accommodation';

            $stmtCheck = $conection->prepare($sqlCheck);
            $stmtCheck->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmtCheck->bindParam(':id_accommodation', $id_accommodation, PDO::PARAM_INT);
            $stmtCheck->execute();
            $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

            if ($result['count'] > 0) {
                return ['status' => 'error', 'message' => 'Este alojamiento ya está en favoritos'];
            }

            $sql = 'INSERT INTO user_accommodation (id_user, id_accommodation, created_at) VALUES (:id_user, :id_accommodation, CURRENT_TIMESTAMP)';

            $stmt = $conection->prepare($sql);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_accommodation', $id_accommodation,PDO::PARAM_INT);
            $response  = $stmt->execute();

            if($response) {
                return ['status' => 'success', 'message' => 'Se ha agregado a favoritos exitosamente'];
            } else {
                return ['status' => 'error', 'message' => 'No se ha podido agregar a favoritos'];
            }
        }

        public static function deleteFavorite($id_user, $id_accommodation) {
        
            $conection = Connection::connect();

            $sql = 'DELETE FROM user_accommodation WHERE id_user = :id_user AND id_accommodation = :id_accommodation ';
            $stmt = $conection->prepare($sql);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_accommodation', $id_accommodation,PDO::PARAM_INT);
            $response  = $stmt->execute();

            if($response) {
                return ['status' => 'success', 'message' => 'Se ha eliminado a favoritos exitosamente'];
            } else {
                return ['status' => 'error', 'message' => 'No se ha podido eliminar des favoritos'];
            }
        
        }

    }
?>