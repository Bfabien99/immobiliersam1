<?php
    require '../Client/Client.php';
    $Client = new Client();

    if(!empty($_POST['userId']) && !empty($_POST['maisonId'])){
        $isExist = $Client->getReserver($_POST['userId'],$_POST['maisonId']);
        if(!$isExist){
            $reserve = $Client->reserver($_POST['userId'],$_POST['maisonId']);
            if($reserve){
                echo "Ajouté";
            }
            else {
                echo "Erreur... Impossible d'ajouter";
            }
        }
        else{
            echo "Déja reservé";
        }
        
    }
?>