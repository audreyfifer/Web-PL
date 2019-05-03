<!--Audrey Fifer (aef3ha)
Bittania Teshome (bt9nd)
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" /> -->  
        <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css" /> <!--if you downloaded bootstrap to your computer -->
        <link rel="stylesheet" href="styles/main.css">

        <!-- required scripts for IE --> 
        <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

        <title>MovieFinder</title>

    </head>

    <body>

        <?php session_start(); ?>
        <?php 
        if(!isset($_SESSION['user'])){
            header('Location: login.php');
        }
        ?>



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
        <script src="bootstrap-4.0.0/js/bootstrap.min.js"></script>
        <nav class="navbar navbar-expand-md bg-custom-header navbar-dark">
            <a class="navbar-brand" href="http://localhost:4200">
                <img src="images/faces.png" id="logo_image" alt="image showing logo" class="img-responsive"><!--</br>-->
                <span id="logo-text">MovieFinder</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">   
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" id="nav-link-login" href="login.php">Login</a>
                    </li>                                     
                    <li class="nav-item"> 
                        <a class="nav-link" id="nav-link-signup" href="register.php">Sign Up</a>
                    </li>
                </ul>
            </div>  
        </nav>


        <script type="text/javascript">
            alert("You've successfully logged out");
            window.location.href='login.php';
        </script>
        
        
<?php
// Set session variables can be removed by specifying their element name to unset() function.
// A session can be completely terminated by calling the session_destroy() function.

// Check if any session variables are set and retrieve all stored names and values
if (count($_SESSION) > 0)
{   
   foreach ($_SESSION as $key => $value)
   {
      // Deletes the variable (array element) where the value is stored in this PHP.
      // However, the session object still remains on the server.   
      if($key!='logged_in'){ 	
        unset($_SESSION[$key]);
      }
      else{
        $_SESSION[$key]=false;
      }
   }      
   session_destroy();     // complete terminate the session
   $jsonString = file_get_contents('C:/xampp/htdocs/Web-PL/angular/src/assets/logged_in.json');
    $data = json_decode($jsonString, true);
    $data[0]['logged_in'] = "false";
    $newJsonString = json_encode($data);
    file_put_contents('C:/xampp/htdocs/Web-PL/angular/src/assets/logged_in.json', $newJsonString);
}
?>


    </body>
</html>