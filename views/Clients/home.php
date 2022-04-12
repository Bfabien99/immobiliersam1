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
</head>
<body>
    <div class="container">
        <div class="top">
            <?php if(!empty($isPseudo)):?>
                <h4>Welcome <?=mb_strtoupper($isPseudo['nom']);?></h4> 
                <a href="logout.php" class="logout">Déconnecter</a>
            <?php else:?>
                <h4>Welcome Invité</h4> 
                <a href="../../index.php" class="logout">Retour</a>
            <?php endif;?>
        </div>

        <div class="section">
            
        </div>
    </div>
</body>
</html>