<?php

    echo "<!DOCTYPE  html>
            <html lang='en'>
                <head>
                    <title>CS3380 Project | User List</title>
                    <meta charset='utf-8'>
                    <link rel='stylesheet' type='text/css' href='project.css'>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js'></script>
                    
                </head>
                <body>
                    <div id='topbar'>
                        <img src='https://engineering.missouri.edu//wp-content/themes/g5plus-orion/assets/images/missouri-logo.svg'>
                    </div>
        
                    <img id='contentBackground' src='https://mizzoumag.missouri.edu/wp-content/uploads/2013/11/quad_web.jpg'>
        
                    <div id='userListBox'>
        
                        <h1 class='boxHeader'>User List</h1>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = htmlspecialchars($_POST['username']);

        echo $username;
    }

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "cs12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = '$username' AND password = '$password'");
        $stmt->execute();

        //so we can use name->value pairs
        if($stmt->rowCount() > 0){
            /*  how to get data from query
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $queriedUsername = $row['username'];
                $queriedPassword = $row['password'];
            */
           
        }
        else {
            print_r("invalid credentials");
        }
        
        
        

        }
    catch(PDOException $e)
        {
        echo "Connection failed: " . $e->getMessage();
        }



echo "         
        </div>
    </body>
</html>";

?>