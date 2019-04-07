 <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {	   
            if (strlen($_POST['title']) > 0)
            {
                header('Location: movie-results.php');
            }
        }
        ?>

        <?php
        // Define a function to handle failed validation attempts
        function reject($entry)
        {
            //echo 'Please <a href="login.php">Log in </a>';
            // exit the current script, no value is returned
            header("Location: home.php");
        }
        $title="";
        $genre=$release=$rating=$duration=$actors=$directors="";
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {

            if(isset($_POST['title']))
                $title = trim($_POST['title']);
            if(isset($_POST['genre']))
                $genre = trim($_POST['genre']);
            if(isset($_POST['release']))
                $release = trim($_POST['release-date']);
            if(isset($_POST['rating']))
                $rating = trim($_POST['rating']);
            if(isset($_POST['duration']))
                $duration = trim($_POST['duration']);
            if(isset($_POST['actors']))
                $actors = trim($_POST['actors']);
            if(isset($_POST['directors']))
                $directors = trim($_POST['directors']);
            //if(strlen($title)==0 && strlen($genre)==0 && strlen($release)==0 && strlen($rating)==0 && //strlen($duration)==0 && strlen($actors)==0 && strlen($directors)==0 ){
            //    echo 'please enter search criteria';
            //}
            $tagged = false;
            if(!preg_match('/^[0-9]+$/',$duration)){
                $tagged=true;
                
            }
            if(!preg_match('/^([\t\s]*([12][0-9]{3}[s]?|[12][0-9]{3}\'s|[12][0-9]{3}-[12][0-9]{3}|[0-9]{1}0s|[0-9]{1}0\'s)[\t\s]*)$/',$release)){
                $tagged = true;
                echo '<script type="text/javascript">document.getElementById("release-date-note").innerHTML = "Please enter date in one of the following formats: 1990, 1990-2000, 1990s, 1990\'s, 90s, 90\'s";
                </script>';
            }
            if(!$tagged){
                header("Location: movie-results.php");
            }

        }
        else {
            //header("Location: movie-results.php");
        }


        ?>