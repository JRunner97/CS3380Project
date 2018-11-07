<?php

    echo "<!DOCTYPE  html>
            <html lang='en'>
                <head>
                    <title>CS3380 Project | User List</title>
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
                            <button class='dropbtn'>Pages 
                                <i class='fa fa-caret-down'></i>
                            </button>
                            <div class='dropdown-content'>
                                <a href='/CS3380Project/User/createUser.html'>Create User</a>
                                <a href='/CS3380Project/User/userList.php'>User List</a>
                            </div>
                        </div> 
                        <a href='#home' class='links'>Home</a>
                        <a href='#news' class='links'>News</a>
                    </div>
        
                    <img id='contentBackground' src='https://mizzoumag.missouri.edu/wp-content/uploads/2013/11/quad_web.jpg'>
        
                    <div id='editUserBox'>
        
                        <h1 class='boxHeader'>Edit User</h1>
                        <form action='updateUser.php' method='post' id='updateUserForm'>
                        
                        ";
                        

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);
    }

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "cs12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT id, username, password, email, ssn, date_of_birth, first_name, last_name FROM users WHERE username = '$username'");
        $stmt->execute();

        //so we can use name->value pairs
        if($stmt->rowCount() > 0){
         
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $queriedId = $row['id'];
                $queriedUsername = $row['username'];
                $queriedPassword = $row['password'];
                $queriedEmail = $row['email'];
                $queriedSsn = $row['ssn'];
                $queriedDateOfBirth = $row['date_of_birth'];
                $queriedFirstName = $row['first_name'];
                $queriedLastName = $row['last_name'];
            
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
                
                <div id='ssnBox'>
                    <label for='ssn'>Social Security #: </label>
                    <br>
                    <input id='ssn' type='password' name='ssn' value='" . $queriedSsn . "'>
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



echo "       </form>  
        </div>
    </body>
</html>";

?>