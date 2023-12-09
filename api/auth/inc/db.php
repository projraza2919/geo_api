<?php  
$servername="Localhost";
$database="geofence";
$dussername="root";
$dpassword="";
$domain="https://";
$conn= mysqli_connect($servername,$dussername,$dpassword,$database);
if (!$conn) {
	die("connection_error");
}
?>