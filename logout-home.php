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



        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
        <script src="bootstrap-4.0.0/js/bootstrap.min.js"></script>
        <nav class="navbar navbar-expand-md bg-custom-header navbar-dark">
            <a class="navbar-brand" href="home.php">
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

       

        <!--Search form for user-->
        <div class="container">
            <h1 id="search-title">Search</h1>   
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" name="mainform" class="form-container" >
                <div class="form-group">
                    <label for="movie-title">Title</label>
                    <input type="text" id="movie-title-input" class="form-control" name="title" />
                    <span class="error" id="movie-title-note" value="" style="color:red"></span>        
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <select name="genre" id="genre" class="form-control" >
                        <option value="select-genre" selected="selected" ></option>
                        <option value="action" >Action</option>  <!-- set default selection -->
                        <option value="adventure">Adventure</option>
                        <option value="animation">Animation</option>
                        <option value="comedy">Comedy</option>
                        <option value="crime">Crime</option>
                        <option value="drama">Drama</option>
                        <option value="family">Family</option>
                        <option value="fantasy">Fantasy</option>
                        <option value="history">History</option>
                        <option value="horror">Horror</option>
                        <option value="romance">Romance</option>
                        <option value="romantic-comedy">Romantic Comedy</option>
                        <option value="suspense-thriller">Suspense/Thriller</option>
                    </select> 
                </div>

                <div class="form-group">
                    <label for="release-date">Release Date Year(s)</label>
                    <input type="text" id="release-date-input" name="release-date" class="form-control" />
                    <span class="error" id="release-date-note" value="" style="color:red"></span>
                </div> 
                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select name="rating" id="rating" class="form-control" >
                        <option value="select-rating" selected="selected" ></option>
                        <option value="rating-g">G</option>  <!-- set default selection -->
                        <option value="rating-pg">PG</option>
                        <option value="rating-pg-13">PG-13</option>
                        <option value="rating-r">R</option>
                        <option value="rating-nr">NR/Unrated</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="duration">Duration (minutes)</label>
                    <input type="text" id="duration-input" name="duration" class="form-control" />
                    <span class="error" id="duration-note" value="" style="color:red"></span>
                </div> 
                <div class="form-group">
                    <label for="actors">Actors</label>
                    <input type="text" id="actors-input" name="actors" class="form-control" />
                    <span class="error" id="actors-note" value="" style="color:red"></span>
                </div>  
                <div class="form-group">
                    <label for="directors">Directors</label>
                    <input type="text" id="directors-input" name="directors" class="form-control" />
                    <span class="error" id="directors-note" value="" style="color:red"></span>
                </div> 

                <div class="search-button-class">
                    <input type="button" id="search-button" value="Search" name="submit" onclick="submitSearch()" />
                </div>
            </form>

        </div>


        <script type="text/javascript">
            alert("You've successfully logged out");

            /* - verifies that:
                1. at least one item is entered to search
                2. release date is in the correct format (1990, 1990-2000, 1990s, 1990's, 90s, 90's) if entered
                3. duration is a positive number 
             - navigates to movie results page if inputs are valid
          */
            function submitSearch() {
                var movie = document.getElementById("movie-title-input").value;
                var release = document.getElementById("release-date-input").value;
                var genre = document.getElementById("genre").value;
                var rating = document.getElementById("rating").value;
                var duration = document.getElementById("duration-input").value;
                var actors = document.getElementById("actors-input").value;
                var directors = document.getElementById("directors-input").value;
                var tagged = false;

                // displays pop-up window if no search criteria is entered
                if (movie === "" && release === "" && genre === "select-genre" && rating === "select-rating" && duration === "" && actors === "" && directors === ""){
                    alert("Please enter search criteria");
                    return;
                }

                // returns true if duration is a positive number
                isValidDuration = (s)=> {return s.match(/^[0-9]+$/);};

                // returns true if date is in correct format -- 1990, 1990-2000, 1990s, 1990's, 90s, 90's
                isValidDate = (s) => {return s.match(/^([\t\s]*([12][0-9]{3}[s]?|[12][0-9]{3}'s|[12][0-9]{3}-[12][0-9]{3}|[0-9]{1}0s|[0-9]{1}0's)[\t\s]*)$/);};

                // displays error for user if date isn't in correct format
                if (release!="" && !isValidDate(release)){
                    document.getElementById("release-date-note").innerHTML = "Please enter date in one of the following formats: 1990, 1990-2000, 1990s, 1990's, 90s, 90's";
                    tagged = true;
                }

                // displays error for user if duration isn't in correct format
                if (duration!="" && !isValidDuration(duration)){
                    document.getElementById("duration-note").innerHTML = "Please enter a non-negative value.";
                    tagged = true;
                }

                // doesn't navigate to results page if at least one error in input
                if (tagged){
                    return;
                }
                window.location.href = 'movie-results.php';
            }

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
      unset($_SESSION[$key]);
   }      
   session_destroy();     // complete terminate the session
}
?>


    </body>
</html>