<?php
    require '../Client/Client.php';
    $Client = new Client();

    if(!empty($_POST['userId']) && !empty($_POST['maisonId']) && !empty($_POST['Date']) && !empty($_POST['Heure']) && isset($_POST['Minute'])){
        $date = date_parse($_POST['Date']);
        $heure = $_POST['Heure']." heure ".$_POST['Minute']." minute";
        if (checkdate($date['month'], $date['day'], $date['year'])) 
        {
            $isExist = $Client->getReserver($_POST['userId'],$_POST['maisonId']);
            if(!$isExist){
                $reserve = $Client->reserver($_POST['userId'],$_POST['maisonId'],date('Y-m-d',strtotime($_POST['Date'])),$heure);
                if($reserve){
                    echo "Demande de réservation envoyé...";
                }
                else {
                    echo "Erreur... Impossible d'ajouter";
                }
            }
            else{
                echo "Déja réservé";
            }

        }
        else{
            echo "Veuillez entrer la date";
        }
        
        
    }
    
    else{
        echo "Veuillez entrer la date et l'heure";
    }
?>