<?php
    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    

    echo "<style>";
    include $_SERVER['DOCUMENT_ROOT'].'/css/index.css';
    echo "</style>";

    $link = mysqli_connect($ip,$username,$password,"officepingpongELO");
    
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    include $_SERVER['DOCUMENT_ROOT'].'/sections/header.php';
?>

<body id="body" class="light-mode">
    <input type="submit" value="New Game" name="New Game" class="newgameBtn">

    <?php 
        include $_SERVER['DOCUMENT_ROOT'].'/functions/leaderboard.php';
        showLeaderboard();
    ?>
</body>