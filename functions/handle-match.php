<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/calculate-elo-change.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/uuid-to-name.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/who-won.php';

    $link = mysqli_connect($ip,$username,$password,"officepingpongELO");

    $p1uuid = strtolower(strval($_GET["p1uuid"]));
    $p1score = strval($_GET["p1score"]);

    $p2uuid = strtolower(strval($_GET["p2uuid"]));
    $p2score = strval($_GET["p2score"]);

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
    $p1getelo = "SELECT ELO FROM elo WHERE UUID = '" . $p1uuid . "'";
    $p2getelo = "SELECT ELO FROM elo WHERE UUID = '" . $p2uuid . "'";

    $resultp1getelo = mysqli_query($link, $p1getelo);
    $resultp2getelo = mysqli_query($link, $p2getelo);

    $rowp1elo = mysqli_fetch_array($resultp1getelo);
    $rowp2elo = mysqli_fetch_array($resultp2getelo);

    $p1newelo = "";
    $p2getelo = "";

    #Player1 lost
    if($gameResult == "0") {
        $p1newelo = getNewRating($rowp1elo["ELO"],$rowp2elo["ELO"], 0);
        $p2newelo = getNewRating($rowp2elo["ELO"],$rowp1elo["ELO"], 1);
        echo uuidToName($p2uuid). " wins! <br>";
        $p1update_query = "UPDATE ELO SET ELO = $p1newelo, Losses = Losses + 1 WHERE UUID = '$p1uuid'"; 
        $p2update_query = "UPDATE ELO SET ELO = $p2newelo, Wins = Wins + 1 WHERE UUID = '$p2uuid'"; 

        $resultp1newelo = mysqli_query($link, $p1update_query);
        $resultp2newelo = mysqli_query($link, $p2update_query);

        #echo "Player 1 lost " . $p1newelo . "<br> $p1update_query";
    } 
    #Player 1 Won
    elseif($gameResult == "1") {
        $p1newelo = getNewRating($rowp1elo["ELO"],$rowp2elo["ELO"], 1);
        $p2newelo = getNewRating($rowp2elo["ELO"],$rowp1elo["ELO"], 0);

        $p1update_query = "UPDATE ELO SET ELO = $p1newelo, Wins = Wins + 1 WHERE UUID = '$p1uuid'"; 
        $p2update_query = "UPDATE ELO SET ELO = $p2newelo, Losses = Losses + 1 WHERE UUID = '$p2uuid'"; 

        echo uuidToName($p1uuid)." wins! <br>";

        $resultp1newelo = mysqli_query($link, $p1update_query);
        $resultp2newelo = mysqli_query($link, $p2update_query);
        #echo "Player 1 won <br>";
    }

    #echo $p1newelo . " | " . $p2newelo;

    
    #update match History
    $mhquery = "INSERT INTO matchHistory VALUES ('$p1uuid',$p1score,'$p2uuid',$p2score,$gameResult, NULL);";
    $mhResult = mysqli_query($link, $mhquery);
    #echo $mhquery;
    echo "Thanks for playing!";
    return true;
?>