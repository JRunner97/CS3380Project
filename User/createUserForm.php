<?php

    if(!session_start()){
        header("Location: /CS3380Project/error.php");
        exit;
    }

	$currentUser = empty($_SESSION['currentUser']) ? false : $_SESSION['currentUser'];

    
    //Commented this portion out because it wasn't allowing the createUserForm.php to display. It was just rerouting it.
	/*if (!$currentUser) {
		header("Location: /CS3380Project/login.php");
		exit;
	}*/
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

    <body id="createUserBody">
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
        
        <?php
        
        //$currentUser = empty($_SESSION['currentUser']) ? false : $_SESSION['currentUser'];
            if (!empty($_SESSION['error'])) {
                print "<div class='error-message'>
                  <strong>Warning! </strong>'$_SESSION[error]'
                </div>";
            }
        ?>
        
        <div id="createUserBox">
        
            <h1 class="boxHeader">Create New User</h1>
            
            <form id="createUserForm" action="createUser.php" method="post" data-parsley-validate>
                
                <label for="name">Name:</label>
                
                <br>
                
                <input id="name" type="text" name="first_name" placeholder="First"> 
                <input type="text" name="last_name" placeholder="Last">
                
                <br>
                
                <div class="side-by-side">
                    <label for="username">Username:</label>
                    <br>
                    <input id="username" type="text" name="username" placeholder="Username" data-parsley-required data-parsley-length="[6, 30]">
                </div>
                
                <div class="side-by-side">
                    <label for="password">Password:</label>
                    <br>
                    <input id="password" type="password" name="password" placeholder="Password" data-parsley-required data-parsley-length="[6, 30]">
                </div>
                
                <br>
                
                <div class="side-by-side">
                    <label for="email">Email:</label>
                    <br>
                    <input id="email" type="email" name="email" placeholder="example@gmail.com" data-parsley-required data-parsley-length="[6, 30]">
                </div>
                
                <div class="side-by-side">
                    <label for="date_of_birth">Date of Birth:</label>
                    <br>
                    <input id="date_of_birth" type="date" name="date_of_birth">
                </div>
            
                <button id="newUserButton" type="submit" form="createUserForm" class="button" value="Submit">Create User</button>
            
            </form>
        
        </div>
    
    </body>
</html>