<?php
#If myGameResult = 1 then you won

    function getRatingDelta($myRating, $opponentRating, $myGameResult, $kfactor){
        $kfac = $kfactor;
        $myChanceToWin = (1 / (1 + pow(10, ($opponentRating - $myRating) / 400)));

        return round($kfac * ($myGameResult - $myChanceToWin));
    }

    function getNewRating($myRating, $opponentRating, $myGameResult, $kfactor) {
        return $myRating + getRatingDelta($myRating, $opponentRating, $myGameResult, $kfactor);
    }

?>