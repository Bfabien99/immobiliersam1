<?php
    class Admin{
        
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
        
        public function add($description, $image, $lieu, $contact)
        {
            $db = $this->dbConnect();
            $insert = $db->prepare("INSERT INTO maisons SET description = :description, image = :image, lieu = :lieu, contact = :contact");
            $insert->execute(array(
                'description' => $description,
                'image' => $image,
                'lieu' => $lieu,
                'contact' => $contact
            ));

            if($insert){
                return $insert;
            }
            else {
                return false;
            }
        }

        public function getAllMaisons(){
            $db = $this->dbConnect();
            $getAll = $db->prepare("SELECT * FROM maisons");
            $getAll->execute();
            $maisons = $getAll->fetchAll();

            if($maisons){
                return $maisons;
            }
            else {
                return false;
            }
        }

        public function getMaison($id){
            $db = $this->dbConnect();
            $get = $db->prepare("SELECT * FROM maisons WHERE id = $id");
            $get->execute();
            $maison = $get->fetch();

            if($maison){
                return $maison;
            }
            else {
                return false;
            }
        }

        public function update($id,$description, $image, $lieu, $contact)
        {
            $db = $this->dbConnect();
            $update = $db->prepare("UPDATE maisons SET description = :description, image = :image, lieu = :lieu, contact = :contact WHERE id = $id");
            $update->execute(array(
                'description' => $description,
                'image' => $image,
                'lieu' => $lieu,
                'contact' => $contact
            ));

            if($update){
                return $update;
            }
            else {
                return false;
            }
        }

        public function delete($id){
            $db = $this->dbConnect();
            $delete = $db->prepare("DELETE FROM maisons WHERE id = $id");
            $delete->execute();

            if($delete){
                return $delete;
            }
            else {
                return false;
            }
        }

        public function getReservation()
        {
            $db = $this->dbConnect();
            $reserver = $db->prepare("SELECT * FROM reservation INNER JOIN maisons ON maison_id = maisons.id");
            $reserver->execute();
            $reserver = $reserver->fetchAll();

            if($reserver){
                return $reserver;
            }
            else {
                return false;
            }
        }

        public function activate($userId, $maisonId){
            $db = $this->dbConnect();
            $activate = $db->prepare("UPDATE reservation SET active = 1 WHERE maison_id = $maisonId AND client_id = $userId");
            $activate->execute();

            if($activate){
                return $activate;
            }
            else {
                return false;
            }
        }

        public function getUser($id){
            $db = $this->dbConnect();
            $user = $db->prepare("SELECT * FROM clients WHERE id = $id");
            $user->execute();
            $user = $user->fetch();

            if($user){
                return $user;
            }
            else {
                return false;
            }
        }
    }