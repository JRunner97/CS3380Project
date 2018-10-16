<?php

    // define variables and set to empty values
//    $name = $email = $gender = $comment = $website = "";
//
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = htmlspecialchars($_POST['id']);
        $username = htmlspecialchars($_POST['username']);
        $password  = htmlspecialchars($_POST['password']);
        $email  = htmlspecialchars($_POST['email']);
        $first_name  = htmlspecialchars($_POST['first_name']);
        $last_name  = htmlspecialchars($_POST['last_name']);
        $date_of_birth  = htmlspecialchars($_POST['date_of_birth']);
        $ssn  = htmlspecialchars($_POST['ssn']);
    }

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "cs12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE users SET username='$username', password='$password', email='$email', first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth', ssn='$ssn' WHERE id='$id'";

        // Prepare statement
        $stmt = $conn->prepare($sql);

        // execute the query
        $stmt->execute();

        // echo a message to say the UPDATE succeeded
        echo $stmt->rowCount() . " records UPDATED successfully";
        
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
  

?>