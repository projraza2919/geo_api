<?php  
session_start();
if (isset($_POST)) {
	$username='admin@admin.com';
	$password='admin456';
	if ($_POST['email']==$username) {
		if ($_POST['password']==$password) {
			//$_SESSION['msg']='invalid Email';
			$_SESSION['login']=true;
			header("location:index.php?uid=gg54564hghahhgs234567hsgfshhhpps545644564");
		}else{
		$_SESSION['msg']='incorrect Password';
		header("location:login.php");	
		}
	}else{
		$_SESSION['msg']='invalid Email';
		header("location:login.php");
	}
}else{
	$_SESSION['msg']='Invalid Request';
	header("location:login.php");
}

?>