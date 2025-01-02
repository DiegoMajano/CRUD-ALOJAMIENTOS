<?php
    class Connection {
        public static function connect() {
            try {
                $dsn = 'mysql:host=bdhai6vihoylt4skgtxu-mysql.services.clever-cloud.com;dbname=bdhai6vihoylt4skgtxu;charset=utf8';
                $user = 'uf2tsl7fm6fnbepm';
                $password = 'VUoe32z9QGUr2TfuDf39';

                $pdo = new PDO($dsn, $user, $password);
                return $pdo;
            } catch (PDOException $e) {
                echo "Error al conectarnos a la base de datos". $e->getMessage();
                exit();
            }
        }
    }
?>