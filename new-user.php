<?php

    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/nfc-hex.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/is-admin.php';

    $link = mysqli_connect($ip,$username,$password,"officepingpongELO");

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    include $_SERVER['DOCUMENT_ROOT'].'/sections/header.php';

    if(isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $UUID = $_POST['uuid'];
        $adminUUID = $_POST['adminuuid'];

        if(($firstname == "") or ($lastname == "")) {
            echo "Name field missing";
            displayForm();
            return;
        }

        if(!isAdmin($adminUUID)) {
            echo "Invalid Admin";
            displayForm();
            return;
        }

        if(!isset($UUID[10])){
            #echo "Decimal";
            if (is_numeric($UUID)) {
                #echo "is numeric";
                $UUID = nfchex($UUID);
            }
            else {
                echo "Please enter a numeric value in UUID";
                displayForm();
                return;
            }
        } else {
            #echo "Hex";
        }

        
        $query = "INSERT INTO elo VALUES ('$firstname', '$lastname', 1000 , 0 , 0, LOWER('$UUID'), 0)";
        echo $firstname . ' ' . $lastname . ' registered with UUID: ' . $UUID;


        #echo "<br> $query";

        $result = mysqli_query($link, $query);

    }else {
        echo "";
    }

    displayForm();

    function displayForm(){
        echo '<form method="post">
                First name:<br>
                <input type="text" name="firstname" autofocus><br>
                Last name:<br>
                <input type="text" name="lastname"><br>
                UUID:<br>
                <input type="text" name="uuid"><br><br>
                Admin UUID:<br>
                <input type="text" name="adminuuid"><br><br>
                <input type="submit" value="Submit" name="submit">
                </form>';
    }
?>

