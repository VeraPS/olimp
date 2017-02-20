<?php
	include ("../bd.php");
	$data = json_decode($_POST['jsonData']);
	$action=$data->action;
	$id_olympiad=$data->id;	
	if($action=="id_schoolboy"){			
		$result = mysql_query("SELECT * FROM schoolboy_past_olympics WHERE olympics_id='$id_olympiad'");
		$n=mysql_num_rows($result);
		$array_id_schoolboy= array($n);
		$array_place = array($n);
		$array_rating_mark = array($n);
		
		
		for($i=0;$i<$n;$i++){
			$myrow=mysql_fetch_array($result);
			$array_id_schoolboy[$i]=$myrow['schoolboy_users_id'];
			$array_place[$i]=$myrow['place'];		
			$array_rating_mark[$i]=$myrow['rating_mark'];		
		}
		$jsonn=array(				
			'place'=>$array_place,
			'schoolboy_users_id'=>$array_id_schoolboy,
			'rating_mark'=>$array_rating_mark,		
			);
		echo json_encode($jsonn);
		
	}
	
	

?>