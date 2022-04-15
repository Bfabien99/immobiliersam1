<?php
    session_start();
    require '../../Client/Client.php';
    require '../../dconnect.php';
    $connect = new Client();
    $connect = $connect->dbConnect();

    if(!empty($_SESSION['imosam_pseudo']))
    {
        $user = $connect->prepare("SELECT * FROM clients WHERE pseudo = :pseudo");
        $user->execute(array(
            'pseudo' => $_SESSION['imosam_pseudo']
        ));
        $user = $user->fetch();

        $Client = new Client();

        $reserver = $Client->getActiveReserver($user['id']);
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <title>Document</title>
    <style>
        body{
            font-size: 1.1rem;
            font-family: Poppins,serif;
        }

        a{
            text-decoration: none;
            color: white;
            text-align: center;
        }

        .container{
            justify-content: space-between;
            background-color:red;
        }

        .top{
            background-color: #333;
            width: 100%;
            padding: 10px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .top #title{
            display: flex;
            align-items: center;
            gap: 0.5em;
        }

        .top .icon{
            width: 60px;
        }

        .top a{
            background-color: #444;
            padding: 5px;
            border-radius: 5px;
        }

        .top .next{
            background-color: #5c8df9;
        }

        .Uicon{
            border-radius: 50%;
            filter: drop-shadow(5px 1px 5px #000);
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include 'topHome.php';?>

        <h3>Liste des réservations</h3>

        <div class="section">
        <?php if(!empty($reserver)):?>
            
            <?php foreach($reserver as $maison):?>
                <div class="reserver">
                        <img src="../../uploads/<?= $maison["image"];?>" alt="image_maison" width="200px">
                        <h3>
                            <em>Description: <?= $maison["description"];?></em>
                        </h3>
                        <h3>
                            <em>Lieu: <?= $maison["lieu"];?></em>
                        </h3>
                        <h3>
                            <em>Contact Proprio: <?= $maison["contact"];?></em>
                        </h3>
                        <h3>
                            <em>Date Reservation: <?= $maison["fait_le"];?></em>
                        </h3>
                        
                    </div>
            <?php endforeach;?>
            
        <?php endif;?>
        </div>
        <a href="home.php" class="back">retour</a>
    </div>
</body>
</html>