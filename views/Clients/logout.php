<?php
    session_start();

    unset($_SESSION['imosam_pseudo']);
    session_destroy();
    header('Location: home.php');