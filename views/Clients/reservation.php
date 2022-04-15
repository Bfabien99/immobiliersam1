<?php
session_start();
date_default_timezone_set('UTC');
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

        if(!empty($_GET['maisonid'])){
            $maison = $connect->prepare("SELECT * FROM maisons WHERE id = ".$_GET['maisonid']);
            $maison->execute();
            $maison = $maison->fetch(); 
        }
    }

    $date = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <title>Reservation</title>
    <style>
        body{
            font-size: 1.1rem;
            font-family: Poppins,serif;
            font-weight: 100;
        }

        .container{
            gap: 1em;
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

        form{
            margin: auto;
            display: flex;
            flex-direction: column;
            background-color: white;
            gap: 1em;
            font-size: 1.3rem;
            width: 100%;
            max-width: 500px;
            font-family: Roboto;
            font-weight: 200;
            padding-bottom: 10px;
            
        }

        .group{
            display: flex;
            flex-direction: column;
            gap: 0.5em;
            width: 100%;
            align-items: center;
            padding: 10px;
        }

        .group input{
            width: 100%;
            outline: none;
            border: 1px solid #444;
            border-radius: 2px;
            height: 35px;
            padding: 10px;
        }

        input[type="submit"]{
            width: 100%;
            max-width: 200px;
            margin: 0 auto;
            padding: 7px;
            text-align: center;
            outline: none;
            border: none;
            color: white;
            background-color: #5C8DF9;
            cursor: pointer;
        }

        .title{
            color: white;
            background-color: #444;
            text-align: center;
            padding: 10px;
        }

        .msg{
            color:tomato;
            text-align: center;
            font-weight: 300;
        }

        #times{
            display: flex;
            flex-direction: row;
            width: fit-content;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="container">

        <?php include 'topHome.php';?>

        <a href="home.php" class="back">Retour</a>

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
        </div>
        
        <form action="" method="post" id="form">
            <h1 class="title">Formulaire de reservation</h1>
            <div class="group">
                <label for="nom">nom</label>
                <input type="text" name="nom" id="nom" value="<?= mb_strtoupper($user['nom'])?>" disabled>
            </div>
            <div class="group">
                <label for="prenoms">prenoms</label>
                <input type="text" name="prenoms" id="prenoms" value="<?= mb_strtoupper($user['prenoms'])?>" disabled>
            </div>
            <div class="group">
                <label for="email">email</label>
                <input type="text" name="email" id="email" value="<?= mb_strtoupper($user['email'])?>" disabled>
            </div>
            <div class="group">
                <label for="contact1">contact 1</label>
                <input type="text" name="contact" id="contact" value="<?= mb_strtoupper($user['contact1'])?>" disabled>
            </div>
            <div class="group">
                <label for="contact2">contact 2</label>
                <input type="text" name="contact" id="contact" value="<?= mb_strtoupper($user['contact2'])?>" disabled>
            </div>
            <div class="group">
                <label for="date">Date de reservation</label>
                <input type="date" name="date" id="date" min="<?= date('Y-m-d', strtotime($date.' + 1 days'));?>">
            </div>
            <div class="group" id="times">
                <label for="nom">Heure</label>
                <select name="heure" id="heure">
                    <?php for($i=07;$i<=22;$i++):?>
                        <option value="<?=$i?>"><?=$i?> heure</option>
                    <?php endfor;?>
                </select>
                <select name="minute" id="minute">
                    <?php for($i=0;$i<=55;$i+=5):?>
                        <option value="<?=$i?>"><?=$i?> minute</option>
                    <?php endfor;?>
                </select>
            </div>

            <input type="submit" value="Reserver" name="submit" class=".reserver">
            <div class="msg"></div>
            <a id="<?= $maison['id'];?>"></a>
        </form>
        
        
    </div>
</body>
<script>
    $('#form').on('submit',function(e){
        e.preventDefault();

        var dates = new Date($("#date").val());
        var heure = $("#heure").val();
        var min = $("#minute").val();
        
        var day = dates.getDate();
        var month = dates.getMonth() + 1;
        var year = dates.getFullYear();
        var dattes = [year, month, day].join('/');

        var thisClick = e.target.children[10];
        var maisonid = $(thisClick).attr('id');
        var userid = <?= $user['id'];?>;

        $.ajax({
            type: "POST",
            url: '../../Post/cli_reserver.php',
            data: {userId: userid, maisonId: maisonid, Date: dattes, Heure: heure, Minute: min},
            success: function(data) {
    
                let msg = e.target.children[9];
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