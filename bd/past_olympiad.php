<?php
	include ("../bd.php");
	$data = json_decode($_POST['jsonData']);
	$result = mysql_query("SELECT * FROM olympics WHERE Olympiad_status='1'");
	$n=mysql_num_rows($result);
	$array_id = array($n);
	$array_name_olympiad = array($n);
	$array_date = array($n);
	$array_subject = array($n);
	$array_classes = array($n);
	$array_terms = array($n);
	$array_organizator = array($n);
	
	for($i=0;$i<$n;$i++){
		$myrow=mysql_fetch_array($result);
		$array_name_olympiad[$i]=$myrow['name_olympiad'];
		$array_id[$i]=$myrow['id'];		
		$array_subject[$i]=$myrow['subject'];
		$array_classes[$i]=$myrow['classes'];
		$array_date[$i]=$myrow['date'];
		$array_organizator[$i]=$myrow['professor_users_id'];
		
	}
	$jsonn=array(				
		'array_id'=>$array_id,
		'array_name_olympiad'=>$array_name_olympiad,
		'array_subject'=>$array_subject,
		'array_classes'=>$array_classes,
		'array_date'=>$array_date,			
		'array_organizator'=>$array_organizator,		
		);
	echo json_encode($jsonn);
?>