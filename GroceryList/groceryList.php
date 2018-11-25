<?php
// Start the session
session_start();


//    header("Content-Type: application/json; groceryList.html");
//    $obj = json_decode($_POST["x"], false);
//
//    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
//    $dbUsername = "ProjectUser";
//    $dbPassword = "12345";
//
//    try {
//        
//        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
//        
//        //Getting the current users ID
//        $userID = $_SESSION['currentUser'];
//        //$userID = 2; //Used for testing
//        
//        //Getting ingredients form favorited recipes
//        $ingredients = $conn->prepare("SELECT R.ingredients FROM favorite F, recipes R WHERE F.userID = '$userID' AND F.recipeID = R.recipeID");
//        
//        $ingredients->bindParam("s", $obj->table);
//        
//        $ingredients->execute();
//        
//        $result = $ingredients->get_result();
//        
//        $outp = $result->fetch_all();
//        
//        var_dump($outp);
//        
//        //echo json_encode($outp);
//        
//    }
//    catch(PDOException $e){
//        echo "Connection failed: " . $e->getMessage();
//        
//    }


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
        
        // turn array into comma seperated list
        //$returnText = implode(", ", $requiredIngredients);
        //echo $returnText;   
        
        $myJSON = json_encode($requiredIngredients);
        
        echo $myJSON;

        }
    catch(PDOException $e)
        {

        }

?>