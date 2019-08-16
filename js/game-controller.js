console.log("Start up");

player1score = 0;
player2score = 0;
player1Id = "";
player2Id = "";
sec = 5;

function scoreAdd(playerN) {

    //document.getElementById("scorep"+playerN).value("2");

    var playerDiv=document.getElementById('player'+playerN+'score');
    var anchors=playerDiv.getElementsByTagName('a');
    if (anchors[0]) {
        _score = parseInt(anchors[0].innerHTML, 10);
        _score++;
        anchors[0].innerHTML = _score;

        isGameOver(_score);
    }
    
}

function scoreMinus(playerN) {

    //document.getElementById("scorep"+playerN).value("2");

    var playerDiv=document.getElementById('player'+playerN+'score');
    var anchors=playerDiv.getElementsByTagName('a');
    if (anchors[0]) {
        _score = parseInt(anchors[0].innerHTML, 10);
        if(_score == 0) {
            
        } else {
            _score--;
            isGameOver(_score);
        }
        
        anchors[0].innerHTML = _score;
    }
}

function addListeners(){

    if(!!$.cookie("display-mode")){
        console.log($.cookie("display-mode"));
        if($.cookie("display-mode") == "light-mode"){
            console.log("light-mode");
            var body = document.getElementById("body");
            body.className = "light-mode";
            document.getElementById("display-switch").checked = false;
        }            
        if($.cookie("display-mode") == "dark-mode"){
            console.log("dark-mode");
            var body = document.getElementById("body");
            body.className = "dark-mode";
            document.getElementById("display-switch").checked = true;
        }
        
    } else {
        var CookieSet = $.cookie("display-mode","light-mode");
    }

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
    
            userNotFound();
        }
    });
}

function isGameOver(score){
    if(score >= 11) {
        document.getElementById("gameOverBtn").style.display = "block";
    } else {
        document.getElementById("gameOverBtn").style.display = "none";
        return;
    }
}

function checkPlayers(){
    
    if(player1uuid == "" || player2uuid == "" || (player1uuid == player2uuid) || userNotFound) {
        return false;
    }
        return;
}

function userNotFound(){
    //Checks if either Player1 or player2 was not found
    if((document.getElementById("player1text").innerHTML == "User not found") || (document.getElementById("player2text").innerHTML == "User not found")) {
        return;
    }
    else {
        document.getElementById("player1").style.display = "none";
        document.getElementById("player1score").style.display = "block";
        
        document.getElementById("player2").style.display = "none";
        document.getElementById("player2score").style.display = "block";
        return;
    }
}


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

function gameSubmit() {

    //Player 1 score
    var playerDiv1=document.getElementById('player1score');
    var anchors1=playerDiv1.getElementsByTagName('a');
    if (anchors1[0]) {
        player1score = parseInt(anchors1[0].innerHTML, 10);
    }
    //Player 2 score
    var playerDiv2=document.getElementById('player2score');
    var anchors2=playerDiv2.getElementsByTagName('a');
    if (anchors2[0]) {
        player2score = parseInt(anchors2[0].innerHTML, 10);
    }

    player1uuid = document.getElementById("player1name").innerHTML;
    player2uuid = document.getElementById("player2name").innerHTML;
    
    console.log(player1uuid + " went " +player1score + " VS " + player2uuid + "'s " +player2score);

    if(player1uuid == "" || player2uuid == "" || (player1uuid == player2uuid)) {
        //Send a message to the user that something went very wrong...
        countdown();
        return;
    } else {
        xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200) {
                //document.getElementById(playerId).innerHTML = this.responseText;
                console.log("Success, lets do something about it");
            }
        };
        xmlhttp.open("GET","/functions/handle-match.php?p1uuid="+player1uuid+"&p1score="+player1score+"&p2uuid="+player2uuid+"&p2score="+player2score,false);
        console.log("/functions/handle-match.php?p1uuid="+player1uuid+"&p1score="+player1score+"&p2uuid="+player2uuid+"&p2score="+player2score);
        xmlhttp.send();
        document.getElementById("gameOverInfo").innerHTML = xmlhttp.responseText;
        document.getElementById("gameOverInfo").style.display = "block";
        document.getElementById("gameOverBtn").style.display = "none";
        document.getElementById("newgameBtn").style.display = "inline-block";
    
        countdown();
    }
}



function countdown(){
    sec = sec - 1;
    if(sec < 0) {
        window.location = "https://iver.fun/index.php";
    } else {
        document.getElementById("vs").innerHTML = "Redirecting in " + sec;
        window.setTimeout("countdown()", 1000);
    }

}

