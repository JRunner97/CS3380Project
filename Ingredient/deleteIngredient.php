<?php
    // Start the session
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ingredientName = htmlspecialchars($_POST['ingredientName']);
    }

    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";


    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DELETE FROM ingredients WHERE ingredientName='$ingredientName' AND userID='$_SESSION[currentUser]'";
        
        $conn->exec($sql);

        // TODO add flash messages
        // redirects user back to ingredientList.php page if successful
        header("Location: /CS3380Project/Ingredient/ingredientList.php");

        // makes it so that the rest of the code isn't executed
        exit();
        
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

?>