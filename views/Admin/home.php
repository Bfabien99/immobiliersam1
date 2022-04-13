<?php
    session_start();
    require '../../dconnect.php';
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <title>Admin</title>
    <style>
        .container{
            font-size: 1.2rem;
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        .top{
            display: flex;
            align-items: center;
            justify-content: space-evenly;
            width: 100%;
            background-color: #5c8df9;
            padding: 5px;
        }

        .top .logout{
            text-decoration: none;
            color: white;
            background-color: #5c7ac3;
            padding: 10px;
            border-radius: 40px;
        }

        .topleft{
            display: flex;
            align-items: center;
            gap: 0.2rem;
            border: 1px solid white;
            border-radius: 40px;
            padding-right: 10px;
            background-color: white;
            color: #aaa;
        }

        .topleft .icon{
            width: 45px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid white;
        }

        .topleft em{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if(!empty($admin)):?>

            <div class="top">
                <div class="topleft">
                    <img src="../../assets/images/admin.png" alt="icon_Admin" class="icon">
                    <h4>Administrateur <em><?= $admin['nom']." ".$admin['prenoms'];?></em>&nbsp; Email: <em><?= $admin['email'];?></em></h4>
                </div>

                <a href="../Clients/logout.php" class="logout">Déconnexion</a>
            </div>

        <?php else:?>
            <?php header('location: ../../error.php');?>
        <?php endif;?>
    </div>
</body>
<script>
    setInterval(function(){
        window.location.reload();
    },2000)
</script>
</html>