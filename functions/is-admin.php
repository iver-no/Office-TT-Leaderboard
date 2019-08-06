<?php
    function isAdmin($input) {
        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
        $link = mysqli_connect($ip,$username,$password,"officepingpongELO");
        
        $query = "SELECT isAdmin from elo WHERE UUID = LOWER('$input')";

        $result = mysqli_query($link, $query);

        #echo $query;

        #print_r($result);
        if (mysqli_num_rows($result)==0) {
            return false;
        } else if (mysqli_num_rows($result)==1) {
            return true;
        }
        
    }
?>
