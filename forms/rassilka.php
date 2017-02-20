<?php
session_start();
?>
<?php
	include ("../bd.php");
	$result = mysql_query("SELECT email FROM schoolboy");
	 while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		 $subject    = "Новая олимпиада";//тема сообщения
            $message    = "Здравствуйте!
			На сайте olimpiada.ru появилась новая олимпиада, которая может Вас заинтересовать. 
            С    уважением, Администрация    olimpiada.ru";
            mail($row[0], $subject, $message, "Content-type:text/plane;    Charset=windows-1251\r\n");
    }
	header("location: ".$_GET["from"]);
	//WHERE sending = '1'//<input type="button" onclick="location.href='forms/rassilka.php?from='+location.href"> - кнопка при нажатии на которую отправится рассылка. Для олимпиады это создать
?>

