<?php
    session_start();
    require '../../Admin/Admin.php';
    require '../../dconnect.php';
    $connect = $pdo;
    $Admin = new Admin();

    $msg = "";

    function cleanPost($post){
        $post = trim($post);
        $post = stripslashes($post);
        $post = strip_tags($post);
        $post = mb_strtolower($post);
        return $post;
    }

    if(!empty($_SESSION['imosam_Apseudo']) && !empty($_SESSION['imosam_Aemail'])) 
    {
        $admin = $connect->prepare("SELECT * FROM admin WHERE nom = :nom AND email = :email");
        $admin->execute(array(
            'nom' => $_SESSION['imosam_Apseudo'],
            'email' => $_SESSION['imosam_Aemail']
        ));
        $admin = $admin->fetch();

        if(!empty($_GET['maisonid'])){
            $maison = $Admin->getMaison($_GET['maisonid']);
        }
        
    }
    

    if(isset($_POST['submit'])){
        if(!empty($_POST['description']) && !empty($_POST['lieu']) && !empty($_POST['contact'])){
            //Verifie si l'image est chargée
            if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
                //Verifie la taille de l'image
                if($_FILES['image']['size'] <= 4000000){
                    $fileInfo = pathinfo($_FILES['image']['name']);
                    $extension = $fileInfo['extension'];
                    $allowedExtensions = array('jpg', 'jpeg', 'png');

                    //Verifie si l'extension est valide
                    if(in_array($extension, $allowedExtensions)){
                        //On stocke le fichier
                        $image = str_replace("/","",password_hash(rand(1,9999999), PASSWORD_DEFAULT) . basename($_FILES['image']['name']));
                        
                        $description = cleanPost($_POST['description']);
                        $lieu = cleanPost($_POST['lieu']);
                        $contact = cleanPost($_POST['contact']);
                        
                        $Admin->update($maison['id'],$description, $image, $lieu, $contact);

                        if($Admin){
                            $msg = "Enregistré";
                            move_uploaded_file($_FILES['image']['tmp_name'], '../../uploads/' . $image);

                        }
                        else{
                            $msg = "Non enregistré";
                        }
                        

                    }
                    else {
                        $msg = "Format non valide";
                    }

                }
                else {
                    $msg = "image trop volumineuse";
                }
            }
            else {
                $image = $maison['image'];
                $description = cleanPost($_POST['description']);
                $lieu = cleanPost($_POST['lieu']);
                $contact = cleanPost($_POST['contact']);
                        
                $Admin->update($maison['id'],$description, $image, $lieu, $contact);

                if($Admin){
                    header('Location:edit.php?maisonid='.$maison['id']);
                }
                else{
                    echo "Non enregistré";
                }
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
    <title>Edit</title>
    <style>
        form{
            margin: auto;
            display: flex;
            flex-direction: column;
            background-color: white;
            gap: 1em;
            font-size: 1.3rem;
            width: 100%;
            max-width: 500px;
            font-family: Roboto;
            font-weight: 200;
            padding-bottom: 10px;
            
        }

        .group{
            display: flex;
            flex-direction: column;
            gap: 0.5em;
            width: 100%;
            align-items: center;
            padding: 10px;
        }

        .group input{
            width: 100%;
            outline: none;
            border: 1px solid #444;
            border-radius: 2px;
            height: 35px;
            padding: 10px;
        }

        .group textarea{
            width: 100%;
            height:150px;
            padding: 10px;
            outline: none;
        }

        input[type="file"]{
            border: none;
            width: fit-content;
        }

        input[type="submit"]{
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
            padding: 7px;
            text-align: center;
            outline: none;
            border: none;
            color: white;
            background-color: #5C8DF9;
            cursor: pointer;
        }

        .title{
            color: white;
            background-color: #444;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include 'topAdmin.php';?>
        <div class="maison">
            <img src="../../uploads/<?= $maison['image'];?>" alt="image_maison" class="image_maison">
            <div class="content">
                <p class="indication">description</p>
                <h3 class="description">
                <?= $maison['description'] ;?></h3>
            </div>
            
            <div class="content">
                <p class="indication">lieu</p>
                <h3 class="lieu"><?= $maison['lieu'] ;?></h3>
            </div>

            <div class="content">
                <p class="indication">contact propriétaire</p>
                <h3 class="contact"><?= $maison['contact'] ;?></h3>
            </div>

            <div class="content">
            <p class="indication">date de publication</p>
            <h3 class="date"><?= date('d/m/Y à H:i:s',strtotime($maison['date'])) ;?></h3>
            </div>

            <div class="btngroup">
                <a href="edit.php?maisonid=<?php echo $maison['id']?>" id="edit">edit</a>
                <a href="delete.php?maisonid=<?php echo $maison['id']?>" id="delete">delete</a>
            </div>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <h1 class="title">MODIFIER PROPRIETE</h1>
            <div class="group">
                <label for="description">Description</label>
                <textarea name="description" id="description" value="<?= $maison['description'] ;?>"><?= $maison['description'] ;?></textarea>
            </div>
            <div class="group">
                <label for="lieu">lieu</label>
                <input type="text" name="lieu" id="lieu" value="<?= $maison['lieu'] ;?>">
            </div>
            <div class="group">
                <label for="contact">contact</label>
                <input type="tel" name="contact" id="contact" value="<?= $maison['contact'] ;?>">
            </div>
            <div class="group">
                <label for="image">image</label>
                <input type="file" name="image" id="image">
            </div>
            <?php if(!empty($msg)):?>
                <p class="msg"><?= $msg?></p>
            <?php endif; ?>
            <input type="submit" name="submit" value="Enregistrer">
        </form>

        <a href="home.php" class="back">Retour</a>
    </div>
</body>

</html>