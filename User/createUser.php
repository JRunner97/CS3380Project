<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $password  = htmlspecialchars($_POST['password']);
        $email  = htmlspecialchars($_POST['email']);
        $first_name  = htmlspecialchars($_POST['first_name']);
        $last_name  = htmlspecialchars($_POST['last_name']);
        $date_of_birth  = htmlspecialchars($_POST['date_of_birth']);
        $ssn  = htmlspecialchars($_POST['ssn']);

//        echo  $username, $password, $email, $first_name, $last_name, $date_of_birth, $ssn, //implode("",$_REQUEST);
    }

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "cs12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        // set the PDO error mode to exception
        $createdTimestamp = date('Y-m-d G:i:s');

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (username, password, email, first_name, last_name, date_of_birth, ssn, created_at)
        VALUES ('$username', '$password', '$email', '$first_name', '$last_name', '$date_of_birth', '$ssn', '$createdTimestamp')";
        
        // use exec() because no results are returned
        $conn->exec($sql);
        
        echo "New record created successfully";

        //so we can use name->value pairs
     
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

?>