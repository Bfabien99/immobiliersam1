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
</head>
<body>
    <div class="container">
        <?php if(!empty($admin)):?>

            <div class="top">
                <div class="topleft">
                    <img src="../../assets/images/admin.png" alt="icon_Admin" class="icon">
                    <h4>Administrateur <?= $admin['nom']." ".$admin['prenoms'];?></h4>
                </div>

                <a href="" class="parametre">Déconnexion</a>
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