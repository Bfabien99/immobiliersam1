<?php
    session_start();

    require '../dconnect.php';
    function encryptpass($pass){
        $pass = sha1($pass);
        $pass = md5($pass);
        return $pass;
    }

    function cleanPost($post){
        $post = trim($post);
        $post = stripslashes($post);
        $post = strip_tags($post);
        $post = mb_strtolower($post);
        return $post;
    }

    if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
        $pseudo = cleanPost($_POST['pseudo']);
        $password = encryptpass(strip_tags($_POST['password']));

        $connect = $pdo;
        $query = $connect->prepare("SELECT * FROM clients WHERE pseudo = :pseudo AND password = :password");
        $query->execute(array(
            'pseudo' => $pseudo,
            'password' => $password
        ));
        $result = $query->fetch();

        if ($result) {
            $_SESSION['imosam_pseudo'] = $pseudo;
            echo "ok";
        }
        else {
            echo "<p class='red'>Désolé, nom d'utilisateur ou mot de passe incorrect<p>";
        }
    }
    else {
        echo "<p class='red'>Veuillez remplir tous les champs<p>";
        die();
    }