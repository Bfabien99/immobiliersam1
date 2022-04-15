<?php
    require '../../Admin/Admin.php';
    $Admin = new Admin();

    if(!empty($_GET['maisonid'])){
        $maison = $Admin->delete($_GET['maisonid']);
        header('Location:home.php');
    }
?>