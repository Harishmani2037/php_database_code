<?php
include 'C:\wamp64\www\test\library\latp.php';


if (isset($_GET['otp'])) {

echo do_verify_signup("harishmani5052@gmail.com",$_GET['otp']);
header("Location:sigin.php");

}


?>




<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="GET" style="text-align: center;">
		
		<label>OTP</label><br><br>
		<input type="text" name="otp" placeholder="Enter the OTP" required><br><br>
		 <button class="btn btn-lg btn-primary btn-block" type="submit">Sigup</button>
	</form>

</body>
</html>