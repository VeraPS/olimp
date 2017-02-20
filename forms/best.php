<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<?php
 require_once 'bd.php';
  $f=0;  
    //$MySQLRecordSet = mysql_query('SELECT Fio_schoolboy, rating FROM schoolboy ORDER BY rating DESC LIMIT 10');
$rest = mysql_query('SELECT Users_id, Fio_schoolboy, rating FROM schoolboy INNER JOIN users ON Users_id = id WHERE activation = 1 and rating > 0 ORDER BY rating DESC limit 10');

while($row=mysql_fetch_array($rest))
	
{	
	$row1 = explode("!", $row[Fio_schoolboy]);
	//$row1[id] = $row[id];
	//foreach ($row1 as $v) {
		//echo '<p>'.$v.'</p>';
	//}
	$row7[$f]= array('Users_id'=>$row[Users_id],'rating'=>$row[rating], 'Fio_schoolboy'=>$row1); 
	$f=$f+1;
}

?>
    
	
	
	<table id="bestt">
    <tr id="besttr" class="cursorik"> <td></td><td >Победители олимпиад</td> <td></td></tr>

	
   
<?  $j = 0;
    
?>
        
			
<?      if (count($row7)>=10){$qwe=10;}
		else {$qwe=count($row7);}
		for($i=0, $arr_l=$qwe; $i<$arr_l; $i++){
			for($l=0, $arr_l1=count($row7[$i]["Fio_schoolboy"])-2; $l<$arr_l1; $l=$l+2){
?>
			<tr class="besttd">
		<td class="table_reiting_td"><? $j =$j+1;
			echo $j; ?></td>
			
           <td class="table_reiting_td"><a id="best_href" href="../lk_href.php?id=<?echo $row7[$i]["Users_id"]?>"> <? echo $row7[$i]["Fio_schoolboy"][$l] ." ". $row7[$i]["Fio_schoolboy"][$l+1]; ?></a></td>
		   <td class="table_reiting_td"><?echo $row7[$i]["rating"] ?></td> </tr>
<?               
	} 
	}
?>
<tr id="best_a"> <td></td><td> <a id="best_a_a" href="../reiting.php">Общий рейтинг участников</a><td></td> </td></tr>
</table>
 <table >
	
</table>