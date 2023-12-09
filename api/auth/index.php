<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';

$username=string_validate($data['username']);
$device=string_validate($data['device']);
$device_type=string_validate($data['device_type']);

$sql="SELECT * FROM login WHERE username='$username' AND device='$device' AND device_type='$device_type' ORDER BY id DESC LIMIT 1";
if (mysqli_query($conn,$sql)) {
	$run=mysqli_query($conn,$sql);
	if (mysqli_num_rows($run)>0) {
		while ($fetch=mysqli_fetch_assoc($run)) {
			if ($fetch['logout']==1) {
				$response=array('status'=>true,'msg'=>'logedout');
			}else{
				$response=array('status'=>true,'msg'=>'need_key_auth');
			}
		}			
	}
}

include 'inc/footer.php';

?>