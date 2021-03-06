<?php
  session_start();

// try commenting out the header setting to experiment how the back end refuses the request
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
header('Access-Control-Allow-Methods: POST');
// $data = (int) $_SERVER['CONTENT_LENGTH']; 


// retrieve data from the request
$postdata = file_get_contents("php://input");

// process data 
// (this example simply extracts the data and restructures them back) 
$request = json_decode($postdata);

$data = [];
foreach ($request as $k => $v)
{
  $data[0][$k] = $v;
}

if(isset($_SESSION['user'])){
  $data[0]["logged_in"]="true";
}
else{
  $data[0]["logged_in"]="false";
}



// sent response (in json format) back to the front end
echo json_encode([$data]);

?>