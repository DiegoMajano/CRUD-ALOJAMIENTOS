<?php

    require_once './classes/Connection.php';

    class AdminAccommodation {
        public static function addAccommodation($name, $description, $price, $image_url) {
            //VERIFICAR QUE SEA ADMIN
    
            $connection = Connection::connect();
    
            try {
                $query = $connection->prepare("INSERT INTO accommodations (name, description, price, image_url) VALUES (:name, :description, :price, :image_url)");
                $query->bindParam(':name', $name);
                $query->bindParam(':description', $description);
                $query->bindParam(':price', $price);
                $query->bindParam(':image_url', $image_url);
    
                if ($query->execute()) {
                    return "Alojamiento agregado correctamente.";
                } else {
                    return "Error al agregar el alojamiento.";
                }
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }

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

    }

?>