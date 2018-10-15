<?php

    echo "<!DOCTYPE  html>
            <html lang='en'>
                <head>
                    <title>CS3380 Project | User List</title>
                    <meta charset='utf-8'>
                    <link rel='stylesheet' type='text/css' href='project.css'>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js'></script>
                    <script src='myScript.js'></script>
                    
                </head>
                <body>
                    <div id='topbar'>
                        <img src='https://engineering.missouri.edu//wp-content/themes/g5plus-orion/assets/images/missouri-logo.svg'>
                    </div>
        
                    <img id='contentBackground' src='https://mizzoumag.missouri.edu/wp-content/uploads/2013/11/quad_web.jpg'>
        
                    <div id='userListBox'>
        
                        <h1 class='boxHeader'>User List</h1>
                        <button onclick='PostRequestFromUserList()' value='Submit'>Submit</button>
                            <table id='data'>

                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Date of Birth</th>
                                    <th>Edit</th>
                                </tr>";

    $servername = "localhost";
    $dbUsername = "root";
    $dbPassword = "cs12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT username, email, date_of_birth FROM users");
        $stmt->execute();


        if($stmt->rowCount() > 0){

                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
//                $queriedUsername = $row['username'];
//                $queriedPassword = $row['password'];
//                print_r($row);
//                print_r($row[0]['username']);
                foreach($row as $userRow){
                    echo "  <tr>
                                <td class='username'>" . $userRow["username"] . "</td>
                                <td class='email'>" . $userRow["email"] . "</td>
                                <td class='date_of_birth'>" . $userRow["date_of_birth"] . "</td>
                            </tr>";
                }
        }

        }
    catch(PDOException $e)
        {

        }

echo "         
            </table>
        </div>
    </body>
</html>";

?>