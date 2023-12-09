<?php  
session_start(); 
include 'api/inc/db.php'; 
if (isset($_GET['device'])) {
	$device=(int)$_GET['device'];
	$sql="UPDATE users SET adminverify=1 AND status='active' WHERE device='$device'";
	if (mysqli_query($conn,$sql)) {
			echo '<h1>Done</h1>';
	}else{
		echo '<h1>failed Query</h1>';		
	}
}else{
	echo '<h1>Sorry Admin Not recognised</h1>';
}
header("Location:account_status.php?uid=gg54564hghahhgs234567hsgfshhhpps545644564");

?>