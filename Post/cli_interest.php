<?php
    require '../Client/Client.php';
    $Client = new Client();

    if(!empty($_POST['userId']) && !empty($_POST['maisonId'])){
        $isExist = $Client->getInteresser($_POST['userId'],$_POST['maisonId']);
        if(!$isExist){
            $interest = $Client->interesser($_POST['userId'],$_POST['maisonId']);
            if($interest){
                echo "Ajouté";
            }
            else {
                echo "Erreur... Impossible d'ajouter";
            }
        }
        else{
            echo "Déja ajouter à la liste interesser";
        }
        
    }
?>