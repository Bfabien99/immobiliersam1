<?php
require '../../Admin/Admin.php';
$Admin = new Admin();

    if(!empty($_GET['id']) && !empty($_GET['maisonid']))
    {
        $enable = $Admin->activate($_GET['id'],$_GET['maisonid']);

        header('location:reservation.php');
    }
?>