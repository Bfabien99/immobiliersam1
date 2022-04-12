<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../link.php';?>
    <title>Login</title>
</head>
<body>
    <div class="container">

        <form action="" method="post" id="form">

            <div class="group">
                <label for="">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" maxlength="100">
            </div>

            <div class="group">
                <label for="">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div id="msg"></div>

            <div class="buttongroup">
                <input type="submit" value="connexion">
                <a href="../../index.php" class="button">Retour</a>
            </div>
            
        </form>

    </div>
</body>
<script>
    $(document).ready(function(){
        
        $("#form").submit(function(e){

            e.preventDefault();
            var pseudo = $("#pseudo").val();
            var password = $("#password").val();

            $.ajax({
                url: "../../Post/cli_login.php",
                method: "POST",
                data: {pseudo: pseudo, password: password},
                success: function(data){
                    console.log(data);
                    if(data == "ok")
                    {
                        window.location.href = "home.php";
                    }
                    else
                    {
                        $('#msg').html(data);
                    }
                }
            })

        })

    })
</script>
</html>