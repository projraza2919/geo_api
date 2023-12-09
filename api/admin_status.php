<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';

$username=string_validate($data['username']);
$status=string_validate($data['status']);
$location=array();
$sql="SELECT * FROM location WHERE status='admin' AND del=0 ORDER BY id DESC LIMIT 1";
if (mysqli_query($conn,$sql)) {
	$run=mysqli_query($conn,$sql);
	if (mysqli_num_rows($run)>0) {
		while ($fetch=mysqli_fetch_assoc($run)) {
			$location=array(
				'id'=>$fetch['id'],
				'latitude'=>$fetch['latitude'],
				'longitude'=>$fetch['longitude'],
				'radius'=>$fetch['radius']
			);			
			$response=array('status'=>true,'location'=>$location);
		}
	}
}
include 'inc/footer.php';

?>