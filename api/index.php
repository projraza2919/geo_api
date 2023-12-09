<?php  
echo "welcome to user panel backend, these are the list of apis<br>";
$fileList = glob('*.php');
foreach($fileList as $filename){
    if(is_file($filename)){
        echo $filename, '<br>'; 
    }   
}
?>