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
    <style>
        .section{
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 100%;
        }

        .autoriser{
            text-decoration: none;
            color: white;
            padding: 5px 7px;
            width: 100%;
            max-width: 200px;
            background-color: #5C9DF8;
            text-align: center;
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php include 'topAdmin.php';?>
        <?php if(!empty($reservation)):?>

            <h2>Demande de réservations</h2>
            <div class="section">
                <?php foreach($reservation as $reserver):?>
                    <?php $user = $Admin->getUser($reserver['client_id']);?>
                    <?php if($reserver["active"] == 0):?>
                        <div class="maison">
                            <img src="../../uploads/<?= $reserver['image'];?>" alt="image_reserver" class="image_maison">
                            <div class="content">
                                <p class="indication">description</p>
                                <h3 class="description">
                                <?= $reserver['description'] ;?></h3>
                            </div>
                            
                            <div class="content">
                                <p class="indication">lieu</p>
                                <h3 class="lieu"><?= $reserver['lieu'] ;?></h3>
                            </div>

                            <div class="content">
                                <p class="indication">contact propriétaire</p>
                                <h3 class="contact"><?= $reserver['contact'] ;?></h3>
                            </div>

                            <div class="content">
                            <p class="indication">date de demande</p>
                            <h3 class="date"><?= date('d/m/Y à H:i:s',strtotime($reserver['fait_le'])) ;?></h3>
                            </div>

                            <div class="content">
                            <p class="indication">A reserver pour le</p>
                            <h3 class="date"><?= date('d/m/Y',strtotime($reserver['date_res'])) ;?> à <?= $reserver['heure'];?></h3>
                            </div>

                            <div class="content">
                            <p class="indication">Nom demandeur</p>
                            <h3 class="date"><?= ucwords($user['nom'] . " " . $user['prenoms']);?></h3>
                            </div>
                        
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