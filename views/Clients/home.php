<?php
session_start();
require '../../Client/Client.php';
$connect = new Client();
$connect = $connect->dbConnect();

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

    $maisons = $connect->prepare("SELECT * FROM maisons");
        $maisons->execute();
        $maisons = $maisons->fetchAll();

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
            font-weight: 100;
        }

        .container{
            gap: 1em;
            padding-bottom: 10px;
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
            gap: 1em;
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

        .maisons{
            display: flex;
            align-items: flex-start;
            justify-content: space-around;
            width: 100%;
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

        .btngroup{
            display: flex;
            width: 100%;
            justify-content: space-evenly;
        }

        .btngroup a{
            padding: 5px 7px;
            border-radius: 2px;
            font-weight: 200;
            color: white;
            cursor: pointer;
        }

        .interesser{
            background-color: #333;
        }

        .reserver{
            background-color: #5c8df9;
        }

        .igreen{
            background-color: green;
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
                        <h2>Reservation</h2>
                        <div class="box">
                            <p>Ici se trouve toute vos réservations</p>
                            <img src="../../assets/images/reserver.png" alt="like" class="icon">
                        </div>
                        <a href="reserver.php" class="consulter">Voir</a>
                    </div>
                <?php endif;?>
            </div>

            <?php if(!empty($maisons)):?>
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

                            <?php if(!empty($user)):?>
                            <div class="btngroup">
                                <?php 
                                $Client = new Client;
                                $isExist = $Client->getInteresser($user['id'],$maison['id']);?>
                                <?php if($isExist):?>
                                <a class="interesser igreen" id="<?php echo $maison['id']?>">interresser</a>
                                <?php else:?>
                                <a class="interesser" id="<?php echo $maison['id']?>">interresser</a>
                                <?php endif;?>
                                <a href="reservation.php?maisonid=<?php echo $maison['id']?>" class="reserver">reserver</a>
                            </div>
                            <?php endif ;?>

                            <div class="msg"></div>
                        </div>
                    <?php endforeach ;?>
                </div>
            <?php endif ;?>
        </div>
    </div>
</body>
<script>

    $(document).on('click','.interesser',function(e){
        var thisClick = $(this);
        var maisonid = thisClick.attr('id');
        var userid = <?= $user['id'];?>;

        $.ajax({
            type: "POST",
            url: '../../Post/cli_interest.php',
            data: {userId: userid, maisonId: maisonid},
            success: function(data) {
                let msg = e.target.parentElement.parentElement.lastElementChild;
                $(msg).html(data);
                setTimeout(()=>{
                    $(msg).html("")
                },2000)
            }
        });
    });
</script>
<!-- <script>
    setInterval(()=>{
        window.location.reload();
    },3000)
</script> -->
</html>