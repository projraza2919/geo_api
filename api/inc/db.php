<?php  
$servername="Localhost";
//$database="webmuza_feisto";
$database="geofence";
$dussername="root";
$dpassword="";

$conn= mysqli_connect($servername,$dussername,$dpassword,$database);
if (!$conn) {
	die("connection_error");
}
?>