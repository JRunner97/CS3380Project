<?php
// Start the session
session_start();
?>

<?php

    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {
        
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        
        //Getting the current users ID
        $userID = $_SESSION(currentUser);
        
        //Getting any recipes that the current user favorited
        $favoriteRecipes = $conn->prepare("SELECT recipeID FROM favorite WHERE userID = '$userID'");
        $favoriteRecipes->execute();
        
        //Checking if there are any favorited recipes
        if($favoriteRecipes->rowCount() != 0){
            
            //Getting the ingredients of recipes that the user has favorited
            $favoriteIngredients = $conn->prepare("SELECT ingredients FROM recipes WHERE recipeID IN '$favoriteRecipes'");
            $favoriteIngredients->execute();
            
        }
        else {
            
            //Not sure if this is how to display back on the page
            echo "There are no items on your grocery list.";
            
            exit();
        }
        
    }
    catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        
    }

?>