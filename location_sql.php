<?php  
include 'api/inc/db.php'; 
if (isset($_POST)) {
	$latitude=$_POST['latitude'];
	$longitude=$_POST['longitude'];
	$radius=$_POST['radius'];
	$update="UPDATE location SET latitude='$latitude',longitude='$longitude',radius='$radius' WHERE status='admin' AND del=0";
	if (mysqli_query($conn,$update)) {
		header("Location:location_update.php?uid=gg54564hghahhgs234567hsgfshhhpps545644564&&stat=updated");
	}
}
header("Location:location_update.php?uid=gg54564hghahhgs234567hsgfshhhpps545644564");
?>