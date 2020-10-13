<?php
$db_hostname="localhost";
$db_username="root";
$db_password="";
$db_name="mydb";
$db_conn=NULL;
$SALT="gfufyfyvjvjhjh";
function get_db_connection(){
global $db_username;
global $db_password;
global $db_conn;
global $db_hostname;
global $db_name;
$db_conn=mysqli_connect($db_hostname,$db_username,$db_password,$db_name);
if (!$db_conn) {
	# code...

	return $db_conn;
}
else{
	if (!$db_conn) {
		# code...
		die("Connection Failed :".mysqli_connect_error());
	}else{
		
		return $db_conn;
	}
}
}



function get_hashed_password($password){
	global $SALT;
return md5(strrev($password.$SALT));
}




function do_signUp($username,$password){
$db_conn=get_db_connection();
$hashed_password=get_hashed_password($password);
$otp=rand(100000,999999);
$query="INSERT INTO `mydb`.`authentication` (`username`, `password`, `otp`) VALUES ('$username','$hashed_password','$otp');";
if (mysqli_query($db_conn,$query)) {
	# code...
	return 1;
}else{
	return 0;
}
}



function do_verify_signup($username,$otp){
$db_conn=get_db_connection();

$query="SELECT * FROM mydb.authentication WHERE username='$username';";
$result=mysqli_query($db_conn,$query);

if (mysqli_num_rows($result)==1) {
	# code...
	$row=mysqli_fetch_assoc($result);
	if ($row['otp']==$otp) {
		# code...
		return activate($username);
	}
	else{
		return 0;
	}
}else{
	return 0;
}
}



function activate($username){
$db_conn=get_db_connection();

$query="UPDATE `mydb`.`authentication` SET `active` = '1' WHERE (`username` = '$username');";

if (mysqli_query($db_conn,$query)) {
	# code...
	echo "changed";
}else{
	echo "Not changed";
}

}



function do_login($username,$password){
$db_conn=get_db_connection();

$hashed_password=get_hashed_password($password);


$query="SELECT * FROM mydb.authentication WHERE username='$username' AND password='$hashed_password';";
$result=mysqli_query($db_conn,$query);

if (mysqli_num_rows($result)==1) {
	# code...
	$row=mysqli_fetch_assoc($result);
	if ($row['password']==$hashed_password) {
		# code...
		$token=get_hashed_password(rand(100000,999999));
		$expiry=time()+(60*60);
	   return add_session($username,$token,$expiry);
	}
	else{
		return 0;
	}
}else{
	return 0;
}
}



function add_session($username,$token,$expiry){

	$mysqltime=date('Y-m-d H:i:s',$expiry);
	
	$query="INSERT INTO `mydb`.`session` (`username`, `token`, `expiry`) VALUES ('$username', '$token', '$mysqltime');";

	$db_conn=get_db_connection();

	if (mysqli_query($db_conn,$query)) {
		# code...
		setcookie('username',$username,$expiry,'/');
		setcookie('token',$token,$expiry,'/');
		return 1;
	}
}



function verify_session($username,$token){

$db_conn=get_db_connection();
$query="SELECT * FROM mydb.session WHERE username='$username' AND token='$token';";

$result=mysqli_query($db_conn,$query);

if (mysqli_num_rows($result)==1) {
	# code...
	$row=mysqli_fetch_assoc($result);

	if ((int)$row['active']==1) {
		# code...
		$expiry=strtotime($row['expiry']);
		if ($expiry>time()) {
			# code...
			return 1;
		}else{
			invalidate_session($username,$token);
		}
	}else{
		return 0;
	}
	}
	else{
		return 0;
	}
}



function invalidate_session($username,$token){
$db_conn=get_db_connection();
$query="UPDATE `mydb`.`session` SET `active` = '0' WHERE `username` = '$username' AND `token`='$token';";
return mysqli_query($db_conn,$query);
}

function get_current_username(){
	if (verify_session($_COOKIE['username'],$_COOKIE['token'])) {

		# code...
		return $_COOKIE['username'];
	}else{
		return NULL;
	}
}
?>
