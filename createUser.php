<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $password  = htmlspecialchars($_POST['password']);
        $email  = htmlspecialchars($_POST['email']);
        $first_name  = htmlspecialchars($_POST['first_name']);
        $last_name  = htmlspecialchars($_POST['last_name']);
        $date_of_birth  = htmlspecialchars($_POST['date_of_birth']);
        $ssn  = htmlspecialchars($_POST['ssn']);

        echo  $username, $password, $email, $first_name, $last_name, $date_of_birth, $ssn, implode("",$_REQUEST);
    }

//    $servername = "localhost";
//    $dbUsername = "root";
//    $dbPassword = "cs12345";
//
//    try {
//        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
//        // set the PDO error mode to exception
//        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        echo "Connected successfully";
//        
//        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = '$username' AND password = '$password'");
//        $stmt->execute();
//
//        //so we can use name->value pairs
//        if($stmt->rowCount() > 0){
//            /*  how to get data from query
//                $row = $stmt->fetch(PDO::FETCH_ASSOC);
//                $queriedUsername = $row['username'];
//                $queriedPassword = $row['password'];
//            */
//           
//        }
//        else {
//            print_r("invalid credentials");
//        }
//     
//        }
//    catch(PDOException $e)
//        {
//        echo "Connection failed: " . $e->getMessage();
//        }

?>