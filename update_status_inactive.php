<?php  
session_start(); 
include 'api/inc/db.php'; 
if (isset($_GET['id'])) {
	$id=$_GET['id'];
	$sql="UPDATE users SET status='inactive' WHERE id='$id'";
	mysqli_query($conn,$sql);
}else{
	echo '<h1>Sorry Admin Not recognised</h1>';
}
header("Location:account_status.php?uid=gg54564hghahhgs234567hsgfshhhpps545644564");

?>