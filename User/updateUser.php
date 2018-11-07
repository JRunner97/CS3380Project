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

    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {

        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT username FROM users WHERE username = '$username'");
        $stmt->execute();

        // checks if a query returned a tuple from db
        // if it did then the username is taken
        if($stmt->rowCount() == 0){
           
            $createdTimestamp = date('Y-m-d G:i:s');

            $sql = "UPDATE users SET username='$username', password='$password', email='$email', first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth', ssn='$ssn' WHERE id='$id'";

            // Prepare statement
            $stmt = $conn->prepare($sql);

            // execute the query
            $stmt->execute();
            
            // TODO add flash messages
            // redirects user back to userList.php page if successful
            header("Location: /CS3380Project/User/userList.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
           
        }
        else {
            
            // TODO add flash messages
            
            // redirects user back to userList.php page if username already taken
            header("Location: /CS3380Project/User/userList.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
        }
        
        
        
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
  

?>