<!DOCTYPE html>
<html lang="en">
    

        <head>
            <title>Recipes</title>
        </head>
    
    
    <body>
        
        <h1><center>Recipes</center></h1>
        <form action="getRecipe.php" method="get">
            <div style="background-color:lightgoldenrodyellow">
                <h2>Search for recipes</h2>
                <select name="type" value="<?php echo $type; ?>" >
                    <option value="snack">Snack</option>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                </select>
                <button type="submit">Search</button>
                
            </div>
        </form>
        
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

            try {
                $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                //$userID=$_SESSION(currentUser);

                $stmt = $conn->prepare("SELECT recipeID, recipeName, cookTime, ingredients FROM recipes");
                $stmt->execute();

                if($stmt->rowCount() > 0){

                        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //                $queriedUsername = $row['username'];
        //                $queriedPassword = $row['password'];
        //                print_r($row);
        //                print_r($row[0]['username']);
                        foreach($row as $recipeRow){
                            echo "  
                                    <tr>
                                        <td class='recipeName'>" . $recipeRow["recipeName"] . "</td>
                                        <td class='cookTime'>" . $recipeRow["cookTime"] . "</td>
                                        <td class='ingredients'>" . $recipeRow["ingredients"] . "</td>
                                        <td><form action='favoriteRecipe.php'>
                                            <input type='hidden' name='recID' value='".$recipeRow["recipeID"]."' />
                                            <input type='submit' value='Favorite'>
                                            </form></td>
                                    </tr>
                                ";
                        }
                }

                }
            catch(PDOException $e)
                {
                    
                }
            
        ?>
            
        </table>

    </body>

</html>