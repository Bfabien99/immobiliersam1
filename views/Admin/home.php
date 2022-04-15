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
</head>
<body>
    <div class="container">
        <?php include 'topAdmin.php';?>
        <?php if(!empty($admin)):?>

            <div class="section">
                <div class="block">
                    <a href="add.php">Ajouter une propriété</a>
                </div>
                <div class="block">
                    <a href="reservation.php">Demande de reservation</a>
                </div>
            </div>
            
            <?php if(!empty($maisons)):?>
                <div class="maisons">
                    <?php foreach($maisons as $maison):?>
                        <div class="maison">
                            <img src="../../uploads/<?= $maison['image'];?>" alt="image_maison" width="100px">
                            <h3 class="description">
                            <?= $maison['description'] ;?>
                            </h3>
                            <h3 class="lieu"><?= $maison['lieu'] ;?></h3>
                            <h2 class="contact"><?= $maison['contact'] ;?></h2>
                            <h4 class="date"><?= date('h:i:s',strtotime($maison['date'])) ;?></h4>
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