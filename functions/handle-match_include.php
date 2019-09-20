<?php

function handleMatch($p1uuid,$p1score,$p2uuid,$p2score,$season){

    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/functions/calculate-elo-change.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/functions/uuid-to-name.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/functions/who-won.php';

    $link = mysqli_connect($ip,$username,$password,$database);

    $p1uuid = strtolower($p1uuid);
    $p1score = strtolower($p1score);

    $p2uuid = strtolower($p2uuid);
    $p2score = strtolower($p2score);

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link, "utf8");

    #Figure out who won
    $gameResult = player1win($p1uuid,$p1score,$p2uuid,$p2score);
    if($gameResult == "Draw?" || $gameResult == "dafuq") {
        echo "Error while submitting game";
        return false;
    }

    if($p1uuid == $p2uuid){
        echo "You cant play against yourself!";
        return false;
    }

    #calc-elo-change based on who won , do it 2 times, then update SQL
    #Update Player1Elo 
    $p1getelo = "SELECT ELO, Kfactor FROM $season WHERE UUID = '" . $p1uuid . "'";
    $p2getelo = "SELECT ELO, Kfactor FROM $season WHERE UUID = '" . $p2uuid . "'";

    $resultp1getelo = mysqli_query($link, $p1getelo);
    $resultp2getelo = mysqli_query($link, $p2getelo);

    $rowp1elo = mysqli_fetch_array($resultp1getelo);
    $rowp2elo = mysqli_fetch_array($resultp2getelo);

    $p1newelo = "";
    $p2getelo = "";

    #Player1 lost
    if($gameResult == "0") {
        $p1newelo = getNewRating($rowp1elo["ELO"],$rowp2elo["ELO"], 0, $rowp1elo["Kfactor"]);
        $p2newelo = getNewRating($rowp2elo["ELO"],$rowp1elo["ELO"], 1, $rowp2elo["Kfactor"]);
        echo uuidToName($p2uuid). " wins! <br>";

        $p1newelo = $p1newelo / 2;

        $p1update_query = "UPDATE $season SET ELO = $p1newelo, Losses = Losses + 1 WHERE UUID = '$p1uuid'"; 
        $p2update_query = "UPDATE $season SET ELO = $p2newelo, Wins = Wins + 1 WHERE UUID = '$p2uuid'"; 

        $resultp1newelo = mysqli_query($link, $p1update_query);
        $resultp2newelo = mysqli_query($link, $p2update_query);

        #echo "Player 1 lost " . $p1newelo . "<br> $p1update_query";
    } 
    #Player 1 Won
    elseif($gameResult == "1") {

        $p2newelo = $p2newelo / 2;

        $p1newelo = getNewRating($rowp1elo["ELO"],$rowp2elo["ELO"], 1, $rowp1elo["Kfactor"]);
        $p2newelo = getNewRating($rowp2elo["ELO"],$rowp1elo["ELO"], 0, $rowp2elo["Kfactor"]);

        $p1update_query = "UPDATE $season SET ELO = $p1newelo, Wins = Wins + 1 WHERE UUID = '$p1uuid'"; 
        $p2update_query = "UPDATE $season SET ELO = $p2newelo, Losses = Losses + 1 WHERE UUID = '$p2uuid'"; 

        echo uuidToName($p1uuid)." wins! <br>";

        $resultp1newelo = mysqli_query($link, $p1update_query);
        $resultp2newelo = mysqli_query($link, $p2update_query);
        #echo "Player 1 won <br>";
    }

    return true;
}
?>