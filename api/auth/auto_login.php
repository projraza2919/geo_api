<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';
include 'inc/get_city.php';
$username=string_validate($data['username']);
$key=string_validate($data['key']);
$device=string_validate($data['device']);
$device_type=string_validate($data['device_type']);
$lat=string_validate($data['lat']);
$long=string_validate($data['long']);
$apikey='AIzaSyC8A_QU7UFTqsb-M5TVxNxH3L8ZEZFgyCg';
$sql="SELECT * FROM login WHERE username='$username' AND del=0 AND device_type='$device_type' ORDER BY id DESC LIMIT 1";
if (mysqli_query($conn,$sql)) {
	$run=mysqli_query($conn,$sql);
	if (mysqli_num_rows($run)>0) {
		while ($fetch=mysqli_fetch_assoc($run)) {
			if ($fetch['logout']==0) {
				if ($device==$fetch['device']) {
					if (password_verify($key, $fetch['key_'])) {
						$id=$fetch['id'];
						$tkey=bin2hex(random_bytes(8));
						$key=password_hash($tkey, PASSWORD_DEFAULT);
						$ins="INSERT INTO login(username,key_,device,device_type) VALUES('$username','$key','$device','$device_type')";
						if (mysqli_query($conn,$ins)) {
							$city=get_city($lat,$long,$apikey);
							$ins="INSERT INTO location(username,lattitude,longitude,city) VALUES('$username','$lat','$long','$city')";
							$response=array('status'=>true,'key'=>$tkey,'city'=>ucfirst($city));
						}
					}
				}
			}
		}			
	}
}
//$response=array('status'=>true,'key'=>'shjd545sdsds54','city'=>ucfirst('not defined'));

include 'inc/footer.php';

?>