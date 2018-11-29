<?php

    // define variables and set to empty values
//    $name = $email = $gender = $comment = $website = "";
//
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = htmlspecialchars($_POST['id']);
        $ingredientName = htmlspecialchars($_POST['ingredientName']);
        $quantity  = htmlspecialchars($_POST['quantity']);
    }

    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {

        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // checks if ingredient already exists for this user
        $stmt = $conn->prepare("SELECT ingredientName FROM ingredients WHERE ingredientName = '$ingredientName' AND ingredientID <> '$id'");
        $stmt->execute();

        // checks if a query returned a tuple from db
        // if it did then the username is taken
        if($stmt->rowCount() == 0){
           
            $createdTimestamp = date('Y-m-d G:i:s');

            $sql = "UPDATE ingredients SET ingredientName='$ingredientName', quantity='$quantity' WHERE ingredientID='$id'";

            // Prepare statement
            $stmt = $conn->prepare($sql);

            // execute the query
            $stmt->execute();
            
            // TODO add flash messages
            // redirects user back to userList.php page if successful
            header("Location: /CS3380Project/Ingredient/ingredientList.php");
            //require '../GroceryList/createGroceryList.php';
            
            // makes it so that the rest of the code isn't executed
            exit();
           
        }
        else {
            
            // TODO add flash messages
            
            // redirects user back to userList.php page if username already taken
            header("Location: /CS3380Project/Ingredient/ingredientList.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
        }
        
        
        
        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }
  

?>