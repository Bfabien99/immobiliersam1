<?php
session_start();
    require '../../Admin/Admin.php';
    require '../../dconnect.php';
    $connect = $pdo;
    $Admin = new Admin();

    //Identification du client par son pseudo en session
    if(!empty($_SESSION['imosam_Apseudo']) && !empty($_SESSION['imosam_Aemail'])) 
    {
        $admin = $connect->prepare("SELECT * FROM admin WHERE nom = :nom AND email = :email");
        $admin->execute(array(
            'nom' => $_SESSION['imosam_Apseudo'],
            'email' => $_SESSION['imosam_Aemail']
        ));
        $admin = $admin->fetch();

        $reservation = $Admin->getReservation();
        
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <link rel="stylesheet" href="\SAMAEDI\IMMOBILIER\assets\css\admin.css">
    <title>Demande</title>
</head>
<body>
    <div class="container">
    <?php include 'topAdmin.php';?>
        <?php if(!empty($reservation)):?>
            <div class="section">
                <?php foreach($reservation as $reserver):?>
                    <?php $user = $Admin->getUser($reserver['client_id']);?>
                    <?php if($reserver["active"] == 0):?>
                        <div class="reserver">
                            <img src="../../uploads/<?= $reserver["image"];?>" alt="image_maison" width="200px">
                            <h3>
                                <em>Description: <?= $reserver["description"];?></em>
                            </h3>
                            <h3>
                                <em>Lieu: <?= $reserver["lieu"];?></em>
                            </h3>
                            <h3>
                                <em>Contact Proprio: <?= $reserver["contact"];?></em>
                            </h3>
                            <h3>
                                <em>Date Reservation: <?= $reserver["fait_le"];?></em>
                            </h3>
                            <h3>
                                <em>Demandeur: <?= $user["nom"] . " " . $user["prenoms"];?></em>
                            </h3>
                            <a href="enable.php?id=<?= $reserver['client_id']?>&maisonid=<?= $reserver['maison_id']?>" class="autoriser">Autoriser</a>
                        </div>
                    <?php else:?>
                    <?php endif;?>
                <?php endforeach;?>
            </div>
            <a href="home.php" class="back">Retour</a>
        <?php endif;?>
    </div>
</body>
</html>