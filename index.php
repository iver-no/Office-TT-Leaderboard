<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

    $link = mysqli_connect($ip,$username,$password,"officepingpongELO");
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    include $_SERVER['DOCUMENT_ROOT'].'/sections/header.php';
?>