<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';

$device=string_validate($data['device']);
$fence=string_validate($data['fence']);
$wifi=$data['wifi'];
$bluetooth=$data['bluetooth'];
$location=array();
$bool=0;
if ($fence=='i') {
	$bool=1;
}
$bwifi=0;
if ($wifi==true) {
	$bwifi=1;
}
$bbt=0;
if ($bluetooth==true) {
	$bbt=1;
}
$sql="UPDATE users SET fence=$bool, bt=$bbt, wifi=$bwifi WHERE device='$device'";
if (mysqli_query($conn,$sql)) {
	$response=array('status'=>true);
}
include 'inc/footer.php';
?>