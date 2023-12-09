<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';
$device=string_validate($data['device']);
$sql="SELECT * FROM users WHERE device='$device' AND del=0  ORDER BY id DESC LIMIT 1";
if (mysqli_query($conn,$sql)) {
	$run=mysqli_query($conn,$sql);
	if (mysqli_num_rows($run)>0) {
		while ($fetch=mysqli_fetch_assoc($run)) {
			$astat=$ustat=false;
				if($fetch['userverify']==1){
					$ustat=true;
				}
				if($fetch['adminverify']==1){
					$astat=true;
				}
			if ($fetch['status']=='active') {
				
				$response=array(
					'status'=>true,
					'name'=>$res['name'],
					'email'=>$res['email'],
					'fence'=>$res['fence'],
					'userverified'=>$ustat,
					'adminverified'=>$astat,
					'account'=>'user',
				);
			}else{
				//$response=array('status'=>false,'msg'=>'Your account status is '.$fetch['status']);
				$response=array(
					'status'=>false,
					'name'=>$res['name'],
					'email'=>$res['email'],
					'fence'=>$res['fence'],
					'userverified'=>$ustat,
					'adminverified'=>$astat,
					'account'=>$fetch['status'],
				);
			}
		}			
	}else{
		$response=array(
					'status'=>false,
					'account'=>'blank',
				);
	}
}
//$response=array('status'=>true,'key'=>'shjd545sdsds54');
include 'inc/footer.php';

?>