<?php
    session_start();
    require '../../Client/Client.php';
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

        .maisons{
            display: flex;
            align-items: flex-start;
            justify-content: space-around;
            width: 100%;
            flex-wrap: wrap;
            gap: 0.5em;
        }

        .maison{
            display: flex;
            flex-direction: column;
            width: 48%;
            max-width: 500px;
            background-color: white;
            min-height: 400px;
            justify-content: space-evenly;
            align-items: center;
            gap: 1em;
            box-shadow: 1px 0px 5px #eee;
            overflow: auto;
        }

        .image_maison{
            width: 100%;
        }

        .content{
            width: 80%;
            display: flex;
            justify-content: space-between;
            padding: 5px;
        }

        .content h3{
            width: 200px;
            font-size: 1rem;
            font-family: Roboto;
            font-weight: 300;
        }

        .indication{
            min-width: 200px ;
            color: #444;
            text-decoration: underline;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php include 'topHome.php';?>

        <h3>Liste des réservations</h3>

        <div class="maisons">
        <?php if(!empty($reserver)):?>
            
            <?php foreach($reserver as $maison):?>
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
                        <p class="indication">Reservé pour le</p>
                        <h3 class="date"><?= date('d/m/Y',strtotime($maison['date_res'])) ;?> à <?= $maison['heure'];?></h3>
                    </div>

                </div>
            <?php endforeach;?>

        <?php else:?>
            <h3>Si vous avez fait une réservation, veuillez patientez pendant que nous la validons. Merci</h3>
        <?php endif;?>
        </div>
        <a href="home.php" class="back">retour</a>
    </div>
</body>
</html>