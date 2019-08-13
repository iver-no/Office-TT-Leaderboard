<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    
    header("Content-Type: text/html; charset=utf-8");

    echo "<title>Ivers Tabletennis Leaderboard</title>";

    echo "<style>";
    include $_SERVER['DOCUMENT_ROOT'].'/css/index.css';
    echo "</style>";

    $link = mysqli_connect($ip,$username,$password,$database);
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    include $_SERVER['DOCUMENT_ROOT'].'/sections/header.php';
?>

<body id="body" class="light-mode">
    <form action="/game.php" method="post">
        <input type="submit" value="New Game" name="New Game" class="newgameBtn">
    </form>

    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/functions/leaderboard.php';
        showLeaderboard();
    ?>

    
</body>