<?php
    // cleans post data of unwanted char
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ingredient_name = htmlspecialchars($_POST['ingredient_name']);
        $quantity  = htmlspecialchars($_POST['quantity']);
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
            $sql = "INSERT INTO ingredients (userID, ingredientName, quantity)
            VALUES ('$ingredient_name', '$quantity')";

            // note use of exec() instead of execute()
            $conn->exec($sql);
            
            // TODO add flash messages
            // redirects user back to userList.php page if successful
            header("Location: /CS3380Project/User/userList.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
           
        }
        else {
            
            // TODO add flash messages
            // redirects user back to createUser.html page if username already taken
            header("Location: /CS3380Project/User/createUser.html");
            
            // makes it so that the rest of the code isn't executed
            exit();
        }
        
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        
    }

?>