<!DOCTYPE  html>
<html lang="en">

    <head>
    
        <title>CS3380 Project | Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="Styles/project.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script> 
    </head>
    
    

    <body id="loginBody">
        <div class="navbar">
            <a>
                <img src="https://engineering.missouri.edu//wp-content/themes/g5plus-orion/assets/images/missouri-logo.svg">
            </a>
            <div class="dropdown">
                <button class="dropbtn">Pages 
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="/CS3380Project/User/createUser.html">Create User</a>
                    <a href="/CS3380Project/User/userList.php">User List</a>
                </div>
            </div> 
            <a href="#home" class="links">Home</a>
            <a href="#news" class="links">News</a>
        </div>
        
        <img id="contentBackground" src="https://mizzoumag.missouri.edu/wp-content/uploads/2013/11/quad_web.jpg">
        
        <div id="formContainer">

            <h1 class="boxHeader">CS3380 Project Login</h1>

            <form id="loginForm" action="login.php" method="post" data-parsley-validate>
                
                <input type="hidden" name="action" value="do_login">

                <input type="text" id="username" name="user" placeholder="Username" autofocus data-parsley-required 	data-parsley-length="[6, 30]">
                <br>
                <input type="password" id="password" name="password" placeholder="Password" data-parsley-required data-parsley-length="[6, 30]" >

                <button id="loginButton" type="submit" form="loginForm" class="button" value="Submit">Sign In</button>
            </form>

        </div>
    
    </body>
</html>
