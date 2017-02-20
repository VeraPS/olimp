<?php
	include ("../bd.php");
	$data = json_decode($_POST['jsonData']);
	$id=$data->id;
	mysql_query ("UPDATE olympics SET Olympiad_status=1 WHERE id='$id'");	
	
	$result = mysql_query("SELECT * FROM  schoolboy_olympics WHERE olympics_id='$id'");
	$n=mysql_num_rows($result);		
	for($i=0;$i<$n;$i++){
		$myrow=mysql_fetch_array($result);
		$user_id=$myrow['schoolboy_users_id'];
		mysql_query("INSERT INTO schoolboy_past_olympics VALUES('$id','$user_id',0,0)");
	}
	
?>