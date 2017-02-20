<?php
	session_start();
	include ("../bd.php");
	$data = json_decode($_POST['jsonData']);
	$id=$data->id;
	$result = mysql_query("SELECT * FROM users WHERE id='$id'"); //извлекаем из базы все данные о пользователе с введенным логином
	$myrow = mysql_fetch_array($result);
		$jsonn=array(				
		'rights'=>$myrow['rights'],	
	
		);
	echo json_encode($jsonn);
?>