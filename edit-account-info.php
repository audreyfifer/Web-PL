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
  
  <title>MovieFinder</title>    
</head>
<body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
        <script src="bootstrap-4.0.0/js/bootstrap.min.js"></script>
        <?php 
        session_start();
        if(!isset($_SESSION['user'])){
            header('Location: login.php');
        }
        ?>
        <nav class="navbar navbar-expand-md bg-custom-header navbar-dark">
            <a class="navbar-brand" href="http://localhost:4200">
                <img src="images/faces.png" id="logo_image" alt="image showing logo" class="img-responsive"><!--</br>-->
                <span id="logo-text">MovieFinder</span>
            </a>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">   
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" id="nav-link-home" href="http://localhost:4200">Home</a>
                    </li>                                     
                    <li class="nav-item"> 
                        <a class="nav-link" id="nav-link-home" href="profile.php">Profile</a>
                    </li>
                </ul>
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
                <div class="register-form-group">
                    <label for="psw" id="psw">New Password</label>
                    <input type="password" id="psw-input" class="form-control input-sm" placeholder="Enter Password" name="psw" required>
                </div>
                <div class="register-form-group">
                    <label for="psw-confirm" id="psw-confirm">Confirm Password</label>
                    <input type="password" id="psw-confirm-input" class="form-control input-sm" placeholder="Confirm Password" name="psw-confirm" required>
                </div>
                <div class="register-form-group" >
                    <input type="submit" name="btnaction" value="Update Info" class="btn btn-light" />   
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
         case 'Update Info': editData();  break;
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
    $pwd = "yolo";
    $pwd_confirm = "yolo";
    $user_in_db = true;
    
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST['firstname']){
            $firstname= $_POST['firstname'];
        }
        if($_POST['lastname']){
            $lastname = $_POST['lastname'];
        }
     	
        $username = $_POST['username'] ;
        $pwd = $_POST['psw'];
        $pwd_confirm = 	$_POST['psw-confirm'];
        
        $db_grab = $db->query("select Username from user_info where Username='$username'");
        $user_in_db =  ($db_grab !== false) && ($db_grab->rowCount() > 0);  

        if ($pwd!=$pwd_confirm && !empty($_POST['username'] )){
            echo "<script type='text/javascript'>alert('passwords must be the same');</script>";
        }
        if ($user_in_db && !empty($_POST['username'] )){
            echo "<script type='text/javascript'>alert('username already exists. pick another');</script>";
        }  
         
     }
    
     if($pwd==$pwd_confirm && !$user_in_db){
        $query = "INSERT INTO user_info (FirstName, LastName, Username, Pw) 
                    VALUES (:firstname, :lastname, :username, :pwd)";
    
        $statement = $db->prepare($query);
        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':pwd', $pwd);
        $statement->execute();
        $statement->closeCursor();
        header("Location: login.php");
     }
	
	
	
	
}
?>


<?php
function editData()
{
    
  require('connect-db.php');
  if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $con=mysqli_connect("localhost","cs4640","password","moviefinder");
    
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $sql = "Select * from user_info where Username='$user';";
    
    $result=$con->query($sql);
    $row = $result->fetch_assoc();
    $first = $row['FirstName'];
    $last = $row['LastName'];
    $pw = $row['Pw'];
    $pw_confirm = $row['Pw'];

    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if($_POST['firstname']){
            $first= $_POST['firstname'];
        }
        if($_POST['lastname']){
            $last = $_POST['lastname'];
        }
        if($_POST['psw']){
            $pw = $_POST['psw'];
        }
        if($_POST['psw-confirm']){
            $pw_confirm = $_POST['psw-confirm'];
        }
         
        if($pwd==$pwd_confirm){
            $query = "UPDATE user_info 
            SET FirstName='$first', LastName='$last', Pw='$pw' 
            WHERE Username='$user'";
        
            $statement = $db->prepare($query);
            $statement->bindValue(':first', $first);
            $statement->bindValue(':last', $last);
            $statement->bindValue(':pw', $pw);
            $statement->execute();
            $statement->closeCursor();
            header("Location: account-info.php");
         }
        }
    mysqli_close($con);

  }
  
	
	
	
	
	
	
	
	
	
}
?>
</body>
</html>