<?php
#If myGameResult = 1 then you won

    function getRatingDelta($myRating, $opponentRating, $myGameResult){
        $kfac = 20;
        $myChanceToWin = (1 / (1 + pow(10, ($opponentRating - $myRating) / 400)));

        return round($kfac * ($myGameResult - $myChanceToWin));
    }

    function getNewRating($myRating, $opponentRating, $myGameResult) {
        return $myRating + getRatingDelta($myRating, $opponentRating, $myGameResult);
    }

    #echo getNewRating(990,1010,0);
?>