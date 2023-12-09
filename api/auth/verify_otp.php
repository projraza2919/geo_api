<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';
include 'inc/seconds_elapse.php';
$username=string_validate($data['username']);
$otp=string_validate($data['otp']);
$device=string_validate($data['device']);
$device_type=string_validate($data['device_type']);
$send_type=string_validate($data['send_type']);
$send_from=string_validate($data['send_from']);
$response=array('status'=>false,'msg'=>'Fatal error');
$t=0;
$sql="SELECT * FROM users WHERE username='$username' AND del=0  ORDER BY id DESC LIMIT 1";
if (mysqli_query($conn,$sql)) {
	$run=mysqli_query($conn,$sql);
	if (mysqli_num_rows($run)>0) {
		$sel="SELECT * FROM otp WHERE username='$username' AND del=0 ORDER BY id DESC LIMIT 1";
		if (mysqli_query($conn,$sel)) {
			$runt=mysqli_query($conn,$sel);
			if (mysqli_num_rows($runt)>0) {
				while ($fetcht=mysqli_fetch_assoc($runt)) {
					$count=$fetcht['count'];
					$timestamp=$fetcht['added_on'];
					$fotp=$fetcht['otp'];
					$fid=$fetcht['id'];
					$nums=$fetcht['nums'];
					if ($count<3) {
						$elapse=seconds_elapse($timestamp);
						if ($elapse>310) {
							if (password_verify($otp, $fotp)) {
								$set="UPDATE otp SET del=1 WHERE id='$fid'";
								if (mysqli_query($conn,$set)) {
									$response=array('status'=>true,'msg'=>'Otp verified');
								}
							}else{
								$set="UPDATE otp SET count=count+1 WHERE id='$fid'";
								if (mysqli_query($conn,$set)) {
									$response=array('status'=>false,'msg'=>'incorrect Otp');
								}
							}
						}else{
							$t=1;
							$set="UPDATE otp SET del=1 WHERE id='$fid'";
							if (mysqli_query($conn,$set)) {
								$response=array('status'=>false,'msg'=>'Otp has been expired :(');
							}
						}
					}else{
						$t=1;
						$set="UPDATE otp SET del=1 WHERE id='$fid'";
						if (mysqli_query($conn,$set)) {
							$response=array('status'=>false,'msg'=>'You have used Otp more than 3 times, Please Re-register again');
						}

					}
					if ($t>0 AND $nums<2) {
						$up="UPDATE users SET del=1 WHERE username='$username'";
						mysqli_query($conn,$up);
					}
				}
			}
		}			
	}
	
}


include 'inc/footer.php';
?>