<?php
    function getWinRatio($wins, $losses) {
        if ($wins == 0 && $losses == 0) {
            return "-";
        }

        if($wins == 0) {
            return "0%";
        }
        if($losses == 0) {
            return "100%";
        }

        $totalGames = $wins + $losses;
        $winrato = $wins / $totalGames;
        $winPercentage = $winrato * 100;
        return round($winPercentage, 1) . "%";
    }
?>