<?php

    echo "<head>";
    echo '<meta http-equiv="Content-type" value="text/html; charset=UTF-8" />';
    echo "</head>";
    echo "<style>";
        include $_SERVER['DOCUMENT_ROOT'].'/css/header.css';
    echo "</style>";

    # URLs
    $homeURL = $_SERVER['HTTP_HOST'].'/index.php';
    $newUserURL = $_SERVER['HTTP_HOST'].'/new-user.php';
    $tournamentURL = $_SERVER['HTTP_HOST'].'/tournament.php';
?>



<div class="navbar">
    <div class="header-left">
        <a id="headerbutton"href="//<?php echo $homeURL; ?>">Home</a>
        <a id="headerbutton" href="//<?php echo $newUserURL; ?>">New User</a>
        <a id="headerbutton" href="<?php echo "#"; ?>">Tournament</a>
    </div>

    <div class="header-right">
        
        <label class="form-switch">
            <input type="checkbox" class="form-switch" onclick="toggleDarkLight()">
            <i></i>
        </label>
    </div>
</div>

<script>
    function toggleDarkLight() {
        var body = document.getElementById("body");
        var currentClass = body.className;
        body.className = currentClass == "dark-mode" ? "light-mode" : "dark-mode";
    }
</script>