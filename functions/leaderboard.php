<?php
    function showLeaderboard(){
        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
        include $_SERVER['DOCUMENT_ROOT'].'/functions/win-ratio.php';

        $link = mysqli_connect($ip,$username,$password,$database);
        mysqli_set_charset($link, "utf8");
        $query = "SELECT FirstName, LastName, ELO, Wins, Losses FROM elo WHERE Wins >= 1 OR Losses >= 1 ORDER BY ELO DESC, Wins DESC";

        $result = mysqli_query($link, $query);
        echo "<div id='leaderboard'><table align='center' border='0' cellspacing='0'>";#<tr><th>Name</th><th>ELO</th><th>Wins</th><th>Losses</th><th>WinRatio</th></tr>";
        echo "<tr><td align='center'>Player</td><td align='center'>Rating</td><td align='center' colspan='3'>Stats</td></tr>";
        while($arr = mysqli_fetch_array($result)) {
            if($arr["FirstName"] == "Walk" && $arr["LastName"] == "Over"){
                 
            }
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