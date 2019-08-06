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

?>

<div class="navbar">
    <a id="headerbutton"href="//<?php echo $homeURL; ?>">Home</a>
    <a id="headerbutton" href="//<?php echo $newUserURL; ?>">New User</a>
</div>