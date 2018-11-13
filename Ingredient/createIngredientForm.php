<?php
// Created by Professor Wergeles for CS2830 at the University of Missouri

    if(!session_start()){
        header("Location: /CS3380Project/error.php");
        exit;
    }

	$currentUser = empty($_SESSION['currentUser']) ? false : $_SESSION['currentUser'];
	if (!$currentUser) {
		header("Location: /CS3380Project/login.php");
		exit;
	}
?>
<!DOCTYPE  html>
<html lang="en">

    <head>
    
        <title>CS3380 Project | Create New User</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../Styles/project.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script> 
    </head>

    <body id="createIngredientBody">
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
            <a href='#home' class='links'>Home</a>
            <a href='#news' class='links'>News</a>
            <a href='/CS3380Project/logout.php' class='links'>Logout</a>
        </div>
        
        <img id="contentBackground" src="https://mizzoumag.missouri.edu/wp-content/uploads/2013/11/quad_web.jpg">
        
        <div id="createIngredientBox">
        
            <h1 class="boxHeader">Create New Ingredient</h1>
            
            <form id="createIngredientForm" action="createIngredient.php" method="post" data-parsley-validate>
                
                <label for="name">Name:</label>
                
                <br>
                
                <input id="name" type="text" name="ingredient_name" placeholder="Ingredient"> 
                
                <br>
                
                <div class="side-by-side">
                    <label for="username">Quantity:</label>
                    <br>
                    <input id="quantity" type="text" name="quantity" placeholder="Quantity">
                </div>
            
                <button id="newIngredientButton" type="submit" form="createIngredientForm" class="button" value="Submit">Create User</button>
            
            </form>
        
        </div>
    
    </body>
</html>