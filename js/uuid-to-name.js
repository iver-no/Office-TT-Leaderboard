console.log("Start up");

document.getElementById('player1').addEventListener('keypress', function(event) {
    // you could also do keyCode === 13
    if (event.key === 'Enter') {
        player1uuid = document.getElementById("player1").value;


        document.getElementById("player1text").append(getFullName(player1uuid,"player1text"));
        document.getElementById("player1name").append(player1uuid);

        document.getElementById("player1").style.display = "none";

        document.getElementById("player2").focus();
    }
});

document.getElementById('player2').addEventListener('keypress', function(event) {
    // you could also do keyCode === 13
    if (event.key === 'Enter') {
        player2uuid = document.getElementById("player2").value;


        document.getElementById("player2text").append(getFullName(player2uuid,"player2text"));
        document.getElementById("player2name").append(player2uuid);

        document.getElementById("player2").style.display = "none";
    }
});

function getFullName(uuid, playerId){
    if(uuid == "") {
        document.getElementById(playerId).innerHTML = "Error";
        return "";
    }
    xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            document.getElementById(playerId).innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET","/functions/uuid-to-name.php?uuid="+uuid,true);
    xmlhttp.send();
}