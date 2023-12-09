<?php  
function mtime(){
    list($usec, $sec) = explode(" ", microtime());
    list($tusec, $tmsec) = explode(".", $usec);
    return ($tmsec + $sec*1000000);
}

?>