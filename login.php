<!--Audrey Fifer (aef3ha)
Bittania Teshome (bt9nd)
-->




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css" /> <!--if you downloaded bootstrap to your computer -->
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/login.css">

        <!-- required scripts for IE --> 
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

        <title>MovieFinder</title>

    </head>


    <body>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {	   
            if (strlen($_POST['username']) > 0)
            {
                header('Location: profile.php');
            }
        }
        ?>

        <?php
        // Define a function to handle failed validation attempts
        function reject($entry)
        {
            //    echo 'Please <a href="login.php">Log in </a>';
            exit();    // exit the current script, no value is returned
        }

        if ($_SERVER['REQUEST_METHOD'] == "POST" && strlen($_POST['username']) > 0)
        {
            $user = trim($_POST['username']);
            if (!ctype_alnum($user))   // ctype_alnum() check if the values contain only alphanumeric data
                reject('User Name');

            if (isset($_POST['psw']))
            {
                $psw = trim($_POST['psw']);
                if (!ctype_alnum($psw))
                    reject('Password');
                else
                {
                    // setcookie(name, value, expiery-time)
                    // setcookie() function stores the submitted fields' name/value pair
                    //setcookie('user', $user, time()+3600);
                    // setcookie('psw', md5($psw), time()+3600);  // create a hash conversion of password values using md5() function
                    $_SESSION['user'] = $user;
                    $_SESSION['psw'] = $psw;
                    // redirect the browser to another page using the header() function to specify the target URL
                    header('Location: profile.php');
                }
            }
            if($_POST['remember']) {
                setcookie('remember_me', $_POST['username'], time() + 3600);
            }
            elseif(!$_POST['remember']) {
                if(isset($_COOKIE['remember_me'])) {
                    $past = time() - 100;
                    setcookie(remember_me, gone, $past);
                }
            }

        }
        ?>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
        <script src="bootstrap-4.0.0/js/bootstrap.min.js"></script>
        <nav class="navbar navbar-expand-md bg-custom-header navbar-dark">
            <a class="navbar-brand" href="home.html">
                <img src="images/faces.png" id="logo_image" alt="image showing logo" class="img-responsive"><!--</br>-->
                <span id="logo-text">MovieFinder</span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">   
                <a class="nav-link" id="nav-link-home" href="home.html">Home</a>
            </div>  
        </nav>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST"  name="loginform" class="form-container-login" >

            <div class="login-container">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <img src="images/login-profile.png" alt="login profile image" class="login-profile">
                    </div>

                </div>
                <div class="row justify-content-center" >

                    <div class="col-md-4">
                        <label for="username" id="username" ><b>Username</b></label>
                        <input type="text" id="username-input" placeholder="Enter Username" name="username" required>
                    </div> 

                </div>
                <div class="row justify-content-center" style="margin-top:1%;">
                    <div class="col-md-4">
                        <label for="psw" id="psw"><b>&nbspPassword</b></label>
                        <input type="password" id="psw-input" placeholder="Enter Password" name="psw" required>
                    </div>

                </div>
                <div class="row justify-content-center" >
                    <div class="col-md-4">
                        <input type="submit" value="Login" class="btn btn-light"  />
                        
                       <input type="checkbox" name="remember" <?php if(isset($_COOKIE['remember_me'])) {
    echo 'checked="checked"';
}
              else {
                  echo '';
              }
                               ?> >Remember Me

                        <!-- uses anonymous function-->
                        <!--
<input type="button" class="login-button" onclick="(function(){
var psw = document.getElementById('psw-input').value;
var username = document.getElementById('username-input').value;

// if password and username not entered, display appropriate error
if (psw === '' && username === ''){
document.getElementById('login-note').innerHTML = 'Please enter a username and password.';
return;
}

// if only password isn't entered, display appropriate error
if (psw === ''){
document.getElementById('login-note').innerHTML = 'Please enter a password.';
return;
}

// if only username isn't entered, display appropriate error
if (username === ''){
document.getElementById('login-note').innerHTML = 'Please enter a username.';
return;
}

// navigate to profile page if appropriate login information is entered
//location.href='profile.html';

})();" name="login" value='Login'>
-->

                        <!--location.href='loggedin_home.html'-->

                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <span class="error" id="login-note" value="" style="color:red"></span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <a class="psw" a href="#">Forgot password?</a>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <a class="register" a href="#">Don't have an account? Register here.</a>
                    </div>
                </div>
            </div>
        </form>






    </body>
</html>