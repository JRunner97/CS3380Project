<?php
    // Start the session

//    if(!session_start()){
//        header("Location: /CS3380Project/error.php");
//        exit;
//    }

	$currentUser = empty($_SESSION['currentUser']) ? false : $_SESSION['currentUser'];
	if (!$currentUser) {
		header("Location: /CS3380Project/login.php");
		exit;
	}

    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // gets all of the ingredients from the recipes a user favorites
        $stmt = $conn->prepare("SELECT R.ingredients FROM favorite F, recipes R WHERE F.userID = '$_SESSION[currentUser]' AND F.recipeID = R.recipeID");
        
        $stmt->execute();
        $requiredIngredients = array();

        if($stmt->rowCount() > 0){

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach( $rows as $row){

                $tempObj = json_decode($row['ingredients']);
                    // puts distinct ingredients from the recipes a user favorites into an array
                foreach( array_keys(get_object_vars($tempObj)) as $ingredient ){
                    if(!in_array($ingredient, $requiredIngredients)){
                        $requiredIngredients[] = $ingredient;
                    }
                }
            }
        }
        
        
        // get my ingredients I already have
        $stmt = $conn->prepare("SELECT I.ingredientName FROM ingredients I WHERE I.userID = '$_SESSION[currentUser]'");
        $stmt->execute();
        
        $myIngredients = array();
        if($stmt->rowCount() > 0){

            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // puts your ingredients into an array
            foreach( $rows as $row ){
                
               $myIngredients[] = $row['ingredientName'];
                
            }
        }
            // cycles through my ingredients
            // if you already have an ingredient, then it is removed from $requiredIngredients list
        foreach($myIngredients as $myIngredient => $value){

            if(in_array($value, $requiredIngredients)){
                // array_search gets index of value, then unset removes that element from array
                unset($requiredIngredients[array_search($value, $requiredIngredients)]);
                
                // array_values reindexes the array after the unset
                $requiredIngredients= array_values($requiredIngredients);
            }        
            
        }
        
        $myJSON = json_encode($requiredIngredients);
        
        
        
        
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

        $stmt = $conn->prepare("SELECT userID FROM groceryList WHERE userID = '$_SESSION[currentUser]'");
        $stmt->execute();

        // checks if a query returned a tuple from db
        // if it did then a grocery list already exists for this person
        if($stmt->rowCount() == 0){
           
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $sql = "INSERT INTO groceryList (userID, ingredients)
            VALUES ('$_SESSION[currentUser]', '$myJSON')";

            // note use of exec() instead of execute()
            $conn->exec($sql);

            // TODO add flash messages
            // redirects user back to userList.php page if successful
            header("Location: /CS3380Project/GroceryList/groceryList.php");

        }
        else {
            $sql = "UPDATE groceryList SET ingredients = '$myJSON' WHERE userID='$_SESSION[currentUser]'";

            // Prepare statement
            $stmt = $conn->prepare($sql);

            // execute the query
            $stmt->execute();

        }

        }
    catch(PDOException $e)
        {

        }

?>