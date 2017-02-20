<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="../style.css" media="screen" />
<?php
 require_once '../bd.php';
    
    //$MySQLRecordSet = mysql_query('SELECT Fio_schoolboy, rating FROM schoolboy ORDER BY rating DESC LIMIT 10');
$res = mysql_query('SELECT Users_id, Fio_schoolboy, rating FROM schoolboy ORDER BY rating DESC LIMIT 10');
$i=0;
while($row=mysql_fetch_array($res))
	
{	
	$row1 = explode("!", $row[Fio_schoolboy]);
	//$row1[id] = $row[id];
	//foreach ($row1 as $v) {
		//echo '<p>'.$v.'</p>';
	//}
	$row3[$i]= array('Users_id'=>$row[Users_id],'rating'=>$row[rating], 'Fio_schoolboy'=>$row1); 
	$i=$i+1;
}
$data = '[';	
for($i=0, $arr_l=count($row3); $i<=$arr_l; $i++){
		//echo'<p>'.$row3[$i]["Fio_schoolboy"][$l].'<p>';
	for($l=0, $arr_l1=count($row3[$i]["Fio_schoolboy"])-2; $l<$arr_l1; $l=$l+2){
		
		$data .= '{"Users_id": "' .$row3[$i]["Users_id"]. '","rating": "' .$row3[$i]["rating"]. '","Fio_schoolboy": "' .$row3[$i]["Fio_schoolboy"][$l] ." ". $row3[$i]["Fio_schoolboy"][$l+1]. '"},';
		//echo'<p>'.$row3[$i]["Fio_schoolboy"][$l].'<p>';
	}
	
}
$data .= ']';

echo '<pre>' . print_r($data, true) . '</pre>';

?>
    
	
	
	<table id="bestt">
    <tr id="besttr"> <td></td><td >Победители олимпиады</td> <td></td></tr>

	
   
<?  $j = 0;
    {
?>
        
			
<?      
		for($i=0, $arr_l=count($row3); $i<=$arr_l; $i++){
			for($l=0, $arr_l1=count($row3[$i]["Fio_schoolboy"])-2; $l<$arr_l1; $l=$l+2){
?>
			<tr class="besttd">
		<td class="table_reiting_td"><? $j =$j+1;
			echo $j; ?></td>
			
           <td class="table_reiting_td"><a href="../lk_href.php?id=<?echo $row3[$i]["Users_id"]?>"> <? echo $row3[$i]["Fio_schoolboy"][$l] ." ". $row3[$i]["Fio_schoolboy"][$l+1]; ?></a></td>
		   <td class="table_reiting_td"><?echo $row3[$i]["rating"] ?></td> </tr>
<?               
	} 
	}
    }
?>
<tr id="best_a"> <td></td><td> <a id="best_a_a" href="../reiting.php">Общий рейтинг участников</a><td></td> </td></tr>
</table>
 <table >
	
</table>