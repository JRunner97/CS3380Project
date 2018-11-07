<?php

    // define variables and set to empty values
//    $name = $email = $gender = $comment = $website = "";
//
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['user']);
        $password  = htmlspecialchars($_POST['password']);

        echo  $username, ' ', $password, implode("",$_REQUEST);
    }

    $servername = "localhost";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = '$username' AND password = '$password'");
        $stmt->execute();

        //so we can use name->value pairs
        if($stmt->rowCount() > 0){
            /*  how to get data from query
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $queriedUsername = $row['username'];
                $queriedPassword = $row['password'];
            */
           
        }
        else {
            print_r("invalid credentials");
        }
        
        
        

        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
  

?>