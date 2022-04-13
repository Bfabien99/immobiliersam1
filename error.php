<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 0 - (</title>
</head>
<style>
    *{
        margin:0;
        padding: 0;
        box-sizing: border-box;
    }
    body{
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: tomato;
        color: white;
        width: 100%;
        flex-wrap: wrap;
        gap: 1em;
        padding: 10px;
    }

    .error{
        font-size: 1.2rem;
        min-width: 300px;
        padding: 5px;
        border: 1px solid white;
        border-radius: 5px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .error:hover{
        color: tomato;
        background-color: white;
    }

    .fun{
        background-color: green;
        font-weight: 700;
        width: 100%;
        padding: 10px;
        text-align: center;
    }
</style>
<body>
    <?php
    $r = rand(0,1000);
    $i = 0;
        while($i < $r){
            echo "<p class='error'>Error 404. Page not Found</p>";
            $i++;
        }

        echo "<p class='fun'>".$i." Error 404. 0-) </p>";
    ?>
</body>
</html>