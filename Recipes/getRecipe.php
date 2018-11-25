<?php
    //start session or redirect if cannot initialize

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
<!DOCTYPE html>
<html lang="en">
    

        <head>
            <title>Recipe Search</title>
        </head>
    
    
    <body>
        <?php echo $_GET["type"]; ?> Search<br> 

<table>
        <style>
            table {
                border-collapse: collapse;
                }
            th, td {
                border: 1px solid orange;
                padding: 10px;
                text-align: left;
                    }
        </style>
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

</body>
</html> 