<?php
    // Start the session
    session_start();
    // cleans post data of unwanted char
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $ingredient_name = strtolower(htmlspecialchars($_POST['ingredient_name']));
        $quantity  = htmlspecialchars($_POST['quantity']);
    }


    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

        $stmt = $conn->prepare("SELECT ingredientID FROM ingredients WHERE ingredientName = '$ingredient_name' AND userID = '$_SESSION[currentUser]'");
        $stmt->execute();

        
        

        // checks if a query returned a tuple from db
        // if it did then the ingredient is already entered into the db
        if($stmt->rowCount() == 0){
           
            $createdTimestamp = date('Y-m-d G:i:s');

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // gets the ID of the currently logged-in user from $SESSION super global
            $sql = "INSERT INTO ingredients (userID, ingredientName, quantity)
            VALUES ('$_SESSION[currentUser]','$ingredient_name', '$quantity')";

            // note use of exec() instead of execute()
            $conn->exec($sql);
            
            // TODO add flash messages
            // redirects user back to ingredient list page if successful
//            require '../GroceryList/createGroceryList.php';
            header("Location: /CS3380Project/Ingredient/ingredientList.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
           
        }
        else {
   
            
            // TODO add flash messages
            // redirects user back to ingredient list if ingredient is already entered
            header("Location: /CS3380Project/Ingredient/ingredientList.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
        }
        
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        
    }

?>