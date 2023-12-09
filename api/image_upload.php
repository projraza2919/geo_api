<?php  
include 'inc/header.php';
include 'inc/db.php';
include 'inc/string_validate.php';

$device=string_validate($data['device']);
//$fence=string_validate($data['fence']);
$date=date("d-M-Y h:i:s");

 $image = $_POST['image'];
 $name = $_POST['name'];
/*

 $realImage = base64_decode($image);
 $path="lastpic/".$device;
 if (!file_exists($path)) {
    mkdir($path);
}
    if (file_put_contents($path.'/'.$name, $realImage)) {
    	$response=array('status'=>true);
    }
*/
    $update="UPDATE users SET image_id='$name',image_date='$date' WHERE device='$device'";
    if (mysqli_query($conn,$update)) {
    	$response=array('status'=>true);
    }
 
    


include 'inc/footer.php';

?>