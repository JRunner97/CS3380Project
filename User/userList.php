<!DOCTYPE  html>
    <html lang='en'>
        <head>
            <title>CS3380 Project | User List</title>
            <meta charset='utf-8'>
            <link rel='stylesheet' type='text/css' href='../Styles/project.css'>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js'></script>
            <script src='../Scripts/userList.js'></script>

        </head>
        <body id='userListBody'>
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

            <div id='userListBox'>

                <h1 class='boxHeader'>User List</h1>
                <button onclick='PostRequestFromUserList()' value='submit'>Edit</button>
                <button onclick='DeleteUserFromList()' value='submit'>Delete</button>
                    <table id='data'>

                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                        </tr>
<?php
    $servername = "ec2-18-218-134-37.us-east-2.compute.amazonaws.com";
    $dbUsername = "ProjectUser";
    $dbPassword = "12345";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=CS3380", $dbUsername, $dbPassword);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT username, email, DOB FROM users");
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
                                <td class='date_of_birth'>" . $userRow["DOB"] . "</td>
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