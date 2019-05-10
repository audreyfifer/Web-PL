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
        <link rel="icon" href="images/favicon.ico" type="image/ico">
  
  <title>Register</title>    
</head>
<body>
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
  <div class="container">
            <h1 id="register-title">Register</h1>   
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" name="registerform" class="form-container" >
                <div class="register-form-group">
                     <label for="firstname" id="firstname" >First Name</label>
                    <input type="text" id="firstname-input" class="form-control input-sm" placeholder="Enter First Name" name="firstname" >      
                </div>
                <div class="register-form-group">
                    <label for="lastname" id="lastname" >Last Name</label>
                    <input type="text" id="lastname-input" class="form-control input-sm" placeholder="Enter Last Name" name="lastname" >
                </div>
                <div class="register-form-group" >
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

<?php session_start(); // make sessions available ?> 
<?php 

if (isset($_POST['btnaction']))
{	
   try 
   { 	
      switch ($_POST['btnaction']) 
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
/** insert data **/
function insertData()
{
	require('connect-db.php');
    
    $result = $db->query("SHOW TABLES LIKE 'user_info'");
    $tableExists = ($result !== false) && ($result->rowCount() > 0);
	if(!$tableExists){
        createTable();
    }
    
    $firstname = "";
    $lastname = "";
    $username = "hello123";
    $psw = "yolo";
    $confirm_psw = "yolo";
    $user_in_db = true;
    
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST['firstname'])
        {
            $firstname= $_POST['firstname'];
        }
        if($_POST['lastname'])
        {
            $lastname = $_POST['lastname'];
        }
     	
        $username = $_POST['username'] ;
        $psw = $_POST['psw'];
        $psw_confirm = 	$_POST['psw-confirm'];
        
        $db_grab = $db->query("select Username from user_info where Username='$username'");
        $user_in_db =  ($db_grab !== false) && ($db_grab->rowCount() > 0);  

        if ($psw!=$psw_confirm && !empty($_POST['username'] )){
            echo "<script type='text/javascript'>alert('passwords must be the same');</script>";
        }
        if ($user_in_db && !empty($_POST['username'] )){
            echo "<script type='text/javascript'>alert('username already exists. pick another');</script>";
        }   
     }
    
     if($psw==$psw_confirm && !$user_in_db){
        $query = "INSERT INTO user_info (FirstName, LastName, Username, Pw) 
                    VALUES (:firstname, :lastname, :username, :psw)";
    
        $statement = $db->prepare($query);
        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':psw', $psw);
        $statement->execute();
        $statement->closeCursor();

        setSessionVariables($username,$psw);
        header("Location: profile.php");
     }
	
}
?>
<?php 
function setSessionVariables($user, $psw){
    $_SESSION['user'] = $user;
    $_SESSION['psw'] = $psw;
    setcookie("username","");
    setcookie("psw","");
    
    $jsonString = file_get_contents('C:/xampp/htdocs/Web-PL/angular/src/assets/logged_in.json');
    $data = json_decode($jsonString, true);
    $data[0]['logged_in'] = "true";
    $newJsonString = json_encode($data);
    file_put_contents('C:/xampp/htdocs/Web-PL/angular/src/assets/logged_in.json', $newJsonString);
}
?>


</body>
</html>