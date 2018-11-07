<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
    }

    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";


    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DELETE FROM users WHERE username='$username'";
        
        $conn->exec($sql);

        // TODO add flash messages
        // redirects user back to userList.php page if successful
        header("Location: /CS3380Project/User/userList.php");

        // makes it so that the rest of the code isn't executed
        exit();
        
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

?>