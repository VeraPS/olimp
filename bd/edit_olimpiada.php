<?php
if (isset($_POST['name_olimp'])) { $name_olimp = $_POST['name_olimp']; if ($name_olimp == '') { unset($name_olimp);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
if (isset($_POST['location_olimp'])) { $location_olimp = $_POST['location_olimp']; if ($location_olimp == '') { unset($location_olimp);} }
if (isset($_POST['date_application'])) { $date_application = $_POST['date_application']; if ($date_application == '') { unset($date_application);} }
if (isset($_POST['description_olimp'])) { $description_olimp = $_POST['description_olimp']; if ($description_olimp == '') { unset($description_olimp);} }
if (isset($_POST['Org_olimp'])) { $Org_olimp = $_POST['Org_olimp']; if ($Org_olimp == '') { unset($Org_olimp);} }

$id_o=$_GET['id'];
include ("../bd.php");
$result2 = mysql_query("SELECT name_olympiad FROM olympics WHERE id='$id_o'");
$row2 = mysql_fetch_array($result2);
$result = mysql_query("SELECT email FROM schoolboy where delivery=1");
	 while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		 $subject    = "Изменилась информация об олимпиаде";//тема сообщения
		 if($row2['name_olympiad']==$name_olimp){
            $message    = "Здравствуйте!
			На сайте olimpiada.ru изменилась информация об олимпиаде под названием: ".$name_olimp.". Эта информация может вас заинтересовать. 
            С    уважением, Администрация    olimpiada.ru";
		 }
		 else{
			$message    = "Здравствуйте!
			На сайте olimpiada.ru изменилась информация об олимпиаде под названием: ".$row2['name_olympiad']."(".$name_olimp."). Эта информация может вас заинтересовать. 
            С    уважением, Администрация    olimpiada.ru";
		 }
            mail($row[0], $subject, $message, "Content-type:text/plane;    Charset=windows-1251\r\n");
    }

$subject=$_POST['subject_string'];
$class_string="";
$flag=true;
$flag2=false;
for($i=1;$i<12;$i++){
	if($i==11&&$_POST['class_olimp'.$i]=="ON"){
		if($flag==true&&$class_string!=""){
			$class_string=$class_string."-".($i);	
			continue;
		}
		if($flag==true&&$class_string==""){
			$class_string=$i;	
			continue;
		}
	}	
	if(($_POST['class_olimp'.$i]=="ON")&&($class_string=="")){	
		$class_string=$i;		
		continue;
	}
	if(($_POST['class_olimp'.$i]=="ON")&&($class_string!="")&&($flag==false)){
		$flag=true;
		$flag2=false;
		$class_string=$class_string.",".$i;
		continue;
	}
	if(($_POST['class_olimp'.$i]!="ON")&&($class_string!="")&&($flag==true)){
		if($flag2==true){
			$class_string=$class_string."-".($i-1);		
		}
		$flag=false;
		continue;
	}
	if($_POST['class_olimp'.$i]=="ON"){
		$flag2=true;
	}
	
}


$day = str_pad($_POST["day0"], 2, '0', STR_PAD_LEFT);
	$month = str_pad($_POST["month0"], 2, '0', STR_PAD_LEFT);
	 
	//$month = $_POST["month".$i];
	$year = $_POST["year0"];
	$date_application=$year."-".$month."-".$day;
//if (isset($_POST['select_subject'])) { $select_subject = $_POST['select_subject']; if ($select_subject == '') { unset($select_subject);} }
// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
//mysql_query ("INSERT INTO olympics (name_olympiad, date, location,classes, terms,description, subject,professor_users_id) VALUES('$name_olimp','$dt1','$location_olimp','$class_string', '$date_application','$description_olimp','$subject','$Org_olimp')",$db);
mysql_query("UPDATE olympics SET name_olympiad='$name_olimp',date='$dt1',location='$location_olimp',classes='$class_string',terms='$date_application',description='$description_olimp',subject='$subject',professor_users_id='$Org_olimp' WHERE id='$id_o'");

if (isset($_POST['number_date'])) { $number_date = $_POST['number_date']; if ($number_date == '') { unset($number_date);} }
$id=$id_o;
if($number_date==0){
	$number_date=1;
}
for($i=1; $i<=$number_date; $i++){	
	$day = str_pad($_POST["day".$i], 2, '0', STR_PAD_LEFT);
	$month = str_pad($_POST["month".$i], 2, '0', STR_PAD_LEFT);
	$year = $_POST["year".$i];
	$time = $_POST["tm".$i];
	$time1 = $_POST["1tm".$i];
	$time2 = $_POST["2tm".$i];
	$time3 = str_pad($time1, 2, '0', STR_PAD_LEFT).":".str_pad($time2, 2, '0', STR_PAD_LEFT);
	
	$date_time = $year."-".$month."-".$day." ".$time3;

	//mysql_query ("INSERT INTO olympics (name_olympiad, date, location,terms,description) VALUES('$name_olimp','$dt1','$location_olimp','$date_application','$description_olimp')",$db);
	
	//mysql_query("INSERT INTO olympics  (date) VALUES ('$date_time') WHERE id='$id'",$db);
	$result = mysql_query("SELECT    *    FROM    olympics WHERE id='$id'"); //извлекаем    идентификатор пользователя с данным логином
    $myrow    = mysql_fetch_array($result);
	
    $value   = $myrow['date'].$date_time."!";
	mysql_query("UPDATE olympics SET date='$value' WHERE id='$id'",$db);
	//echo $date_time;
	
}
 
//mysql_query ("INSERT INTO olympics (name_olympiad, location,terms,description) VALUES('$name_olimp','$location_olimp','$date_application','$description_olimp')");

	exit("<html><head><meta http-equiv='Refresh' content='0; URL=../index.php'></head></html>");
?>
