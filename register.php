<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css" /> <!--if you downloaded bootstrap to your computer -->
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/login.css">
        <title>Register</title>    
    </head>
    <body>

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

        <div class="container">
            <h1>Register</h1>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
                <input type="submit" name="btnaction" value="create" class="btn btn-light" />

                <input type="submit" name="btnaction" value="register" class="btn btn-light" />   
                          
            </form>

            <?php 
    if (isset($_GET['btnaction']))
    {	
        try 
        { 	
            switch ($_GET['btnaction']) 
            {
                case 'create': createTable(); break;
                case 'register': insertData();  break;
                      
            }
        }
        catch (Exception $e)       // handle any type of exception
        {
            $error_message = $e->getMessage();
            echo "<p>Error message: $error_message </p>";
        }   
    }
            ?>



            <?php
            // require('connect-db.php');

            // require: if a required file is not found, require() produces a fatal error, the rest of the script won't run
            // include: if a required file is not found, include() throws a warning, the rest of the script will run
            ?>


            <?php 
            /*************************/
            /** create table **/
            function createTable()
            {
                require('connect-db.php');

                //    $query = "CREATE TABLE `web4640`.`courses` ( 
                //              `courseID` VARCHAR(8) PRIMARY KEY, 
                //              `course_desc` VARCHAR(20) NOT NULL )";
                $query = "CREATE TABLE user-info (firstName VARCHAR(30) PRIMARY KEY,lastName VARCHAR(30) NOT NULL )";

                $statement = $db->prepare($query);
                $statement->execute();   
                $statement->closeCursor();
            }
            ?>


           

            <?php 
            /*************************/
            /** insert data **/
            function insertData()
            {
                require('connect-db.php');

                $firstname = "newFN_from_insertData";
                $lastname = "newLN_from_insertData";
               // $username = "newUN_from_insertData";
                //$password = "newPW_from_insertData";

                $query = "INSERT INTO user-info (FirstName, LastName) VALUES (:firstname, :lastname)";
                $statement = $db->prepare($query);
                $statement->bindValue(':firstname', $firstname);
                $statement->bindValue(':lastname', $lastname);
               // $statement->bindValue(':username', $username);
                //$statement->bindValue(':password', $password);
                $statement->execute();
                $statement->closeCursor();
            }
            ?>


            

        </div>
    </body>
</html>