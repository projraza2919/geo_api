<?php  
function send_via_email($email,$username,$otp,$domain){
	$res=false;
$template='
<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:70%;padding:20px 0">
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">GEOFENCE</a>
    </div>
    <p style="font-size:1.1em">Hi, '.$username.'</p>
    <p>Do click on the link to Verify your account. Eiether Click below or go to this link '.$domain.'/verify_account.php?email='.$email.'&&key='.$otp.'</p>
    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;"><a href="'.$domain.'/verify_account.php?email='.$email.'&&key='.$otp.'">Click To verify</a></h2>
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
$headers .= "From: webmaster@example.com" . "\r\n" .
"CC: somebodyelse@example.com";

if (mail($to,$subject,$template,$headers)) {
	$res=true;
}

return $res;
}

function send_via_contact($contact,$username,$otp){
	$res=false;
$template='Your OTP for geofence registration is '.$otp;
if (1==1) {
	$res=true;
}

return $res;
}

?>

