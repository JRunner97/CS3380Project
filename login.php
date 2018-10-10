<?php

    // define variables and set to empty values
//    $name = $email = $gender = $comment = $website = "";
//
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['user']);
        $password  = htmlspecialchars($_POST['password']);

        echo  $username, ' ', $password, implode("",$_REQUEST);
    }
  

?>