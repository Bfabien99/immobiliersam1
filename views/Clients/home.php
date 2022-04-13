<?php
session_start();
    require '../../dconnect.php';
    $connect = $pdo;

    //Identification du client par son pseudo en session
    if(!empty($_SESSION['imosam_pseudo']))
    {
        $user = $connect->prepare("SELECT * FROM clients WHERE pseudo = :pseudo");
        $user->execute(array(
            'pseudo' => $_SESSION['imosam_pseudo']
        ));
        $user = $user->fetch();
    }

    //Si le client n'existe pas, vérifie si c'est l'Admin qui se connecte
    elseif(!empty($_SESSION['imosam_Apseudo']) && !empty($_SESSION['imosam_Aemail'])) 
    {
        $admin = $connect->prepare("SELECT * FROM admin WHERE nom = :nom AND email = :email");
        $admin->execute(array(
            'nom' => $_SESSION['imosam_Apseudo'],
            'email' => $_SESSION['imosam_Aemail']
        ));
        $admin = $admin->fetch();

        if ($admin) 
        {
            header('location: ../Admin/home.php');
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <title>Accueil</title>
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

        .top{
            background-color: #5c8df9;
            width: 100%;
            padding: 10px 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section{
            width: 100%;
            padding: 10px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .first{
            display: flex;
            width: 90%;
            max-width: 800px;
            justify-content: space-between;
            align-items: center;
            gap: 1em;
        }

        .block{
            padding: 15px;
            box-shadow: 0px 0px 5px #d3d3d3;
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            gap: 1em;
            transition: all 0.1s;
            background-color: white;
        }

        .block:hover{
            background-color: #5c8df9;
            color: white;
        }

        .block:hover a{
            border: 1px solid white;
        }

        .block .box{
            display: flex;
            width: 250px;
        }

        .box .icon{
            width: 50px;
            height: 50px;
        }

        .consulter{
            background-color: #5c8df9;
            border-radius: 5px;
            padding: 10px;
            width: 80%;
            max-width: 90px;
        }

        

    </style>
</head>
<body>
    <div class="container">
        <div class="top">
            <?php if(!empty($user)):?>
                <h4>Welcome <?=mb_strtoupper($user['nom']);?></h4> 
                <a href="logout.php" class="logout">Déconnecter</a>
            <?php else:?>
                <h4>Welcome Invité</h4>
                <div class="buttongroup">
                    <a href="../../index.php" class="logout">Retour</a>
                    <a href="login.php" class="next">Se connecter</a>
                </div>
            <?php endif;?>
        </div>

        <div class="section">
            <div class="first">
                <?php if(!empty($user)):?>
                    
                    <div class="block block1">
                        <h2>Interesser</h2>
                        <div class="box">
                            <p>Ici se trouve ce qui vous intéresse</p>
                            <img src="../../assets/images/aimer.png" alt="like" class="icon">
                        </div>
                        
                        <a href="" class="consulter">Voir</a>
                    </div>

                    <div class="block block2">
                        <h2>Reservation</h2>
                        <div class="box">
                            <p>Ici se trouve toute vos réservations</p>
                            <img src="../../assets/images/reserver.png" alt="like" class="icon">
                        </div>
                        <a href="" class="consulter">Voir</a>
                    </div>

                    <div class="block block3">
                        <h2>Publication</h2>
                        <div class="box">
                            <p>Ici se trouve toute vos publications</p>
                            <img src="../../assets/images/partager.png" alt="like" class="icon">
                        </div>
                        <a href="" class="consulter">Voir</a>
                    </div>
                    
                <?php else:?>

                    <h4>En tant qu'invité vous ne pouvez ni réservé, ni publier...</h4>

                <?php endif;?>
            </div>

            <div id="maisons">
                
            </div>
        </div>
    </div>
</body>
<script>
    setInterval(function(){
        window.location.reload();
    },2000)
</script>
</html>