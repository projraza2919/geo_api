<?php  
$date1 = new DateTime("2021-12-08 16:12:12");
$now = new DateTime();

$difference_in_seconds = $date1->format('U') - $now->format('U');
echo $difference_in_seconds;
?>