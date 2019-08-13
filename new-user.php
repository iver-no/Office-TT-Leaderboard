<?php

    include $_SERVER['DOCUMENT_ROOT'].'/config/config.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/nfc-hex.php';
    include $_SERVER['DOCUMENT_ROOT'].'/functions/is-admin.php';
    echo "<style>";
    include $_SERVER['DOCUMENT_ROOT'].'/css/new-user.css';
    echo "</style>";

    echo "<title>New User</title>";

    $link = mysqli_connect($ip,$username,$password,"officepingpongELO");

    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    include $_SERVER['DOCUMENT_ROOT'].'/sections/header.php';

    echo '<body id="body" class="light-mode">';

    if(isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $UUID = $_POST['uuid'];
        $adminUUID = $_POST['adminuuid'];

        if(($firstname == "") or ($lastname == "")) {
            errorMsg("Name field missing");
            displayForm();
            return;
        }

        if(!isAdmin($adminUUID)) {
            errorMsg("Invalid Admin");
            displayForm();
            return;
        }

        if(!isset($UUID[7])){
            errorMsg("Please enter a proper UUID");
        } else {
            # Assume someone entered the code in the back
            if(is_numeric($UUID)){
                $UUID = nfchex($UUID);
            }

            $query = "INSERT INTO elo VALUES ('$firstname', '$lastname', NULL ,1000 , 0 , 0, LOWER('$UUID'), 0)";


            
            displayForm();

            $result = mysqli_query($link, $query);

            if(mysqli_errno($link) == 1062){
                errorMsg("UUID is already in use!");
            } else if(mysqli_errno($link) == 0) {
                echo "<div class='submitMsg'> <h1 class='success'>";
           
                print_r ($firstname . ' ' . $lastname . ' registered with UUID: ' . $UUID);
                echo "</h1></div>";
            } else {
                printf (mysqli_errno($link));
            }
        }
        

    }else {
        echo "";
    }

    displayForm();

    function errorMsg($msg){
        echo "<div class='submitMsg'> <h1 class='error'>$msg</h1></div>";
    }

    function displayForm(){
        echo '<form method="post">
                <a class="form-text">
                First name:</a>
                <input type="text" name="firstname" autofocus id="firstname"><br>

                <a class="form-text">
                Last name:</a>
                <input type="text" name="lastname" id="lastname"><br>

                <a class="form-text">
                UUID:</a>
                <input type="text" name="uuid" id="uuid"><br><br>

                <a class="form-text">
                Admin UUID:</a>
                <input type="password" name="adminuuid" id="adminuuid"><br><br>

                <input type="submit" value="Submit" name="submit" class="submitBtn">        
                </form>';
        
        echo "<script>";
            include $_SERVER['DOCUMENT_ROOT'].'/js/new-user.js';
        echo "</script>";

    }
?>

</body>