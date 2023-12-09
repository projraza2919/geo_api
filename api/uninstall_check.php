<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';

$device=string_validate($data['device']);
$counter=$data['counter'];
//$fence=string_validate($data['fence']);
$date=date("d-M-Y h:i:s");
$sel="SELECT * FROM users WHERE device='$device' AND del=0";
if (mysqli_query($conn,$sel)) {
	$run=mysqli_query($conn,$sel);
	if (mysqli_num_rows($run)>0) {
		while ($fetch=mysqli_fetch_assoc($run)) {
			$id=$fetch['id'];
			if ($fetch['counter']>$counter) {
				$counter=$counter-1;
				$sql="UPDATE users SET status='uninstalled',id=$id WHERE device='$device'";
				if (mysqli_query($conn,$sql)) {
					$update="UPDATE users SET del=1 WHERE id=$id";
					if(mysqli_query($conn,$update)){
						$response=array('status'=>true,'msg'=>'uninstalled');
					}
				}
			}else{
				$sql="UPDATE users SET uninstall='$date' WHERE device='$device'";
				if (mysqli_query($conn,$sql)) {
					$response=array('status'=>true,'msg'=>'great');
				}
			}
		}
	}
}


include 'inc/footer.php';

?>