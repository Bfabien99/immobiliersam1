<?php
    session_start();
    require '../../dconnect.php';
    require '../../Admin/Admin.php';
    $connect = $pdo;

    //Identification du client par son pseudo en session
    if(!empty($_SESSION['imosam_Apseudo']) && !empty($_SESSION['imosam_Aemail'])) 
    {
        $admin = $connect->prepare("SELECT * FROM admin WHERE nom = :nom AND email = :email");
        $admin->execute(array(
            'nom' => $_SESSION['imosam_Apseudo'],
            'email' => $_SESSION['imosam_Aemail']
        ));
        $admin = $admin->fetch();
        
    }

    $maisons = new Admin();
    $maisons = $maisons->getAllMaisons();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <link rel="stylesheet" href="\SAMAEDI\IMMOBILIER\assets\css\admin.css">
    <title>Admin</title>
    <style>
        .section{
            display: flex;
            width: 100%;
            max-width: 400px;
            justify-content: space-around;
            align-items: center;
        }

        .section .block a{
            text-decoration: none;
            color: white;
            padding: 5px 7px;
            border-radius: 2px;
        }

        .add{
            background-color: green;
        }

        .reserver{
            background-color: #444;
        }

        #edit{
            background-color: green;
            text-decoration: none;
            min-width: 100px;
            text-align: center;
            margin: 5px;
        }

        #delete{
            background-color: red;
            text-decoration: none;
            min-width: 100px;
            text-align: center;
            margin: 5px;
        }

    </style>
</head>
<body>
    <div class="container">
        <?php include 'topAdmin.php';?>
        <?php if(!empty($admin)):?>

            <div class="section">
                <div class="block">
                    <a href="add.php" class="add">Ajouter une propriété</a>
                </div>
                <div class="block">
                    <a href="reservation.php" class="reserver">Demande de reservation</a>
                </div>
            </div>
            
            <?php if(!empty($maisons)):?>
                <h3>Liste des propriétés</h3>
                <div class="maisons">
                    <?php foreach($maisons as $maison):?>
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
                    <?php endforeach ;?>
                </div>
            <?php endif ;?>

        <?php else:?>
            <?php header('location: ../../error.php');?>
        <?php endif;?>
    </div>
</body>
</html>