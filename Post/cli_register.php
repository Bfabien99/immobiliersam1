<?php
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

    if (!empty($_POST['nom']) && !empty($_POST['prenoms']) && !empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['contact1']) && !empty($_POST['password'])) 
    {   
        $nom = cleanPost($_POST['nom']);
        $prenoms = cleanPost($_POST['prenoms']);
        $pseudo = cleanPost($_POST['pseudo']);
        $email = cleanPost($_POST['email']);
        $contact1 = cleanPost($_POST['contact1']);
        $contact2 = cleanPost($_POST['contact2']);
        $password = encryptpass(strip_tags($_POST['password']));
        $phone1 = preg_replace('/[^0-9]/', '', $contact1);
        $phone2 = preg_replace('/[^0-9]/', '', $contact2);

        // Vé
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<p class='red'>L'email n'est pas valide<p>";
            die();
        }
        if(strlen($_POST['password'])<6 ){
            echo "<p class='red'>Le mot de passe doit contenir au moins 6 caractères<p>";
            die();
        }

        $connect = $pdo;

        // Vérification de l'existence du pseudo ou de l'email
            // Pseudo
        $isPseudo = $connect->prepare("SELECT * FROM clients WHERE pseudo = :pseudo");
        $isPseudo->execute(array(
            'pseudo' => $pseudo
        ));
        $isPseudo = $isPseudo->fetch();
        if($isPseudo){
            echo "<p class='red'>Ce pseudo est déjà utilisé<p>";
            die();
        }
            // Email
        $isEmail = $connect->prepare("SELECT * FROM clients WHERE email = :email");
        $isEmail->execute(array(
            'email' => $email
        ));
        $isEmail = $isEmail->fetch();
        if($isEmail){
            echo "<p class='red'>Cet email est déjà utilisé<p>";
            die();
        }

        // Insertion des données dans la base de données
        $query = $connect->prepare("INSERT INTO clients(nom, prenoms, pseudo, email, contact1, contact2, password) VALUES(:nom, :prenoms, :pseudo, :email, :contact1, :contact2, :password)");
        $result = $query->execute(array(
            'nom' => $nom,
            'prenoms' => $prenoms,
            'pseudo' => $pseudo,
            'email' => $email,
            'contact1' => $phone1,
            'contact2' => $phone2,
            'password' => $password
        ));

        if ($result) {
            echo "<p class='green'>Votre compte a bien été créé<p>";
        }
        else {
            echo "<p class='red'>Erreur lors de l'inscription<p>";
        }
        
    }
    else
    {
        echo "<p class='red'>remplir tous les champs<p>";
    }