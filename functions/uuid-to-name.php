<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';

    $link = mysqli_connect($ip,$username,$password,"officepingpongELO");

    $uuid = strval($_GET["uuid"]);

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link, "utf8");

    $query = "SELECT FirstName, LastName FROM elo WHERE UUID = '" . $uuid . "'";

    $result = mysqli_query($link, $query);

    while($row = mysqli_fetch_array($result)) {
        echo $row["FirstName"] . " " . $row["LastName"];
        return;
    }

    if (mysqli_num_rows($result)==0) {
        echo "User not found";
        return;
    }


?>