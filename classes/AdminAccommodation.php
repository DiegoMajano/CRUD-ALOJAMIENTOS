<?php

    require_once '../classes/Connection.php';
    //PRIMERO DEBO GUARDAR LA IMAGEN, DESPUES OBTENER EL URL, DESPUES GUARDAR EL ALOJAMIENTO, DESPUES OBTENER EL ID DEL ALOJAMIENTO, DESPUES ALMACENAR EN USER_ACCOMMODOTION

    class AdminAccommodation {

        public static function getAccommodation(){
            $connection = Connection::connect();

            try {
                $query = $connection->prepare("SELECT id_accommodation, name, description, price, image_url FROM accommodations");
                $query->execute();

                $accommodations = $query->fetchAll(PDO::FETCH_ASSOC);
                return $accommodations;
            } catch (Exception $e) {
                return "Error al listar alojamientos: " . $e->getMessage();
            }
        }

        public static function uploadImage($imageFile)
        {
            $apiKey = '163da694cb6170a99f7e0319c5984eb6';

            // Verificando si el archivo fue cargado
            if (!isset($imageFile) || $imageFile['error'] !== UPLOAD_ERR_OK) {
                return ["success" => false, "message" => "Error: no se pudo cargar el archivo de imagen."];
            }

            $imageTempPath = $imageFile['tmp_name'];

            $imageData = base64_encode(file_get_contents($imageTempPath));

            // Solicitud a la API de ImgBB
            $url = "https://api.imgbb.com/1/upload";
            $data = [
                'key' => $apiKey,
                'image' => $imageData
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            curl_close($ch);
            $responseDecoded = json_decode($response, true);

            if (isset($responseDecoded['data']['url'])) {
                // Url de la imagen
                return ["success" => true, "image_url" => $responseDecoded['data']['url']];
            } else {
                return ["success" => false, "message" => "Error al subir la imagen: " . $responseDecoded['error']['message']];
            }
        }

        public static function addAccommodation($name, $description, $price, $imageFile, $id_user)
        {
            $uploadResponse = self::uploadImage($imageFile);

            if (!$uploadResponse['success']) {
                return $uploadResponse['message'];
            }

            $image_url = $uploadResponse['image_url'];

            $connection = Connection::connect();

            try {
                $query = $connection->prepare("INSERT INTO accommodations (name, description, price, image_url) VALUES (:name, :description, :price, :image_url)");
                $query->bindParam(':name', $name);
                $query->bindParam(':description', $description);
                $query->bindParam(':price', $price);
                $query->bindParam(':image_url', $image_url);

                if ($query->execute()) {
                    $generatedId = $connection->lastInsertId();
                    $result = self::addUserAccommodation($id_user, $generatedId);
                    return $result;
                    //return "Alojamiento agregado correctamente.".$generatedId;
                } else {
                    return "Error al agregar el alojamiento.";
                }
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }

        public static function addUserAccommodation($id_user, $id_accommodation)
        {
            date_default_timezone_set('America/El_Salvador');
            $created_at = date('Y-m-d');
            
            $connection = Connection::connect();

            try {
                $query = $connection->prepare("INSERT INTO user_accommodation (id_user, id_accommodation, created_at) VALUES (:id_user, :id_accommodation, :created_at)");
                $query->bindParam(':id_user', $id_user);
                $query->bindParam(':id_accommodation', $id_accommodation);
                $query->bindParam(':created_at', $created_at);

                if ($query->execute()) {
                    return "Alojamiento agregado correctamente.";
                } else {
                    return "Error al agregar el alojamiento con el usuario";
                }
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }

        public static function getUsers(){
            $connection = Connection::connect();
            try {
                $query = $connection->prepare("SELECT name, id_user FROM users WHERE id_role = 1");
                $query->execute();

                $info = $query->fetchAll(PDO::FETCH_ASSOC);
                return $info;
            } catch (Exception $e) {
                return "Error" . $e->getMessage();
            }
        }

    }

?>