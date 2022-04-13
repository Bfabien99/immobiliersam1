<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'link.php';?>
    <title>Inscription</title>
    <style>
        .container{
            height: 100vh;
            font-family: 'Montserrat Alternates';
        }

        form{
            margin: auto;
            width: 100%;
            max-width: 500px;
            border-radius: 5px 14px;
            display: flex;
            flex-direction: column;
            gap: 1em;
            background-color: white;
            align-items: center;
        }

        .title{
            display: flex;
            flex-direction: column;
            padding: 5px;
            align-items: center;
            color: white;
            background-color: #333;
            width: 100%;
            border-radius: 5px 5px 0px 0px;
        }

        .icon{
            width: 50px;
            border-radius: 50%;
            border: 1px solid white;
        }

        .group,.buttongroup{
            display: flex;
            width: 100%;
            padding: 20px;
        }

        .group{
            flex-direction: column;
            gap: 0.5em;
            color: #333;
            font-size: 1.1rem;
        }

        .group input{
            padding: 10px;
            border-radius: 2px;
            outline: none;
            border: 1px solid #333;
            height: 35px;
        }

        .buttongroup{
            justify-content: space-around;
            align-items: center;
            font-size: 1.1rem;
        }

        .buttongroup *{
            min-width: 100px;
            padding: 10px;
            border: none;
            outline: none;
            transition: all 0.1s;
            cursor: pointer;
        }

        .buttongroup input{
            background-color: red;
            color: white;
            border-radius: 2px;
            font-family: 'Montserrat Alternates';
            font-size: 1.2rem;
        }

        .buttongroup a{
            text-decoration: none;
            color: white;
            background-color: #333;
            border-radius: 2px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post" id="form">

        <h1 class="title"><img src="../assets/images/logo.png" alt="" class="icon">S'INSCRIRE</h1>

            <div class="group">
                <label for="">Nom</label>
                <input type="tel" name="nom" id="nom">
            </div>

            <div class="group">
                <label for="">Prenoms</label>
                <input type="text" name="prenoms" id="prenoms">
            </div>

            <div class="group">
                <label for="">Nom d'utilisateur</label>
                <input type="text" name="pseudo" id="pseudo">
            </div>

            <div class="group">
                <label for="">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="group">
                <label for="">Contact 1</label>
                <input type="tel" name="number1" id="number1">
            </div>

            <div class="group">
                <label for="">Contact 2</label>
                <input type="tel" name="number2" id="number2">
            </div>

            <div class="group">
                <label for="">Mot de passe</label>
                <input type="password" name="password" id="password">
            </div>
            <div id="msg"></div>
            <div class="buttongroup">
                <input type="submit" value="s'inscrire">
                <a href="../index.php" class="button">Retour</a>
            </div>
            
        </form>
    </div>
</body>
<script>
    $(document).ready(function(){

        $('#form').on('submit',function(e){
            e.preventDefault();
            var nom = $('#nom').val();
            var prenoms = $('#prenoms').val();
            var pseudo = $('#pseudo').val();
            var email = $('#email').val();
            var contact1 = $('#number1').val();
            var contact2 = $('#number2').val();
            var password = $('#password').val();

            $.ajax({
                url: '../Post/cli_register.php',
                type: 'POST',
                data: {nom: nom, prenoms: prenoms, pseudo: pseudo, email: email, contact1: contact1, contact2: contact2, password: password},
                success: function(data)
                {
                    $('#msg').html(data);
                }
            });

        });

    });
</script>
</html>