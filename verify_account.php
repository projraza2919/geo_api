
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GEOFENCE | Account Verification</title>
</head>
<body style="text-align: center;">
	<div style="height: 20vh; width: 100vw;"></div>
<?php  
include 'api/inc/db.php';
include 'api/inc/string_validate.php';

$device=$_GET['device'];
$key=$_GET['key'];
$sql="SELECT * FROM users WHERE device='$device' AND del=0 ORDER BY id DESC LIMIT 1";
if (mysqli_query($conn,$sql)) {
	$run=mysqli_query($conn,$sql);
	if (mysqli_num_rows($run)>0) {
		while ($fetch=mysqli_fetch_assoc($run)) {
			$id=$fetch['id'];
			if (password_verify($key, $fetch['passkey'])) {
				$update="UPDATE users SET userverify=1 WHERE id='$id'";
				if (mysqli_query($conn,$update)) {
					echo "<h2>Your Account has been activated, please visit app again and proceed</h2>";				
				}else{
					echo "<h2>failed to Activate your account, Please contact admin</h2>";
				}
			}else{

			}		echo "<h2>key Not Matched, Try again</h2>";	
		}			
	}else{
		echo "<h2>register again, We coudn't find your account</h2>";
	}
	
}else{
	echo "<h2>Fatal Error Occured</h2>";
}

?>
</body>
</html>