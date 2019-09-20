<?php
function rebuild(){
    set_time_limit(300);

    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/new-season.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/handle-match_include.php';

    $link = mysqli_connect($ip,$username,$password,$database);

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    mysqli_set_charset($link, "utf8");
    $query = "SELECT player1, player1Score, player2, player2Score, player1Win FROM matchHistory ORDER BY matchId ASC;";

    $matchHistory = mysqli_query($link, $query);

    $seasonName = "NewTestSeason";

    createNewSeason($seasonName);
    while($arr = mysqli_fetch_assoc($matchHistory)) {
        echo $arr["player1Score"] . " VS " . $arr["player2Score"] . " | ". $arr["player1Win"]." <br>";

        

        handleMatch($arr["player1"],$arr["player1Score"],$arr["player2"],$arr["player2Score"],$seasonName);

        
        #$matchHistory = mysqli_query($link, "SELECT * from $seasonName");
        flush();
        ob_flush();
        usleep(500000);
    }
}
#rebuild();
?>