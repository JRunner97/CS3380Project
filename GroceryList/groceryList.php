<?php

    if(!session_start()){
        header("Location: /CS3380Project/error.php");
        exit;
    }

	$currentUser = empty($_SESSION['currentUser']) ? false : $_SESSION['currentUser'];
	if (!$currentUser) {
		header("Location: /CS3380Project/login.php");
		exit;
	}

    require 'createGroceryList.php';
?>
<!DOCTYPE  html>
<html lang="en">

    <head>
    
        <title>CS3380 Project | Grocery List</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../Styles/project.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script> 
    </head>

    <body id="groceryListBody">
        <div class="navbar">
            <a>
                <img src="https://engineering.missouri.edu//wp-content/themes/g5plus-orion/assets/images/missouri-logo.svg">
            </a>
            <div class='dropdown'>
                <button class='dropbtn'>Users 
                    <i class='fa fa-caret-down'></i>
                </button>
                <div class='dropdown-content'>
                    <a href='/CS3380Project/User/createUserForm.php'>Create User</a>
                    <a href='/CS3380Project/User/userList.php'>User List</a>
                </div>
            </div> 
            <div class='dropdown'>
                <button class='dropbtn'>Ingredients 
                    <i class='fa fa-caret-down'></i>
                </button>
                <div class='dropdown-content'>
                    <a href='/CS3380Project/Ingredient/createIngredientForm.php'>Add Ingredient</a>
                    <a href='/CS3380Project/Ingredient/ingredientList.php'>Ingredient List</a>
                </div>
            </div> 
            <a href="/CS3380Project/Recipes/listRecipes.php" class='links'>Recipes</a>
            <a href="/CS3380Project/GroceryList/groceryList.php" class='links'>Grocery List</a>
            <a href='/CS3380Project/logout.php' class='links'>Logout</a>
        </div>
        
        <img id="contentBackground" src="https://mizzoumag.missouri.edu/wp-content/uploads/2013/11/quad_web.jpg">
        
        <div id="groceryListBox">
        
            <h1 class="boxHeader">Grocery List</h1>
            <!-- Uses the script below to get the JSON ingredients data, then decode and use innerHTML to print -->
            <ul id="groceryListItems">
            
                <?php
           
                    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
                    $dbUsername = "ProjectUser";
                    $dbPassword = "12345";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $stmt = $conn->prepare("SELECT ingredients FROM groceryList WHERE userID = '$_SESSION[currentUser]'");
                        $stmt->execute();
                     


                        if($stmt->rowCount() > 0){
                  
                            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $obj = json_decode($row[0]['ingredients']);
                            foreach( $obj as $ingredient){
                                echo "<li>" .$ingredient ."</li>";
                            }
                           
                        }

                        }
                    catch(PDOException $e)
                        {

                        }

                ?>   
            
            </ul>
            
        </div>
        
    </body>
</html>