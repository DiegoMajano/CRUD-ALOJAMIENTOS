<?php

    require_once 'classes/Connection.php';

    class AdminDashboard {

        public static function getTotalAccommodations() {
            $connection = Connection::connect();
        
            try {
                $query = $connection->prepare("SELECT COUNT(*) AS total_accommodations FROM accommodations");
                $query->execute();
        
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result['total_accommodations'];
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }

        public static function getAccommodationByPriceRange() {
            $connection = Connection::connect();
        
            try {
                $query = $connection->prepare("SELECT COUNT(*) AS count_in_range FROM accommodations WHERE price BETWEEN 50 AND 100;");
                $query->execute();
        
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result['count_in_range'];
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }

        public static function getPopularAccommodations() {
            $connection = Connection::connect();
        
            try {
                $query = $connection->prepare("
                    SELECT a.name, COUNT(ua.id_accommodation) AS total_selections
                    FROM user_accommodation ua
                    JOIN accommodations a ON ua.id_accommodation = a.id_accommodation
                    GROUP BY ua.id_accommodation
                    ORDER BY total_selections DESC
                    LIMIT 1;
                ");
                $query->execute();
        
                $popularAccommodations = $query->fetchAll(PDO::FETCH_ASSOC);
                return $popularAccommodations;
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
        
        

    }

?>