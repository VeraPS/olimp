<?php
   include ("../bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто    измените путь  
   $data = json_decode($_POST['jsonData']);
	$id_olymp=$data->id_olymp;
	$id_user=$data->id_user;
	$result = mysql_query("SELECT * FROM schoolboy_olympics WHERE olympics_id='$id_olymp' AND schoolboy_users_id='$id_user'");
	//$myrow= mysql_fetch_array($result);
	
	$n=mysql_num_rows($result);
	
	if($n==0){
		mysql_query("INSERT INTO schoolboy_olympics (olympics_id,schoolboy_users_id) VALUES ('$id_olymp','$id_user')");
		$jsonn=array(		

		'status'=>1,
		
		
		);	
	}
	else{
		mysql_query("DELETE FROM schoolboy_olympics WHERE olympics_id='$id_olymp' AND schoolboy_users_id='$id_user'");
		$jsonn=array(			

			'status'=>2,
		
		
		);	
	}
	echo json_encode($jsonn);

?>