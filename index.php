<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'views/link.php';?>
    <title>Welcome</title>
    <style>
        .container{
            justify-content: space-between;
        }

        #block{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1em;
            margin: 0 auto;
        }

        .block1,.block2{
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top">
            <h3>Bienvenue sur E-immobilier</h3>
            <a href="views/register.php" class="signup">S'inscrire</a>
        </div>
        <section>
            <div id="block">
                <div class="block1">
                    <img src="" alt="client" class="imgmembre">
                    <h2>Espace Membre</h2>
                    <h4>Connectez-vous pour accéder à votre espace.</h4>
                    <a href="views/Clients/login.php" class="next">Continuer</a>
                </div>
                <div class="block2">
                    <img src="" alt="invité" class="imgmembre">
                    <h2>Espace invité</h2>
                    <h4>Accédez à la plateforme en mode invité.</h4>
                    <a href="views/Clients/home.php" class="next">Continuer</a>
                </div>
            </div>
        </section>
    </div>
    <footer>
        <p>E-Immobilier</p>
    </footer>
</body>
</html>