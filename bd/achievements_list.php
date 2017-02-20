<?php
	include ("../bd.php");
	$data = json_decode($_POST['jsonData']);
	$id=$data->id;
	$result = mysql_query("SELECT * FROM  schoolboy_past_olympics WHERE schoolboy_users_id='$id'");
	$n=mysql_num_rows($result);	
	$array_place = array($n);
	$array_name_olympiad = array($n);
	$array_id_olympiad = array($n);
	
	for($i=0;$i<$n;$i++){
		$myrow=mysql_fetch_array($result);
		$array_id_olympiad[$i]=$myrow['olympics_id'];
		$array_place[$i]=$myrow['place'];
		$result2 = mysql_query("SELECT * FROM  olympics WHERE id='$array_id_olympiad[$i]'");	
		$myrow2=mysql_fetch_array($result2);
		$array_name_olympiad[$i]=$myrow2['name_olympiad'];
	}
	//$result2 = mysql_query("SELECT * FROM  schoolboy order by rating desc");
	$result2 = mysql_query('SELECT Users_id, Fio_schoolboy, school , class as class1, rating FROM schoolboy INNER JOIN users ON Users_id = id WHERE activation = 1 ORDER BY rating DESC');
	$n=mysql_num_rows($result2);	
	for($i=0;$i<$n;$i++){
		$myrow2=mysql_fetch_array($result2);
		if($myrow2['Users_id']==$id){
			$number=$i+1;
			//exit;
		}
		
	
		
	}
	
	$jsonn=array(		
	
		'array_name_olympiad'=>$array_name_olympiad,
		'array_number_rating'=>$number,
		'array_place'=>$array_place,
		'array_id_olympiad'=>$array_id_olympiad,
	
		);
	echo json_encode($jsonn);	
?>