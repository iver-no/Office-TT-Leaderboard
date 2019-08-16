<?php
    function showMatchHistory(){
        include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
        include $_SERVER['DOCUMENT_ROOT'].'/functions/uuid-to-name.php';
        $link = mysqli_connect($ip,$username,$password,$database);

        $query = "SELECT player1, player1Score, player2, player2Score, player1Win FROM matchHistory ORDER BY matchId DESC LIMIT 20";

        $result = mysqli_query($link, $query);
        echo "<div id='match-history'><table align='center' border='0' cellspacing='0'>";
        echo "<tr></tr>";

        while($arr = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td align='left'>" . returnUuidToName($arr["player1"]) . "</td>";
            echo "<td>" . $arr["player1Score"] . "</td>";
            echo "<td> VS </td>"; 
            echo "<td>" . $arr["player2Score"] . "</td>";
            echo "<td align='right'>" . returnUuidToName($arr["player2"]) . "</td>";
            echo "</tr>";
        }

        echo "</table></div>";
    }
?>