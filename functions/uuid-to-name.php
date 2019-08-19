<?php

    if(!isset($_GET["uuid"])){
        return;
    }

    $uuid = strval($_GET["uuid"]);

    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

    $link = mysqli_connect($ip,$username,$password,$database);

    

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link, "utf8");

    $query = "SELECT FirstName, LastName, Nickname FROM elo WHERE UUID = LOWER('" . $uuid . "')";

    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result)) {
        if(isset($_GET["nick"])){
            if($row["Nickname"] == NULL) {
                echo $row["FirstName"] . " " . $row["LastName"];
                return;
            } else {
                echo $row["Nickname"];
                return;
            }
        } else {
            echo $row["FirstName"] . " " . $row["LastName"];
            return;
        }
    }

    if (mysqli_num_rows($result)==0) {
        echo "User not found";
        return;
    }

    function uuidToName($uuid){
        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

        $link = mysqli_connect($ip,$username,$password,$database);
    
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    
        mysqli_set_charset($link, "utf8");
    
        $query = "SELECT FirstName, LastName, Nickname FROM elo WHERE UUID = LOWER('" . $uuid . "')";
    
        $result = mysqli_query($link, $query);
    
        while($row = mysqli_fetch_array($result)) {
            if(isset($_GET["nick"])){
                if($row["Nickname"] == NULL) {
                    echo ucfirst($row["FirstName"]) . " " . ucfirst($row["LastName"]);
                    return;
                } else {
                    echo $row["Nickname"];
                    return;
                }
            } else {
                echo ucfirst($row["FirstName"]) . " " . ucfirst($row["LastName"]);
                return;
            }
        }
    
        if (mysqli_num_rows($result)==0) {
            echo "User not found";
            return;
        }
    }

    function returnUuidToName($uuid){
        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

        $link = mysqli_connect($ip,$username,$password,$database);
    
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
    
        mysqli_set_charset($link, "utf8");
    
        $query = "SELECT FirstName, LastName FROM elo WHERE UUID = LOWER('" . $uuid . "')";
    
        $result = mysqli_query($link, $query);
    
        while($row = mysqli_fetch_array($result)) {
            return ucfirst($row["FirstName"]) . " " . ucfirst($row["LastName"]);
            
        }
    
        if (mysqli_num_rows($result)==0) {
            return "User not found";
            
        }
    }
?>