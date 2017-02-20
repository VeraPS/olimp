<?php
	include ("../bd.php");
	$data = json_decode($_POST['jsonData']);
	$id=$data->id;
	$id2=$data->id2;
	$result = mysql_query("SELECT * FROM users WHERE id='$id'");
	$myrow= mysql_fetch_array($result);
	$rights=$myrow['rights'];
	mysql_query("DELETE FROM users WHERE  id='$id'");
	if($rights==1){
		mysql_query("DELETE FROM comments WHERE user='$id' or reply='$id'");
		mysql_query("DELETE FROM schoolboy_past_olympics WHERE schoolboy_users_id='$id'");
		mysql_query("DELETE FROM schoolboy_olympics WHERE schoolboy_users_id='$id'");
		mysql_query("DELETE FROM schoolboy WHERE Users_id='$id'");
	}
	if($rights==2){
		mysql_query("DELETE FROM comments WHERE user='$id' or reply='$id'");
		mysql_query("DELETE FROM professor WHERE  users_id='$id'");
		mysql_query ("UPDATE  olympics SET professor_users_id = '$id2' WHERE professor_users_id='$id'");	
	}
	
?>
