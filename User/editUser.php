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
            <title>CS3380 Project | Edit User</title>
            <meta charset='utf-8'>
            <link rel='stylesheet' type='text/css' href='../Styles/project.css'>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js'></script>

        </head>
        <body id='editUserBody'>
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

            <div id='editUserBox'>

                <h1 class='boxHeader'>Edit User</h1>
                <form action='updateUser.php' method='post' id='updateUserForm'>
                        
                        
                        
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
    }

    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT userID, username, pword, email, DOB, fName, lName FROM users WHERE username = '$username'");
        $stmt->execute();

        //so we can use name->value pairs
        if($stmt->rowCount() > 0){
         
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $queriedId = $row['userID'];
                $queriedUsername = $row['username'];
                $queriedPassword = $row['pword'];
                $queriedEmail = $row['email'];
                $queriedDateOfBirth = $row['DOB'];
                $queriedFirstName = $row['fName'];
                $queriedLastName = $row['lName'];
            
                echo " <label for='name'>Name:</label>
                
                <br>
                <input type='hidden' name='id' value='" . $queriedId . "'>
                
                <input id='name' type='text' name='first_name' value='" . $queriedFirstName . "' placeholder='First'> 
                <input type='text' name='last_name' value='" . $queriedLastName . "' placeholder='Last'>
                
                <br>
                
                <div class='side-by-side'>
                    <label for='username'>Username:</label>
                    <br>
                    <input id='username' type='text' name='username' value='" . $queriedUsername . "' placeholder='Username' data-parsley-required data-parsley-length='[6, 30]'>
                </div>
                
                <div class='side-by-side'>
                    <label for='password'>Password:</label>
                    <br>
                    <input id='password' type='password' name='password' value='" . $queriedPassword . "'  placeholder='Password' data-parsley-required data-parsley-length='[6, 30]'>
                </div>
                
                <br>
                
                <div class='side-by-side'>
                    <label for='email'>Email:</label>
                    <br>
                    <input id='email' type='email' name='email' value='" . $queriedEmail . "'  placeholder='example@gmail.com' data-parsley-required data-parsley-length='[6, 30]'>
                </div>
                
                <div class='side-by-side'>
                    <label for='date_of_birth'>Date of Birth:</label>
                    <br>
                    <input id='date_of_birth' type='date' value='" . $queriedDateOfBirth . "' name='date_of_birth'>
                </div>
            
                <button id='newUserButton' type='submit' form='updateUserForm' class='button' value='Submit'>Update User</button> ";
           
        }
        else {
            print_r("invalid credentials");
        }
        

        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }

?>
            </form>  
        </div>
    </body>
</html>