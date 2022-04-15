<?php
    session_start();
    require '../../Admin/Admin.php';
    require '../../dconnect.php';
    $connect = $pdo;
    $Admin = new Admin();

    if(!empty($_SESSION['imosam_Apseudo']) && !empty($_SESSION['imosam_Aemail'])) 
    {
        $admin = $connect->prepare("SELECT * FROM admin WHERE nom = :nom AND email = :email");
        $admin->execute(array(
            'nom' => $_SESSION['imosam_Apseudo'],
            'email' => $_SESSION['imosam_Aemail']
        ));
        $admin = $admin->fetch();
        
    }

    function cleanPost($post){
        $post = trim($post);
        $post = stripslashes($post);
        $post = strip_tags($post);
        $post = mb_strtolower($post);
        return $post;
    }



    if(isset($_POST['submit'])){
        if(!empty($_POST['description']) && !empty($_POST['lieu']) && !empty($_POST['contact'])){
            //Verifie si l'image est chargée
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                //Verifie la taille de l'image
                if($_FILES['image']['size'] <= 1000000){
                    $fileInfo = pathinfo($_FILES['image']['name']);
                    $extension = $fileInfo['extension'];
                    $allowedExtensions = array('jpg', 'jpeg', 'png');

                    //Verifie si l'extension est valide
                    if(in_array($extension, $allowedExtensions)){
                        //On stocke le fichier
                        $image = str_replace("/","",password_hash(rand(1,9999999), PASSWORD_DEFAULT) . basename($_FILES['image']['name']));
                        move_uploaded_file($_FILES['image']['tmp_name'], '../../uploads/' . $image);
                        
                        $description = cleanPost($_POST['description']);
                        $lieu = cleanPost($_POST['lieu']);
                        $contact = cleanPost($_POST['contact']);
                        
                        $Admin->add($description, $image, $lieu, $contact);

                        if($Admin){
                            echo "Enregistré";

                        }
                        else{
                            echo "Non enregistré";
                        }
                        

                    }
                    else {
                        echo "Format non valide";
                    }

                }
                else {
                    echo "image trop volumineuse";
                }
            }
            else {
                echo "erreur d'image";
            }
        }
        else {
            echo "remplir tous les champs";
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <link rel="stylesheet" href="\SAMAEDI\IMMOBILIER\assets\css\admin.css">
    <title>Add</title>
</head>
<body>
    <div class="container">
    <?php include 'topAdmin.php';?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description">
            </div>
            <div class="group">
                <label for="lieu">lieu</label>
                <input type="text" name="lieu" id="lieu">
            </div>
            <div class="group">
                <label for="contact">contact</label>
                <input type="tel" name="contact" id="contact">
            </div>
            <div class="group">
                <label for="image">image</label>
                <input type="file" name="image" id="image">
            </div>
            <input type="submit" name="submit" value="Enregistrer">
        </form>
        <a href="home.php" class="back">Retour</a>
    </div>
</body>

</html>