<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    
    header("Content-Type: text/html; charset=utf-8");

    echo "<title>Ivers Tabletennis Leaderboard</title>";

    echo "<style>";
        include $_SERVER['DOCUMENT_ROOT'].'/css/game.css';
    echo "</style>";



    $link = mysqli_connect($ip,$username,$password,$database);
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    include $_SERVER['DOCUMENT_ROOT'].'/sections/header.php';

    echo "<script>";
        include $_SERVER['DOCUMENT_ROOT'].'/js/game-controller.js';
    echo "</script>";
?>

<body id="body" class="light-mode" onload="addListeners()">
    <?php
    #Echo UUID inputters
    echo '
        <a class="form-text" id="player1text">
        Player 1</a>
        <input type="text" id="player1" name="player1" autofocus>
        <a id=player1name></a>
        <a id=player1Kvalue></a>
        <a id=vs>VS</a>
        <a class="form-text" id="player2text">
        Player 2</a>
        <input type="text" id="player2" name="player2">
        <a id=player2name></a>
        <a id=player2Kvalue></a>
        <br>';
    
    # Echo Scorecounters
    echo '
        <div id="player1score" class="scoreholder">
            <input type="button" id="plus" value="+" onclick="scoreAdd(1)">
            <a id="scorep1">0</a>
            <input type="button" id="minus" value="-" onclick="scoreMinus(1)">
        </div>
        <div id="player2score" class="scoreholder">
            <input type="button" id="plus" value="+" onclick="scoreAdd(2)">
            <a id="scorep2">0</a>
            <input type="button" id="minus" value="-" onclick="scoreMinus(2)">
        </div>
        ';
    #Echo gameOver button
    echo '<input type="button" id="gameOverBtn" value="Game Over?" onclick="gameSubmit()">';
    #div for feedback
    echo '<h1 id="gameOverInfo"></h1>';
    ?>

    <form action="/game.php" method="post">
        <input type="submit" value="New Game" name="New Game" class="newgameBtn" id="newgameBtn">
    </form>
    
</body>