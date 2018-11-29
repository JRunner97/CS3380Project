<?php
    if(!session_start()){
        header("Location: /CS3380Project/error.php");
        exit;
    }
    // cleans post data of unwanted char
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
        $password  = htmlspecialchars($_POST['password']);
        $email  = htmlspecialchars($_POST['email']);
        $first_name  = htmlspecialchars($_POST['first_name']);
        $last_name  = htmlspecialchars($_POST['last_name']);
        $date_of_birth  = htmlspecialchars($_POST['date_of_birth']);
    }


    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

        $stmt = $conn->prepare("SELECT username FROM users WHERE username = '$username'");
        $stmt->execute();

        // checks if a query returned a tuple from db
        // if it did then the username is taken
        if($stmt->rowCount() == 0){
           
            $createdTimestamp = date('Y-m-d G:i:s');

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (username, pword, email, fName, lName, DOB, timeCreated)
            VALUES ('$username', '$password', '$email', '$first_name', '$last_name', '$date_of_birth', '$createdTimestamp')";

            // note use of exec() instead of execute()
            $conn->exec($sql);
            
            // TODO add flash messages
            // redirects user back to userList.php page if successful
            header("Location: /CS3380Project/User/userList.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
           
        }
        else {
            
            // $currentUser = empty($_SESSION['currentUser']) ? false : $_SESSION['currentUser'];
            
            // TODO add flash messages
            // redirects user back to createUser.html page if username already taken
            $_SESSION['error'] = "Username already taken";
            header("Location: /CS3380Project/User/createUserForm.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
        }
        
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        
    }

?>