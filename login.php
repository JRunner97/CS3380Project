<?php

    // define variables and set to empty values
//    $name = $email = $gender = $comment = $website = "";
//
//    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//      $username = $_POST["user"];
//    }
//
//    $txt1 = "Learn PHP";
//
//    echo "<h2>" . $txt1 . "</h2>";
//
//    echo "<h1>" . $username . "</h1>";

     // Check if the form is submitted
    if ( isset( $_POST['submit'] ) ) {

    // retrieve the form data by using the element's name attributes value as key

    echo '<h2>form data retrieved by using the $_REQUEST variable<h2/>';
    }

?>