<?php
	include ("../bd.php");
	$data = json_decode($_POST['jsonData']);
	$id=$data->id;
	$result = mysql_query("SELECT * FROM olympics WHERE id='$id'");	
	$myrow= mysql_fetch_array($result);
	
	$id_organizer=$myrow['professor_users_id'];
	
	$result2 = mysql_query("SELECT * FROM professor WHERE users_id='$id_organizer'");	
	$myrow2= mysql_fetch_array($result2);
	
	$jsonn=array(				
		'id'=>$id,
		'name_olympiad'=>$myrow['name_olympiad'],		
		'FIO'=>$myrow2['Fio_professor'],
		'email'=>$myrow2['email'],
		'phone'=>$myrow2['phone'],		
		);
	echo json_encode($jsonn);		
	
	
?>
