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

        $maisons = $connect->prepare("SELECT * FROM maisons");
        $maisons->execute();
        $maisons = $maisons->fetchAll();
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
            justify-content: space-around;
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

        .title2{
            margin: 0 auto;
        }

        .btngroup a {
            color: black;
        }

    </style>
</head>
<body>
    <div class="container">
        
        <?php include 'topHome.php';?>
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
                        <a href="reserver.php" class="consulter">Voir</a>
                    </div>
                    
                <?php else:?>

                    <h4 class="title2">En tant qu'invité vous ne pouvez ni réservé, ni publier...</h4>

                <?php endif;?>
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
                            <h4 class="date">publié le <?= date('d/m/Y à H:i:s',strtotime($maison['date'])) ;?></h4>
                            <div class="btngroup">
                                <a href="" class="interesser" id="<?php echo $maison['id']?>">interresser</a>
                                <a href="" class="reserver" id="<?php echo $maison['id']?>">reserver</a>
                            </div>
                        </div>
                    <?php endforeach ;?>
                </div>
            <?php endif ;?>
        </div>
    </div>
</body>
<script>
   
    $(document).on('click','.interesser',function(){
        var thisClick = $(this);
        var maisonid = thisClick.attr('id');
        var userid = <?= $user['id'];?>;

        $.ajax({
            type: "POST",
            url: '../../Post/cli_interest.php',
            data: {userId: userid, maisonId: maisonid},
            success: function(data) {
                alert(data)
            }
        });
    });

    $(document).on('click','.reserver',function(){
        var thisClick = $(this);
        var maisonid = thisClick.attr('id');
        var userid = <?= $user['id'];?>;

        $.ajax({
            type: "POST",
            url: '../../Post/cli_reserver.php',
            data: {userId: userid, maisonId: maisonid},
            success: function(data) {
                alert(data)
            }
        });
    });
</script>
</html>