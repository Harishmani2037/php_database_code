<?php

include_once 'latp.php';

function do_post($postcontent,$image_url){

	$conn=get_db_connection();
	$username=get_current_username();
	$query="INSERT INTO `mydb`.`posts` (`content`, `image`, `posted_by`) VALUES ('$postcontent', '$image_url', '$username');";
	if (mysqli_query($conn,$query)) {
		# code...
		$post_id=mysqli_insert_id($conn);
		return $post_id;
	}else{
		return Null;
	}
}

function get_all_posts(){
	$conn=get_db_connection();
	$username=get_current_username();

	$query="SELECT * FROM mydb.posts order by posted_on desc;";

	$result=mysqli_query($conn,$query);

	if (mysqli_num_rows($result)>0) {
		# code...
		$posts=[];

		while ($row=mysqli_fetch_assoc($result)) {
			# code...
			$posts[]=$row;
		}
		return $posts;
	}else{
		return [];
	}

}

function edit_post($post_id,$postcontent){

$conn=get_db_connection();

$query="UPDATE `mydb`.`posts` SET `content` = '$postcontent' WHERE `post_id` = $post_id;
";
if (mysqli_query($conn,$query)) {
		# code...
		
		return TRUE;
	}else{
		return FALSE;
	}

}

function delete_post($post_id){
$conn=get_db_connection();
$query="DELETE FROM `mydb`.`posts` WHERE `post_id` = '$post_id';
";

if (mysqli_query($conn,$query)) {
		# code...

		return TRUE;
	}else{
		return FALSE;
	}

}

function get_posts($post_id){
$conn=get_db_connection();

$query="SELECT * FROM `mydb`.`posts` where `post_id`=$post_id";

$result=mysqli_query($conn,$query);

if (mysqli_num_rows($result)==1) {
	# code...
	
	$row= mysqli_fetch_assoc($result);

	return $row;
}else{
	return Null;
}
}

function like_post($post_id){
	$conn=get_db_connection();
	$username=get_current_username();
	$query="INSERT INTO `mydb`.`likes` (`liked_by`, `posted_id`) VALUES ('$username', '$post_id');";

	if (mysqli_query($conn,$query)) {
		# code...
		
		
	}else{
		return FALSE;
	}

}

function get_likes_count($post_id){
	$conn=get_db_connection();
	$query="SELECT COUNT(*) As count FROM `mydb`.`likes` where `posted_id`='$post_id';";

	$result=mysqli_query($conn,$query);

	return mysqli_fetch_assoc($result)['count'];
}


?>