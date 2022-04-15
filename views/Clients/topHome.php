<div class="top">
    <?php if(!empty($user)):?>
        <h4 id="title"><img src="../../assets/images/logo.png" alt="" class="icon Uicon"> Welcome <?=mb_strtoupper($user['nom']);?></h4> 
        <a href="logout.php" class="logout">Déconnecter</a>
    <?php else:?>
        <h4 id="title"><img src="../../assets/images/logo.png" alt="" class="icon">Welcome Invité</h4>
        <div class="buttongroup">
            <a href="../../index.php" class="logout">Retour</a>
            <a href="login.php" class="next">Se connecter</a>
        </div>
    <?php endif;?>
</div>