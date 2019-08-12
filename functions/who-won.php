<?php
#whos next!
function player1win($player1uuid, $player1score, $player2uuid, $player2score){
    if($player1score == $player2score) {
        return "Draw?";
    } elseif($player1score > $player2score) {
        return "1";
    } elseif ($player2score > $player1score){
        return "0";
    } else {
        return "dafuq";
    }
}
?>