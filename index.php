<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'views/link.php';?>
    <title>Welcome</title>
    <style>
        .container{
            justify-content: space-between;
            font-family: 'Montserrat Alternates';
        }

        .top{
            width: 100%;
            display: flex;
            justify-content: space-evenly;
            padding: 10px;
            align-items: center;
            background-color: #333;
            color: white;
        }

        .top h3{
            min-width: 50%;
            text-align: center;
            text-transform: uppercase;
            font-size: 2rem;
            font-family: 'Grape Nuts',serif;
        }

        .icon{
            width: 90px;
            border-radius: 50%;
            filter: drop-shadow(1px 1px 5px black);
        }

        .signup{
            text-decoration: none;
            color: white;
            background-color: #5c8df9;
            padding: 10px;
            border-radius: 5px;
        }

        #block{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1em;
            margin: 0 auto;
        }

        .imgmembre{
            width: 90px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .block1,.block2{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            border-radius: 2px;
            background-color: #333;
            color: white;
            gap: 1em;
            font-family: 'Montserrat Alternates';
        }

        .block1 h2, .block2 h2{
            font-style: italic;
            text-decoration: underline;
        }

        .block1{
            background-color: #5c8df9;  
        }


        .next{
            background-color: #4f4789;
            padding: 10px;
            border-radius: 2px;
            color: white;
            text-align: center;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="top">
            <img src="assets/images/logo.png" alt="" class="icon">
            <h3>Bienvenue sur E-immobilier</h3>
            <a href="views/register.php" class="signup">S'inscrire</a>
        </div>
        <section>
            <div id="block">
                <div class="block1">
                    <img src="assets/images/user.png" alt="client" class="imgmembre">
                    <h2>Espace Membre</h2>
                    <h4>Connectez-vous pour accéder à votre espace.</h4>
                    <a href="views/Clients/login.php" class="next">Continuer</a>
                </div>
                <div class="block2">
                    <img src="assets/images/invite.png" alt="invité" class="imgmembre">
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