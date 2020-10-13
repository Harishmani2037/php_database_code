<?php
include 'C:\wamp64\www\test\library\latp.php';
if (isset($_COOKIE['username']) and isset($_COOKIE['token'])) {

	$username=$_COOKIE['username'];
	$token=$_COOKIE['token'];

	if (verify_session($username,$token)) {
		# code...
		header("Location:http://localhost/Test/album/home.php");
	}else{
		header("Location:C:\wamp64\www\ test\signup\sigin.php");
	}
}else{
	header("Location:http://localhost/test/signup/sigin.php");
}
?>