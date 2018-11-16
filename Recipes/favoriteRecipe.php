<!DOCTYPE html>
<html lang="en">
    

        <head>
            <title>Recipe Favorited</title>
        </head>
    
    
    <body>
        
       


<?php 
    
    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

 try{   $recID= $_GET["recID"];
    
    $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    $userID=$_SESSION(currentUser);
     
    $favorite = $conn->prepare("INSERT INTO favorite (userID, recipeID) VALUES($userID, $recID)");
    $favorite->execute();
     
      if($favorite->rowCount() > 0){

                       echo "Added to Favorites";
                }
    }
catch(PDOException $e){
    echo "Connection Failed: ".$e->getMessage();
    }

    ?>
<button type="submit" formaction="listRecipe.php">Return to recipe list</button>
</body>
</html> 