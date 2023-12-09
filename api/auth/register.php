<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';
include 'send.php';
$name=string_validate($data['name']);
$email=string_validate($data['email']);
$userid=string_validate($data['userid']);
$department=string_validate($data['department']);
$designation=string_validate($data['designation']);
$contact=string_validate($data['contact']);
$device=string_validate($data['device']);
$key=bin2hex(random_bytes(16));
if (empty($device)) {
	goto b;
}
$haskey=password_hash($key, PASSWORD_DEFAULT);
$sql="SELECT * FROM users WHERE email='$email' AND del=0  ORDER BY id DESC LIMIT 1";
if (mysqli_query($conn,$sql)) {
	$run=mysqli_query($conn,$sql);
	if (mysqli_num_rows($run)>0) {
		while ($fetch=mysqli_fetch_assoc($run)) {
			if ($fetch['status']=='active') {
				$response=array('status'=>false,'msg'=>'This email is taken, Contact Admin');
			}else{
				$response=array('status'=>false,'msg'=>'Your account status is '.$fetch['status']);
			}
		}			
	}else{
		$temp="INSERT INTO users(name,email,userid,passkey,department,designation,contact,device,status) VALUES('$name','$email','$userid','$haskey','$department','$designation','$contact','$device','verification')";
		if (mysqli_query($conn,$temp)) {
			$template='
<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:70%;padding:20px 0">
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">GEOFENCE</a>
    </div>
    <p style="font-size:1.1em">Hi, '.$name.'</p>
    <p>Do click on the link to Verify your account. Eiether Click below or go to this link '.$domain.'/verify_account.php?device='.$device.'&&key='.$key.'</p>
    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;"><a href="'.$domain.'/verify_account.php?device='.$device.'&&key='.$key.'">Click To verify</a></h2>
    <p style="font-size:0.9em;">Regards,<br />Team Geofence</p>
    <hr style="border:none;border-top:1px solid #eee" />
    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
      <p>GEOFENCE 2023</p>
      <p></p>
      <p></p>
    </div>
  </div>
</div>
';
$to = $email;
$subject = "Geofence Account verification:";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: test@example.com" . "\r\n" .
"CC: princewebcap@gmail.com";

/*
if (mail($to,$subject,$template,$headers)) {
	$response=array('status'=>true);
}
*/
$res=send_mail($to,$subject,$template);
if ($res=='send') {
	$response=array('status'=>true);
}else{
	$response=array('status'=>false,'msg'=>$res);
}

			
		}
	}
}
b:
include 'inc/footer.php';

?>