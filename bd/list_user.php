<?php
	include ("../bd.php");
	
	$data = json_decode($_POST['jsonData']);
	$id=$data->id;	
	$result = mysql_query("SELECT * FROM schoolboy_olympics WHERE olympics_id='$id'");
	
	$n=mysql_num_rows($result);
	$array_id = array($n);
	$array_name_user = array($n);
	$array_classes = array($n);
	$array_school = array($n);
	
	for($i=0;$i<$n;$i++){
		$myrow=mysql_fetch_array($result);
		$array_id[$i]=$myrow['schoolboy_users_id'];
		$result2 = mysql_query("SELECT * FROM schoolboy WHERE Users_id='$array_id[$i]'");
		$myrow2=mysql_fetch_array($result2);
		$array_name_user[$i]=$myrow2['Fio_schoolboy'];
		$array_school[$i]=$myrow2['school'];
		$array_classes[$i]=$myrow2['class'];
		
	
	}	
	$result3 = mysql_query("SELECT * FROM olympics WHERE id='$id'");
	$myrow3=mysql_fetch_array($result3);
	$jsonn=array(			
		'name_olympiad'=>$myrow3['name_olympiad'],
		'array_name_user'=>$array_name_user,
		'array_classes'=>$array_classes,
		'array_id'=>$array_id,
		'array_school'=>$array_school,
		
		);
	echo json_encode($jsonn);
?>