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
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css" /> <!--if you downloaded bootstrap to your computer -->
    
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/movie-results.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
    <script src="bootstrap-4.0.0/js/bootstrap.min.js"></script>

    <!-- required scripts for IE --> 
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
          <!--old color=354753-->
          
    <title>MovieFinder</title>
    <style>
      .search-criteria-item-button{
    color:#fff;
    background-color: #859097;
    font-size: 75%;
    border-width: 1px;
    border-style:solid;
    border-color:rgba(255,255,255,.5);
    padding-left:10px;
    padding-top: 0px;
    padding-bottom: 0px;
    padding-right: 10px;
    margin-right:10px;
    margin-bottom:0px;
    margin-top:0px;
    border-radius:5px;
}
      </style>
  </head>

  <body onload="loadMovies()">
  <?php session_start();?>
    
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
    
        <div class="movie-results-container" id="movie-results-container" style="display:block">
        <span >    
        <h1 id="search-title" style="margin-left:10px;margin-top:10px;padding:0px;margin-right:auto;float:left">Search Results</h1>           
</span>
        <span style="margin-left:10px;margin-top:11px;padding:0px;margin-right:auto;float:left">
        <?php
          if(isset($_GET['title'])) {
              echo '<button type="button" class="search-criteria-item-button">'. 'x '. $_GET['title']. '</button>';
          }
          if(isset($_GET['genre'])) {
            echo '<button type="button" class="search-criteria-item-button">'. 'x '. $_GET['genre']. '</button>';
          }
          if(isset($_GET['releaseDate'])) {
            echo '<button type="button" class="search-criteria-item-button">'. 'x '. $_GET['releaseDate']. ' </button>';
          }
          if(isset($_GET['rating'])) {
            echo '<button type="button" class="search-criteria-item-button">'. 'x Rated '. $_GET['rating']. '</button>';
          }
          if(isset($_GET['duration'])) {
            echo '<button type="button" class="search-criteria-item-button">'. 'x '. $_GET['duration']. 'minutes</button>';
          }
          if(isset($_GET['actors'])) {
            echo '<button type="button" class="search-criteria-item-button">'. 'x '. $_GET['actors']. '</button>';
          }
          if(isset($_GET['directors'])) {
            echo '<button type="button" class="search-criteria-item-button">'. 'x '. $_GET['directors']. '</button>';
          }
        
          ?>
          
      </span>  
      </div>

        <nav aria-label="Page navigation example" style="clear:both; margin-top:10%">
            <ul class="pagination justify-content-center">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
                </li>
            </ul>
            </nav>

        <script>
          // loads movies as html elements from movie list when page is loaded from search page
            function loadMovies(){
              
              // finds root element for movies to be added to
              var container = document.getElementById("movie-results-container");
              
              // loops through all movies in movie list, creating separate movie html elements
              var i;
              for (i=0;i<movies.length;i++){
              
                // creates div for movie description
                var divMovie = document.createElement('div');
                var m = movies[i];
                var actors = arrayToString(m.actors);
                var directors = arrayToString(m.directors);
                var genre = arrayToString(m.genre);

                // creates an array of words within the movie title
                var parseName = m.title.split(" ");

                // converts the title to the form: the-name-of-the-movie
                // converted name will be used as the id for the movie item, and used in the link to its personal page
                var parsedName = "";
                  for(j = 0; j < parseName.length; j++) {
                      parsedName += parseName[j].toLowerCase();
                      if (j<parseName.length-1){
                        parsedName += "-";
                      }
                  }
                
                // creates span item so that the title can be clickable
                spanName = document.createElement('span');
                spanName.id = parsedName;
                spanName.style="cursor:pointer;color:#007bff;";
                spanName.innerHTML = m.title;

                // creates span item for the rest of the movie display text
                spanRest = document.createElement('span');
                spanRest.innerHTML = " (" + m.year + ") - " + m.score + "</br>" + "Actors: " + actors + "</br>Directors: " + directors + "</br>Genre: " + genre;

                // adds the title and the rest of the movie information to the parent element           
                divMovie.appendChild(spanName);
                divMovie.appendChild(spanRest);
                
                // span including movie description display
                var span = document.createElement('span');
                span.id = "movie-info";
                span.style = "float:left";
                span.appendChild(divMovie);

                
                // creates image element of movie poster
                var img = document.createElement('img');
                
                // uses default movie image
                img.src = "images/"+  parsedName + ".jpg";
                img.id = "movie-result";
                img.alt = "image showing movie poster";
                img.class="img-responsive";
                img.style="float:left; height:6%; width: 6%;";

                
                // check for the user to be logged in before showing the Add to My Movies button
                var logged_in = checkCookie();
                var a = document.createElement('a');
                if(logged_in){
                  // link html object for adding movies to My Movies
                  a.style = "float:right; margin-right:5%";
                  a.href = "my-movies.php";
                  
                  // appends image to link object                
                  var btn = document.createElement('img');
                  btn.src = "images/add-to-my-movies-button.png";
                  btn.style="height:50%; width:50%; border-radius:8px;float:right;margin-right:10%; margin-top:5%";
                  a.appendChild(btn);
                
                }
                
                
                
                // creates movie item container for housing the movie image, movie description, and add-movie button
                var divMovieItem = document.createElement('div');
                divMovieItem.class="movie-item";
                divMovieItem.style="display:block; clear:both; padding-top: 2%; padding-left: 5%;";

                divMovieItem.appendChild(img);
                divMovieItem.appendChild(span);
                if(logged_in){
                  divMovieItem.appendChild(a);
                }
                

                // appends movie item to the parent element
                container.appendChild(divMovieItem);

                // creates an event listener for navigating to personal movie page when clicking on the title
                document.getElementById(parsedName).addEventListener("click", (function(){
                    window.location.href = "movies/" + this.id + '.php';
                }), false); 
              }


            }

            // input: string array
            // output: string with array elements separated with commas and spaces
            function arrayToString(array){
              var str = "";
              var i;
              for (i = 0; i < array.length; i++){
                if (i==array.length-1){
                  str += array[i];
                }
                else {
                  str += array[i] + ", ";
                }
              }
              return str;
            }

            function checkCookie(){
              var logged_in = 
              "<?php 
                if(isset($_SESSION['user'])){
                  echo true;
                }
                ?>";
              return logged_in;
            }
            
            // list of example movies to be displayed dynamically
            var movies=[
            {
              title: "The Patriot",
              year: "2000",
              actors: ["Mel Gibson", "Heath Ledger", "Joely Richardson", "Jason Isaacs"],
              directors: ["Roland Emmerich"],
              score: "72%",
              genre: ["Action", "Drama", "History"],
              rating: "R",
              duration: "165",
              synopsis: "Peaceful farmer Benjamin Martin is driven to lead the Colonial Militia during the American Revolution when a sadistic British officer murders his son."
            },
            {
              title: "The Godfather",
              year: "1972",
              actors: ["Marlon Brando", "Al Pacino", "James Caan", "Robert Duvall"],
              directors: ["Francis Ford Coppola"],
              score: "92%",
              genre: ["Crime", "Drama"],
              rating: "R",
              duration: "175",
              synopsis: ""
            },
            {
              title: "Mulan",
              year: "1998",
              actors: ["Miguel Ferrer", "Eddie Murphy", "Lea Salonga"],
              directors: ["Tony Bancroft", "Barry Cook"],
              score: "76%",
              genre: ["Animation", "Adventure", "Family"],
              rating: "G",
              duration: "88",
              synopsis: ""
            },
            {
              title: "Edward Scissorhands",
              year: "1990",
              actors: ["Johnny Depp", "Winona Ryder", "Dianne Wiest", "Anthony Michael Hall"],
              directors: ["Tim Burton"],
              score: "79%",
              genre: ["Drama", "Fantasy", "Romance"],
              rating: "PG-13",
              duration: "105",
              synopsis: ""
            },
            {
              title: "The Breakfast Club",
              year: "1985",
              actors: ["Molly Ringwald", "Emilio Estevez", "Anthony Michael Hall", "Judd Nelson"],
              directors: ["John Hughes"],
              score: "79%",
              genre: ["Comedy", "Drama"],
              rating: "R",
              duration: "97",
              synopsis: ""
            }
            ];
            
            
        </script>
  </body>
</html>