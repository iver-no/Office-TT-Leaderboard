<?php
    function createNewSeason($seasonName){
        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

        $link = mysqli_connect($ip,$username,$password,$database);

        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        mysqli_set_charset($link, "utf8");
        $query = "set SQL_SAFE_UPDATES = 0; drop table if exists $seasonName; create table $seasonName like elo; insert into $seasonName select * from elo; SET SQL_SAFE_UPDATES  = 0; UPDATE $seasonName SET elo = 1000, wins = 0, losses = 0;";
        $cloneTable = mysqli_query($link, $query);

        echo $query . "<br>";
    }
?>