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
       <link rel="stylesheet" href="styles/profile.css">
       <link rel="icon" href="images/favicon.ico" type="image/ico">
  
      <!-- required scripts for IE --> 
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
            
      <title>MovieFinder</title>
          
    </head>
  
    <body>
    <?php 
    session_start();
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
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">   
                <a class="nav-link" id="nav-link-home" href="http://localhost:4200">Home</a>
            </div>  
        </nav>
    
        <div class="profile-container" style="display:block">
                
            <img src = "images/login-profile.png" id="profile-image-main-screen" alt="image showing logo" class="img-responsive" style="float:left">
            <span id="profile-header" style="float:left">
                <h1 style="margin-top:35%">Profile</h1>
            
                <div style="margin-left:20%; margin-top:20%">
                  <!-- currently only My Movies link navigates to an actual page -->
                    <a href="account-info.php" id="account-info-link">Account Info</a> <br/>
                    <a href="my-movies.php" id="my-movies-link">My Movies</a><br/>
                    <a href="#" id="friends-link">Friends</a><br/>
                    <a href="#" id="history-link">History</a><br/>
                    <a href="#" id="settings-link">Settings</a><br/>
                    <a href="logout-home.php" id="settings-link">Logout</a><br/>
                </div> 
            </span> 
        </div>
    </body>
    </html>