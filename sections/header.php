<?php

    $favicon = '/img/favicon128.png';

    echo "<head>";
    echo '<meta http-equiv="Content-type" value="text/html; charset=UTF-8" />';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>';
    echo '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>';
    echo "<link rel='shortcut icon' type='image/png' href='$favicon'/>";
    echo "</head>";
    echo "<style>";
        include $_SERVER['DOCUMENT_ROOT'].'/css/header.css';
    echo "</style>";

    # URLs
    
    $homeURL = $_SERVER['HTTP_HOST'].'/index.php';
    $newUserURL = $_SERVER['HTTP_HOST'].'/new-user.php';
    $tournamentURL = $_SERVER['HTTP_HOST'].'/tournament.php';
    $matchHistoryURL = $_SERVER['HTTP_HOST'].'/match-history.php';
    $rulesURL = $_SERVER['HTTP_HOST'].'/rules.php';
?>



<div class="navbar">
    <div class="header-left">
        <a id="headerbutton"href="//<?php echo $homeURL; ?>">Home</a>
        <a id="headerbutton" href="//<?php echo $newUserURL; ?>">New User</a>
        <a id="headerbutton" href="//<?php echo $tournamentURL; ?>">Tournament</a>
        <a id="headerbutton" href="//<?php echo $matchHistoryURL; ?>">Match History</a>
        <a id="headerbutton" href="//<?php echo $rulesURL; ?>">Rules </a>
    </div>

    <div class="header-right">
    <a id="version">v1.1.21a</a>
        <label class="form-switch">
            <input type="checkbox" id="display-switch" class="form-switch" onclick="toggleDarkLight()">
            <i></i>
        </label>
    </div>
</div>

<script>
    function toggleDarkLight() {
        var body = document.getElementById("body");
        var currentClass = body.className;
        body.className = currentClass == "dark-mode" ? "light-mode" : "dark-mode";
        if(currentClass == "dark-mode"){
            var CookieSet = $.cookie("display-mode","light-mode");
        }
        if(currentClass == "light-mode"){
            var CookieSet = $.cookie("display-mode","dark-mode");
        }
    }
</script>