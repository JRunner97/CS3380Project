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
?>
<!DOCTYPE  html>
    <html lang='en'>
        <head>
            <title>Recipe Search</title>
            <meta charset='utf-8'>
            <link rel='stylesheet' type='text/css' href='../Styles/project.css'>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js'></script>
            <script src='../Scripts/userList.js'></script>

        </head>
        <body id='userListBody'>
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

            <div id='userListBox'>

                <h1 class='boxHeader'><?php echo $_GET["type"]; ?> Search</h1>

                    <table id="data">
<?php 
    
    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try{   
        $type= $_GET["type"];

        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         
        // if type is not favorites
        if(strcmp($type, "favorites") != 0){
            
            // may want to convert to associative array to reduce lines of code
            switch ($type) {
                case "snack":
                    $attribute= "flavor";
                    break;
                case "breakfast":
                    $attribute= "prepTime";
                    break;
                case "lunch":
                    $attribute= "calories";
                    break;
                case "dinner": 
                    $attribute= "serves";
                    break;
             }
        
            $search = $conn->prepare("SELECT recipeName, cookTime, ingredients, $attribute FROM $type T, recipes R WHERE R.recipeID=T.recipeID");
            
            $search->execute();

            if($search->rowCount() > 0){

                $row = $search->fetchAll(PDO::FETCH_ASSOC);

                    echo "  
                        <tr>
                            <td class='recipeName'>Recipe Name</td>
                            <td class='cookTime'>Cook Time</td>
                            <td class='ingredients'>Ingredients</td>
                            <td class='$attribute'>$attribute</td>
                        </tr>
                        ";

                foreach($row as $recipeRow){
                    // get json
                    $jsonObject = json_decode($recipeRow['ingredients'], true);

                    // implode breaks json contents into comma seperated list
                    echo "  
                        <tr>
                            <td class='recipeName'>" . $recipeRow["recipeName"] . "</td>
                            <td class='cookTime'>" . $recipeRow["cookTime"] . "</td>
                            <td class='ingredients'>" . implode(", ", array_keys($jsonObject)) . "</td>
                            <td class='$attribute'>" . $recipeRow["$attribute"] . "</td>
                        </tr>
                        ";
                }
            } 
            
        }
        else{
            // TODO this is a quick fix, needs to add attribute later for favorites
            
            $search = $conn->prepare("SELECT recipeName, cookTime, ingredients FROM recipes R, favorite F WHERE F.recipeID = R.recipeID AND '$_SESSION[currentUser]' = F.userID");
            
            $search->execute();

            if($search->rowCount() > 0){

                $row = $search->fetchAll(PDO::FETCH_ASSOC);

                    echo "  
                        <tr>
                            <td class='recipeName'>Recipe Name</td>
                            <td class='cookTime'>Cook Time</td>
                            <td class='ingredients'>Ingredients</td>
                        </tr>
                        ";

                foreach($row as $recipeRow){
                    // get json
                    $jsonObject = json_decode($recipeRow['ingredients'], true);

                    // implode breaks json contents into comma seperated list
                    echo "  
                        <tr>
                            <td class='recipeName'>" . $recipeRow["recipeName"] . "</td>
                            <td class='cookTime'>" . $recipeRow["cookTime"] . "</td>
                            <td class='ingredients'>" . implode(", ", array_keys($jsonObject)) . "</td>
                        </tr>
                        ";
                }
            } 
        }
        
          
    }
    catch(PDOException $e){
        echo "Connection Failed: ".$e->getMessage();
    }

?>
</table>
        </div>
    </body>
</html>