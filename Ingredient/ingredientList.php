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
                    <title>CS3380 Project | User List</title>
                    <meta charset='utf-8'>
                    <link rel='stylesheet' type='text/css' href='../Styles/project.css'>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js'></script>
                    <script src='../Scripts/ingredientList.js'></script>
                    
                </head>
                <body id='userListBody'>
                    <div class='navbar'>
                        <a>
                            <img src='https://engineering.missouri.edu//wp-content/themes/g5plus-orion/assets/images/missouri-logo.svg'>
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
                        <a href='#home' class='links'>Home</a>
                        <a href='#news' class='links'>News</a>
                        <a href='/CS3380Project/logout.php' class='links'>Logout</a>
                    </div>
        
                    <img id='contentBackground' src='https://mizzoumag.missouri.edu/wp-content/uploads/2013/11/quad_web.jpg'>
        
                    <div id='userListBox'>
        
                        <h1 class='boxHeader'>Ingredient List</h1>
                        <button onclick='PostRequestFromIngredientList()' value='submit'>Edit</button>
                        <button onclick='DeleteIngredientFromList()' value='submit'>Delete</button>
                            <table id='data'>

                                <tr>
                                    <th>Ingredient</th>
                                    <th>Quantity</th>
                                </tr>
    <?php
        $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
        $dbUsername = "ProjectUser";
        $dbPassword = "12345";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT ingredientName, quantity FROM ingredients WHERE userID = '$_SESSION[currentUser]'");
            $stmt->execute();


            if($stmt->rowCount() > 0){

                    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //                $queriedUsername = $row['username'];
    //                $queriedPassword = $row['password'];
    //                print_r($row);
    //                print_r($row[0]['username']);
                    foreach($row as $userRow){
                        echo "  <tr>
                                    <td class='ingredientName'>" . $userRow["ingredientName"] . "</td>
                                    <td class='quantity'>" . $userRow["quantity"] . "</td>
                                </tr>";
                    }
            }

            }
        catch(PDOException $e)
            {

            }

    ?>      
            </table>
        </div>
    </body>
</html>

