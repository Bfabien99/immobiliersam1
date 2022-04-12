<?php
session_start();
    require '../../dconnect.php';
    $connect = $pdo;

    if(!empty($_SESSION['imosam_pseudo'])){
        $isPseudo = $connect->prepare("SELECT * FROM clients WHERE pseudo = :pseudo");
        $isPseudo->execute(array(
            'pseudo' => $_SESSION['imosam_pseudo']
        ));
        $isPseudo = $isPseudo->fetch();
        var_dump($isPseudo);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <title>Accueil</title>
    <style>
        .top{
            background-color: #f1f1f1;
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
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="top">
            <?php if(!empty($isPseudo)):?>
                <h4>Welcome <?=mb_strtoupper($isPseudo['nom']);?></h4> 
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
                <?php if(!empty($isPseudo)):?>
                    
                    <div class="block">
                        <h2>Interesser</h2>
                        <p>Ici se trouve toute les annonces qui vous intéresse</p>
                    </div>

                    <div class="block">
                        <h2>Reservation</h2>
                        <p>Ici se trouve toute vos réservations</p>
                    </div>

                    <div class="block">
                        <h2>Publication</h2>
                        <p>Ici se trouve toute vos publications</p>
                    </div>
                    
                <?php else:?>

                    <h4>En tant qu'invité vous ne pouvez ni réservé, ni publier...</h4>

                <?php endif;?>
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