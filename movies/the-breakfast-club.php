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
      <link rel="stylesheet" href="../bootstrap-4.0.0/css/bootstrap.min.css" /> <!--if you downloaded bootstrap to your computer -->
      <link rel="stylesheet" href="../styles/main.css">
        <link rel="stylesheet" href="../styles/movie-page.css">
  
      <!-- required scripts for IE --> 
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
            
      <title>MovieFinder</title>
          
    </head>
  
    <body>
        <?php session_start(); ?>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
      <script src="../bootstrap-4.0.0/js/bootstrap.min.js"></script>
     <nav class="navbar navbar-expand-md bg-custom-header navbar-dark">
        <a class="navbar-brand" href="../home.html">
          <img src="../images/faces.png" id="logo_image" alt="image showing logo" class="img-responsive"><!--</br>-->
          <span id="logo-text">MovieFinder</span>
          </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">   
          <ul class="nav flex-column">
          <?php 
                        if(isset($_SESSION['user'])) {
                          echo '
                          <li class="nav-item">
                              <a class="nav-link" id="nav-link-login" href="http://localhost:4200">Home</a>
                          </li>                                     
                          <li class="nav-item"> 
                              <a class="nav-link" id="nav-link-login" href="profile.php">Profile</a>
                          </li>
                          ';
                        }
                        else{
                          echo '
                          <li class="nav-item">
                              <a class="nav-link" id="nav-link-login" href="login.php">Login</a>
                          </li>                                     
                          <li class="nav-item"> 
                              <a class="nav-link" id="nav-link-login" href="register.php">Sign Up</a>
                          </li>
                          ';
                        }
                        ?>
          </ul>
        </div>  
      </nav>
  
          <div class="movie-results-container" style="display:block">
              <h1 id="search-title" style="margin-left:10px;margin-top:10px;">The Breakfast Club (1985)</h1>  
              <div class="movie-item" style="display:block">
                <img src = "../images/movie-placeholder.png" id="movie-result" alt="image showing logo" class="img-responsive" style="float:left">
                <span id="movie-info" style="float:left">
                  <div >
                    <a>Synopsis: </a></br>
                    <a>Starring: Molly Ringwald, Emilio Estevez, Anthony Michael Hall, Judd Nelson</a>, etc</br>
                    <a>Director: John Hughes</a></br>
                    <a>Score: 79%</a> </br>
                    <a>Comedy, Drama</a></br>                                  
                  </div>
                  
                </span>
              </div>
              
          </div>   
       
    </body>
  </html>