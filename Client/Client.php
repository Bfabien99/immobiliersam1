<?php
    class Client{
        
        public function dbConnect() 
        {
            $dsn="mysql:dbname=immobiliersam;host=localhost";
            $password = "";
            $user = "root";

            $connect = new PDO($dsn,$user,$password,[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);

            if($connect){
                return $connect;
            }
            else{
                echo "Erreur de connexion à la base de données";
            }
        }

        public function getInteresser($userId, $maisonId)
        {
            $db = $this->dbConnect();
            $getInterest = $db->prepare("SELECT * FROM interest INNER JOIN maisons on maison_id = maisons.id WHERE maison_id = $maisonId AND client_id = $userId");
            $getInterest->execute();
            $getInterest = $getInterest->fetch();

            if($getInterest){
                return $getInterest;
            }
            else {
                return false;
            }
        }
        
        public function interesser($userId, $maisonId)
        {
            $db = $this->dbConnect();
            $insert = $db->prepare("INSERT INTO interest SET maison_id = $maisonId, client_id = $userId");
            $insert->execute();

            if($insert){
                return $insert;
            }
            else {
                return false;
            }
        }

        public function getReserver($userId, $maisonId)
        {
            $db = $this->dbConnect();
            $reserver = $db->prepare("SELECT * FROM reservation INNER JOIN maisons on maison_id = maisons.id WHERE maison_id = $maisonId AND client_id = $userId");
            $reserver->execute();
            $reserver = $reserver->fetch();

            if($reserver){
                return $reserver;
            }
            else {
                return false;
            }
        }

        public function getAllInterest($userId)
        {
            $db = $this->dbConnect();
            $interest = $db->prepare("SELECT * FROM interest WHERE client_id = $userId");
            $interest->execute();
            $interest = $interest->fetchAll();

            if($interest){
                return $interest;
            }
            else {
                return false;
            }
        }

        public function reserver($userId, $maisonId, $date, $heure)
        {
            $db = $this->dbConnect();
            $insert = $db->prepare("INSERT INTO reservation SET maison_id = $maisonId, client_id = $userId, date_res = :date, heure = :heure");
            $insert->execute(array(
                "date" => $date,
                "heure" => $heure
            ));

            if($insert){
                return $insert;
            }
            else {
                return false;
            }
        }

        public function getActiveReserver($userId)
        {
            $db = $this->dbConnect();
            $reserver = $db->prepare("SELECT * FROM `reservation` INNER JOIN maisons on maison_id = maisons.id WHERE client_id = $userId AND active = 1");
            $reserver->execute();
            $reserver = $reserver->fetchAll();

            if($reserver){
                return $reserver;
            }
            else {
                return false;
            }
        }

        
    }