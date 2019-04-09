<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="bootstrap-4.0.0/css/bootstrap.min.css" /> <!--if you downloaded bootstrap to your computer -->
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/register.css">
  
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
            <h1 id="register-title">Register</h1>   
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get" name="registerform" class="form-container" >
                <div class="register-form-group">
                     <label for="firstname" id="firstname" >First Name</label>
                    <input type="text" id="firstname-input" class="form-control input-sm" placeholder="Enter First Name" name="firstname" >      
                </div>
                <div class="register-form-group">
                    <label for="lastname" id="lastname" >Last Name</label>
                    <input type="text" id="lastname-input" class="form-control input-sm" placeholder="Enter Last Name" name="lastname" >
                </div>
                <div class="register-form-group">
                    <label for="username" id="username" >Username</label>
                    <input type="text" id="username-input" class="form-control input-sm" placeholder="Enter Username" name="username" required>
                </div>
                <div class="register-form-group">
                    <label for="psw" id="psw">Password</label>
                    <input type="password" id="psw-input" class="form-control input-sm" placeholder="Enter Password" name="psw" required>
                </div>
                <div class="register-form-group">
                    <label for="psw-confirm" id="psw-confirm">Confirm Password</label>
                    <input type="password" id="psw-confirm-input" class="form-control input-sm" placeholder="Confirm Password" name="psw-confirm" required>
                </div>
                <div class="register-form-group" >
                    <input type="submit" name="btnaction" value="Register" class="btn btn-light" />   
                </div>
            </form>
        </div>
        <!--
         <div class="login-container">
                <div class="row justify-content-center" >

                    <div class="col-md-4">
                        <label for="firstname" id="firstname" ><b>First Name</b></label>
                        <input type="text" id="firstname-input" placeholder="Enter First Name" name="firstname" >
                    </div> 

                </div>
                <div class="row justify-content-center" >

                    <div class="col-md-4">
                        <label for="lastname" id="lastname" ><b>Last Name</b></label>
                        <input type="text" id="lastname-input" placeholder="Enter Last Name" name="lastname" >
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
                    <input type="submit" name="btnaction" value="register" class="btn btn-light" />   
                    </div>
             </div>
    </form>
-->

<?php 
if (isset($_GET['btnaction']))
{	
   try 
   { 	
      switch ($_GET['btnaction']) 
      {
      //   case 'create': createTable(); break;
         case 'Register': insertData();  break;
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
 
    require('connect-db.php');
    
    $query = "CREATE TABLE user_info (
        FirstName VARCHAR(30) NOT NULL,
        LastName VARCHAR(30) NOT NULL,
        Username VARCHAR(30) PRIMARY KEY, 
        Pw VARCHAR(30) NOT NULL)";
    
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
  
	require('connect-db.php');
    
    $query = "DROP TABLE user_info";
    
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
    
    $result = $db->query("SHOW TABLES LIKE 'user_info'");
    $tableExists = ($result !== false) && ($result->rowCount() > 0);
	if(!$tableExists){
        createTable();
    }
    $firstname = "joe";
    $lastname = "bob";
    $username = "joe123";
    $pwd = "yolo";
    
    $query = "INSERT INTO user_info (FirstName, LastName, Username, Pw) 
                VALUES (:firstname, :lastname, :username, :pwd)";
   
    $statement = $db->prepare($query);
    $statement->bindValue(':firstname', $firstname);
    $statement->bindValue(':lastname', $lastname);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':pwd', $pwd);
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