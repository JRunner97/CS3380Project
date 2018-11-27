<?php
    // start session or redirect to error page if unable to initialize

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

    try{   
        
        $recID= $_GET["recID"];
        
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

        $stmt = $conn->prepare("SELECT recipeID FROM favorite WHERE userID = '$_SESSION[currentUser]' AND recipeID = '$recID'");
        $stmt->execute();

        // checks if a query returned a tuple from db
        // if it did then the recipe is already favorited
        if($stmt->rowCount() == 0){
           
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $userID = $_SESSION['currentUser'];

            $favorite = $conn->prepare("INSERT INTO favorite (userID, recipeID) VALUES($userID, $recID)");
            $favorite->execute();

            if($favorite->rowCount() > 0){

                // TODO add flash message to display on listRecipes, that indicates 'favorite' was successful

                // redirect to listRecipes if successfully added to favorites list
                header("Location: listRecipes.php");
            }
            
            // makes it so that the rest of the code isn't executed
            exit();
           
        }
        else {
            
            // TODO add flash messages
            // redirects user back to listRecipes if the recipe has already been favorited
            header("Location: /CS3380Project/Recipes/listRecipes.php");
            
            // makes it so that the rest of the code isn't executed
            exit();
        }
        
        
        

    }
    catch(PDOException $e){

        echo "Connection Failed: ".$e->getMessage();

    }

?>