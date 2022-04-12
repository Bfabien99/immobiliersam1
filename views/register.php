<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'link.php';?>
    <title>Inscription</title>
    <style>
    
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post" id="form">
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