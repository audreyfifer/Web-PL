<?php


// try commenting out the header setting to experiment how the back end refuses the request
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');


$log_data = file_get_contents("C:/xampp/htdocs/Web-PL/angular/src/assets/logged_in.json");

// process data
// (this example simply extracts the data and restructures them back)
$request = json_decode($log_data);

$data = [];
foreach ($request as $k => $v)
{
   $data[0]['get'.$k] = $v;
}


// send response (in json format) back the front end
echo json_encode([$data]);
?>