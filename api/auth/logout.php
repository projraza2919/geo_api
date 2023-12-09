<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';

$username=string_validate($data['username']);
$key=string_validate($data['key']);
$device=string_validate($data['device']);
$device_type=string_validate($data['device_type']);

$sql="SELECT * FROM login WHERE username='$username' AND del=0 AND device_type='$device_type' ORDER BY id DESC LIMIT 1";
if (mysqli_query($conn,$sql)) {
	$run=mysqli_query($conn,$sql);
	if (mysqli_num_rows($run)>0) {
		while ($fetch=mysqli_fetch_assoc($run)) {
			if ($fetch['logout']==0) {
				if ($device==$fetch['device']) {
					if (password_verify($key, $fetch['key_'])) {
						$id=$fetch['id'];
						$key='none';
						$ins="INSERT INTO login(username,key_,device,device_type,logout) VALUES('$username','$key','$device','$device_type',1)";
						if (mysqli_query($conn,$ins)) {
							$response=array('status'=>true);
						}
					}
				}
			}
		}			
	}
}
$response=array('status'=>true);
include 'inc/footer.php';

?>