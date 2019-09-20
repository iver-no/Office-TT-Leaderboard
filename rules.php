<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    
    header("Content-Type: text/html; charset=utf-8");

    echo "<title>Ivers Tabletennis Leaderboard</title>";

    echo "<style>";
    include $_SERVER['DOCUMENT_ROOT'].'/css/match-history.css';
    echo "</style>";

    $link = mysqli_connect($ip,$username,$password,$database);
    mysqli_set_charset($link, "utf8");
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    include $_SERVER['DOCUMENT_ROOT'].'/sections/header.php';
    echo "<script>";
    include $_SERVER['DOCUMENT_ROOT'].'/js/display-mode.js';
    echo "</script>";
?>

<body id="body" class="light-mode" >

</body>