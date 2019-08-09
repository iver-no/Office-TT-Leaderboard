<?php
    function showLeaderboardDiv(){
        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
        include $_SERVER['DOCUMENT_ROOT'].'/functions/win-ratio.php';

        $link = mysqli_connect($ip,$username,$password,"officepingpongELO");

        $query = "SELECT * FROM elo ORDER BY ELO, Wins DESC";
        mysqli_set_charset($link, "utf8");
        $result = mysqli_query($link, $query);
        echo "<div id='leaderboard'>";
        while($arr = mysqli_fetch_array($result)) {
            echo '<div id="' . ucfirst($arr["FirstName"]) . ucfirst($arr["LastName"]) . '-div" class="player">';

            echo "<a id='first-name'>" . ucfirst($arr["FirstName"]) . " </a>";
            echo "<a id='last-name'>" . ucfirst($arr["LastName"]) ." </a>";
            echo "<a id='elo'>" . $arr["ELO"] ." ELO  </a>";
            echo "<a id='wins'>" . $arr["Wins"] ." Wins / </a>";
            echo "<a id='losses'>" . $arr["Losses"] ." Losses </a>";
            echo "<a id='winrate'>" . getWinRatio($arr["Wins"],$arr["Losses"]) ." </a>";
            echo "</div>";
        }
        echo "</div>";
    }

    function showLeaderboard(){
        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
        include $_SERVER['DOCUMENT_ROOT'].'/functions/win-ratio.php';

        $link = mysqli_connect($ip,$username,$password,"officepingpongELO");
        mysqli_set_charset($link, "utf8");
        $query = "SELECT * FROM elo ORDER BY ELO, Wins DESC";

        $result = mysqli_query($link, $query);
        echo "<div id='leaderboard'><table align='center' border=0>";#<tr><th>Name</th><th>ELO</th><th>Wins</th><th>Losses</th><th>WinRatio</th></tr>";
        echo "<tr><td align='center'>Player</td><td align='center'>Rating</td><td align='center' colspan='3'>Stats</td>";
        while($arr = mysqli_fetch_array($result)) {

            echo "<tr><td>" . ucfirst($arr["FirstName"]) . " ";
            echo ucfirst($arr["LastName"]) ."</td>";
            echo "<td>" . $arr["ELO"] ."</td>";
            echo "<td>" . $arr["Wins"] ." W</td>";
            echo "<td>" . $arr["Losses"] ." L</td>";
            echo "<td>" . getWinRatio($arr["Wins"],$arr["Losses"]) ."</td>";
            echo "</tr>";
        }

        echo "</table></div>";
    }
?>