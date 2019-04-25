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
  
      <!-- required scripts for IE --> 
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
            
      <title>MovieFinder</title>
          
    </head>
  
    <body>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>-->
      <script src="bootstrap-4.0.0/js/bootstrap.min.js"></script>
      <nav class="navbar navbar-expand-md bg-custom-header navbar-dark">
            <a class="navbar-brand" href="home.php">
              <img src="images/faces.png" id="logo_image" alt="image showing logo" class="img-responsive"><!--</br>-->
              <span id="logo-text">MovieFinder</span>
              </a>
            <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">   
                <a class="nav-link" id="nav-link-home" href="home.php">Home</a>
            </div>  
        </nav>
    
        <div class="profile-container" style="display:block">
                
            <img src = "images/login-profile.png" id="profile-image-main-screen" alt="image showing logo" class="img-responsive" style="float:left">
            <span id="profile-header" style="float:left">
            
                <div style="margin-left:20%; margin-top:20%">
                
                </div> 
            </span> 
        </div>
        <?php session_start(); // make sessions available ?>
        
                <?php
                    if (isset($_SESSION['user']))
                    {
                    ?>  
                    <div class="container">
                        <h1 style="margin-top:5%">Account info</h1>
                        <p>Username: <?php if (isset($_SESSION['user'])) echo $_SESSION['user']; ?></p>
                        <p>Name: <?php if (isset($_SESSION['user'])) {
                        $user = $_SESSION['user'];
                        $con=mysqli_connect("localhost","cs4640","password","moviefinder");
                        // Check connection
                        if (mysqli_connect_errno())
                        {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                        }
                        $sql = "Select * from user_info where Username='$user';";
                        
                        //$querystuff = mysqli_query($con,$sql) ;
                        $result=$con->query($sql);
                        $row = $result->fetch_assoc();
                        echo $row['FirstName']. " ". $row['LastName'];
                        
                        mysqli_close($con);
                       
                        }

                        ?> 
                        
                    </div>
                    <?php
                    }
                    else 
                    // redirect to the login page
                    //header('Location: login.php');
                        
                    ?>
                    
<?php 
if (isset($_GET['btnaction']))
{	
   try 
   { 	
      switch ($_GET['btnaction']) 
      {
         //case 'create': createTable(); break;
         //case 'insert': insertData();  break;
         //case 'select': selectData();  break;
         //case 'update': updateData();  break;
         case 'Delete Account': deleteData();  break;
         case 'Edit Name': editData(); break;
         //case 'drop':   dropTable();   break;      
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
function editData()
{
    header('Location: edit-account-info.php');
}
?>
<?php
/*************************/
/** delete data **/
function deleteData()
{
    require('connect-db.php');
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        
    
   $query = "DELETE FROM user_info WHERE Username='$user'";
   $statement = $db->prepare($query);
   $statement->bindValue(':Username', $user);
   $statement->execute();
   $statement->closeCursor();
   session_destroy();
   header('Location: login.php');

    }
}
?>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" style="margin-left:14%" method="get">
            <input type="submit" name="btnaction" value="Edit Name" class = "btn btn-light"/>
            <input type="submit" name="btnaction" value="Delete Account" class="btn btn-light" />
        </form>
    </body>
    </html>