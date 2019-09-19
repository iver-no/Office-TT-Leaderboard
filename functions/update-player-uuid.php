<?php 
# iver.fun/functions/update-player-uuid.php
    function updateUUID($olduuid, $newuuid){

        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
        
        $link = mysqli_connect($ip,$username,$password,"officepingpongelo");

        $query = "UPDATE elo SET UUID = '$newuuid' WHERE UUID = '$olduuid';";
        $query2 = "UPDATE matchHistory SET player1 = '$newuuid' WHERE player1 = '$olduuid';";
        $query3 = "UPDATE matchHistory SET player2 = '$newuuid' WHERE player2 = '$olduuid';";
        $result = mysqli_query($link, $query);
        $result2 = mysqli_query($link, $query2);
        $result3 = mysqli_query($link, $query3);

        return;

    }

    updateUUID("a2a02b0e","e20a790e");
?>