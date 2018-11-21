<?php	
	
    if(!session_start()){
        header("Location: error.php");
        exit;
    }
    // see if user is already logged in
    $loggedin = empty($_SESSION['currentUser']) ? '' : $_SESSION['currentUser'];
    
    // If the user is logged in, redirect them home
    if ($loggedin) {
        header("Location: Ingredient/ingredientList.php");
        exit;
    }
    
	$action = empty($_POST['action']) ? '' : $_POST['action'];
	
	if ($action == 'do_login') {
		handle_login();
	} else {
		login_form();
	}
	
	function handle_login() {
		$username = empty($_POST['user']) ? '' : htmlspecialchars($_POST['user']);
		$password = empty($_POST['password']) ? '' : htmlspecialchars($_POST['password']);
        
        
        $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
        $dbUsername = "ProjectUser";
        $dbPassword = "12345";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("SELECT userID, username, pword FROM users WHERE username = '$username' AND pword = '$password'");
            $stmt->execute();

            //so we can use name->value pairs
            if($stmt->rowCount() > 0){
                /*  how to get data from query*/
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $_SESSION["currentUser"] = $row['userID'];
                header("Location: Ingredient/ingredientList.php");
                exit;
            }
            else {
                $error = 'Error: Incorrect username or password';
                require "loginForm.php";
            }
            }
        catch(PDOException $e)
            {
                $error = 'Error: PDO exception';
                require "loginForm.php";
            }	
	}
	
	function login_form() {
		$error = "";
		require "loginForm.php";
	}
	
	
?>