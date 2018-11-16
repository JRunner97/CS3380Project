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

 try{   $type= $_GET["type"];
    
    $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
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
        //                $queriedUsername = $row['username'];
        //                $queriedPassword = $row['password'];
        //                print_r($row);
        //                print_r($row[0]['username']);
                            echo "  
                                    <tr>
                                        <td class='recipeName'>Recipe Name</td>
                                        <td class='cookTime'>Cook Time</td>
                                        <td class='ingredients'>Ingredients</td>
                                        <td class='$attribute'>$attribute</td>
                                    </tr>
                                ";
                        foreach($row as $recipeRow){
                            echo "  
                                    <tr>
                                        <td class='recipeName'>" . $recipeRow["recipeName"] . "</td>
                                        <td class='cookTime'>" . $recipeRow["cookTime"] . "</td>
                                        <td class='ingredients'>" . $recipeRow["ingredients"] . "</td>
                                        <td class='$attribute'>" . $recipeRow["$attribute"] . "</td>
                                    </tr>
                                ";
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