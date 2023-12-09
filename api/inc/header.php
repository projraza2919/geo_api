<?php  
header('Content-Type:application/json');
header('Access-Control-Allow-Origin:*');
header("Access-Control-Max-Age: 3600");
header('Access-Control-Allow-Methods:POST');
$data=json_decode(file_get_contents("php://input"),true);
$response=array('status'=>false);

?>