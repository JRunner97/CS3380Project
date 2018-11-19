<?php
// Start the session
session_start();
?>

<?php

    header("Content-Type: application/json; Applications/XAMPP/htdocs/CS3380Project/GroceryList/groceryList.html");
    $obj = json_decode($_POST["x"], false);

    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {
        
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        
        //Getting the current users ID
        $userID = $_SESSION(currentUser);
        //$userID = 2; //Used for testing
        
        //Getting ingredients form favorited recipes
        $ingredients = $conn->prepare("SELECT R.ingredients FROM favorite F, recipes R WHERE F.userID = '$userID' AND F.recipeID = R.recipeID");
        $ingredients->bind_param("s", $obj->table);
        $ingredients->execute();
        $result = $ingredients->get_result();
        $outp = $result->fetch_all();
        
        echo json_encode($outp);
        
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        
    }

?>