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
   <!--   <input type="submit" name="btnaction" value="create" class="btn btn-light" /> -->
      
     <!-- <input type="submit" name="btnaction" value="select" class="btn btn-light" />
      <input type="submit" name="btnaction" value="update" class="btn btn-light" />
      <input type="submit" name="btnaction" value="delete" class="btn btn-light" />
      <input type="submit" name="btnaction" value="drop" class="btn btn-light" />    -->  
        
         <div class="login-container">
                <div class="row justify-content-center">
                    <!--
                    <div class="col-md-4">
                        <img src="images/login-profile.png" alt="login profile image" class="login-profile">
                    </div>
                    -->

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
                    <input type="submit" name="btnaction" value="register" class="btn btn-light" />   
                    </div>
             </div>
    </form>

<?php 
if (isset($_GET['btnaction']))
{	
   try 
   { 	
      switch ($_GET['btnaction']) 
      {
      //   case 'create': createTable(); break;
         case 'register': insertData();  break;
      //   case 'select': selectData();  break;
    //     case 'update': updateData();  break;
      //   case 'delete': deleteData();  break;
        // case 'drop':   dropTable();   break;      
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

// require: if a required file is not found, reqire() produces a fatal error, the rest of the script won't run
// include: if a required file is not found, include() thorws a warning, the rest of the script will run
?>


<?php  
/*************************/
/** get data **/
function selectData()
{

	
	
	
	
	
	
	
	
	
}
?>

<?php 
/*************************/
/** create table **/
function createTable()
{
 
    require('connect-db1.php');
    
    $query = "CREATE TABLE courses (courseID VARCHAR(8) PRIMARY KEY, course_desc VARCHAR(20) NOT NULL)";
    $query = "CREATE TABLE clients (courseID VARCHAR(8) PRIMARY KEY, course_desc VARCHAR(20) NOT NULL)";
    
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
	
	
	
	
	
	
	
	
	
}
?>


<?php 
/*************************/
/** drop table **/
function dropTable()
{
  
	require('connect-db1.php');
    
    $query = "DROP TABLE courses";
    
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
   
	
	require('connect-db1.php');
    
    $course_id = "hi";
    $course_desc = "bye";
    //$firstname = "joe";
   // $lastname = "bob";
   // $username = "joe123";
    //$password = "yolo";
    
    $query = "INSERT INTO clients (courseID, course_desc) VALUES (:course_id, :course_desc)";
   // $query = "INSERT INTO clients (FirstName, LastName) VALUES (:firstname, :lastname)";
   // $query = "INSERT INTO users (FirstName, LastName, Username, Password) VALUES (:firstname, :lastname, :username, :password)";
    $statement = $db->prepare($query);
    $statement->bindValue(':course_id', $course_id);
    $statement->bindValue(':course_desc', $course_desc);
    //$statement->bindValue(':firstname', $firstname);
    //$statement->bindValue(':lastname', $lastname);
    //$statement->bindValue(':username', $username);
    //$statement->bindValue(':password', $password);
    $statement->execute();
    $statement->closeCursor();
	
	
	
	
	
	
}
?>


<?php
/*************************/
/** update data **/
function updateData()
{
  
	
	
	
	
	
	
	
	
	
}
?>

<?php
/*************************/
/** delete data **/
function deleteData()
{
	
	
	
	
	
	
	
	
	
	
}
?>



</body>
</html>