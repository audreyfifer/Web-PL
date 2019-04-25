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
  
  <title>Adding CSV files</title>    
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




<?php 
/*************************/
/** create table **/
function createTable()
{
 
    require('connect-db.php');
    
    $query = "CREATE TABLE title_basics (
        tconst VARCHAR(30) PRIMARY KEY,
        titleType VARCHAR(30) NOT NULL,
        primaryTitle VARCHAR(100) NOT NULL,
        originalTitle VARCHAR(100) NOT NULL,
        isAdult VARCHAR(30) NOT NULL,
        startYear VARCHAR(30) NOT NULL,
        endYear VARCHAR(30) NOT NULL,
        runtimeMinutes VARCHAR(30) NOT NULL,
        genre VARCHAR(100) NOT NULL)";
    
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
		
}
?>
<?php 
/*************************/
/** insert data **/

	require('connect-db.php');
    $result = $db->query("SHOW TABLES LIKE 'title_basics'");
    $tableExists = ($result !== false) && ($result->rowCount() > 0);
	if(!$tableExists){
        createTable();
    }

    $array = array();
    if (($handle = fopen("C:/xampp/htdocs/Web-PL/imdb_csv_files/title_basics.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
               array_push($array,$data[0]. ",". $data[1]. ",". $data[2]. ",".  $data[3]. ",". 
                $data[4]. ",".  $data[5]. ",".  $data[6]. ",".  $data[7]. ",".  $data[8]);
        }
        fclose($handle);
    }
    
    for ($i = 0; $i < count($array); $i++) {  
        $data = preg_split ("/\,/", $array[$i]);        
                $tconst= $data[0];
                $titleType=$data[1];
                $primaryTitle=$data[2];
                $originalTitle=$data[3];
                $isAdult=$data[4];
                $startYear=$data[5];
                $endYear=$data[6];
                $runtimeMinutes=$data[7];
                $genre=$data[8];
                echo $tconst. $titleType. $primaryTitle. $originalTitle. $isAdult. $startYear. $endYear. "<br />";
                
                $sql = "INSERT INTO title_basics (tconst, titleType, primaryTitle, originalTitle,isAdult, startYear, endYear, runtimeMinutes, genre) VALUES (:tconst, :titleType, :primaryTitle, :originalTitle,:isAdult, :startYear, :endYear, :runtimeMinutes, :genre);";
                
                $statement = $db->prepare($sql);
                $statement->bindValue(':tconst', $tconst);
                $statement->bindValue(':titleType', $titleType);
                $statement->bindValue(':primaryTitle', $primaryTitle);
                $statement->bindValue(':originalTitle', $originalTitle);
                $statement->bindValue(':isAdult', $isAdult);
                $statement->bindValue(':startYear', $startYear);
                $statement->bindValue(':endYear', $endYear);
                $statement->bindValue(':runtimeMinutes', $runtimeMinutes);
                $statement->bindValue(':genre', $genre);
                
                $statement->execute();
                $statement->closeCursor();
                
            
    }
        
      
        
        
?>

</body>
</html>