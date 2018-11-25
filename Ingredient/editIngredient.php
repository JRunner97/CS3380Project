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
    <html lang='en'>
        <head>
            <title>CS3380 Project | Ingredient List</title>
            <meta charset='utf-8'>
            <link rel='stylesheet' type='text/css' href='../Styles/project.css'>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js'></script>

        </head>
        <body id='editUserBody'>
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

            <img id='contentBackground' src='https://mizzoumag.missouri.edu/wp-content/uploads/2013/11/quad_web.jpg'>

            <div id='editUserBox'>

                <h1 class='boxHeader'>Edit Ingredient</h1>
                <form action='updateIngredient.php' method='post' id='updateUserForm'>
                                     
    <?php
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

            $stmt = $conn->prepare("SELECT ingredientID, ingredientName, quantity FROM ingredients WHERE ingredientName = '$ingredientName' AND userID = '$_SESSION[currentUser]'");
            $stmt->execute();

            //so we can use name->value pairs
            if($stmt->rowCount() > 0){

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $queriedId = $row['ingredientID'];
                    $queriedIngredientName = $row['ingredientName'];
                    $queriedQuantity = $row['quantity'];

                    echo " <label for='name'>Name:</label>

                    <br>
                    <input type='hidden' name='id' value='" . $queriedId . "'>

                    <input id='ingredientName' type='text' name='ingredientName' value='" . $queriedIngredientName . "' placeholder='Ingredient'> 
                    <br>

                    <div class='side-by-side'>
                        <label for='Quantity'>Quantity:</label>
                        <br>
                        <input id='quantity' type='text' name='quantity' value='" . $queriedQuantity . "' placeholder='Quantity'>
                    </div>

                    <br>

                    <button id='newUserButton' type='submit' form='updateUserForm' class='button' value='Submit'>Update Ingredient</button> ";

            }
            else {
                print_r("invalid credentials");
            }




            }
        catch(PDOException $e)
            {
            echo "Connection failed: " . $e->getMessage();
            }
    ?>

            </form>  
        </div>
    </body>
</html>