<?php
    // Start the session

    if(!session_start()){
        header("Location: /CS3380Project/error.php");
        exit;
    }

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
                unset($requiredIngredients[$myIngredient]);
            }
        }
        
        $myJSON = json_encode($requiredIngredients);
        
        echo $myJSON;

        }
    catch(PDOException $e)
        {

        }

?>