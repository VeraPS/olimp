<?php
	session_start();
	include ("../bd.php");
	$id=$_GET['id'];
	mysql_query ("UPDATE users SET activation=1 WHERE id='$id'");
	header('Location: ../confirmation_user.php');
?>