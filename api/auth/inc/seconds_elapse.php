<?php  
function seconds_elapse($timestamp){
	$date1 = new DateTime($timestamp);
	$now = new DateTime();
$difference_in_seconds =  $now->format('U')-$date1->format('U');
return $difference_in_seconds;
}

?>