
<?php
	//session_start();
	include ("../bd.php");
	$data = json_decode($_POST['jsonData']);
	$id=$data->id;
	$rights=$data->rights;
	
	if($rights==1){
		$result = mysql_query("SELECT * FROM schoolboy WHERE Users_id='$id'");
		$myrow= mysql_fetch_array($result);			
		$row=$myrow['Fio_schoolboy'];
		$str=strpos($row, "!");
		$surname=substr($row, 0, $str);
		
		
		$row2=substr($row,$str+1,strlen($row));
		$str=strpos($row2, "!");
		$forename=substr($row2, 0, $str);
		
		$row3=substr($row2,$str+1,strlen($row2));
		$str=strpos($row3, "!");
		$patronymic=substr($row3, 0, $str);
		
		
		
		$jsonn=array(				
			'id'=>$id,
			'surname'=>$surname,
			'forename'=>$forename,
			'patronymic'=>$patronymic,
			'school'=>$myrow['school'],
			'birthdate'=>$myrow['birthdate'],
			'class'=>$myrow['class'],
			'gender'=>$myrow['gender'],
			'email'=>$myrow['email'],
			'delivery'=>$myrow['delivery'],	
			'home_adress'=>$myrow['home_adress'],
			'rating'=>$myrow['rating'],
			'phone'=>$myrow['phone'],					
		);
		echo json_encode($jsonn);
		
	}
	if($rights==2||$rights==3){
		$result = mysql_query("SELECT * FROM professor WHERE users_id='$id'");
		$myrow= mysql_fetch_array($result);		
		$row=$myrow['Fio_professor'];
		$str=strpos($row, "!");
		$surname=substr($row, 0, $str);
		
		
		$row2=substr($row,$str+1,strlen($row));
		$str=strpos($row2, "!");
		$forename=substr($row2, 0, $str);
		
		$row3=substr($row2,$str+1,strlen($row2));
		$str=strpos($row3, "!");
		$patronymic=substr($row3, 0, $str);
		
		$jsonn=array(				
			'id'=>$id,
			'surname'=>$surname,
			'forename'=>$forename,
			'patronymic'=>$patronymic,
			'email'=>$myrow['email'],
			'phone'=>$myrow['phone'],						
		);
		echo json_encode($jsonn);
		
	}
	/*if($rights==3){
		$result = mysql_query("SELECT * FROM users WHERE id='$id'");
		$myrow= mysql_fetch_array($result);
		$jsonn=array(				
			'id'=>$id,					
		);
		echo json_encode($jsonn);
		
	}	*/
?>
