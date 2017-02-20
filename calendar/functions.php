<?php
session_start();
function get_events(){
	require_once 'config.php';
	$res = mysql_query("SELECT date, id FROM olympics WHERE Olympiad_status = 0");
	
	$i=0;
	$j=0;
	while($row=mysql_fetch_array($res)){
		
	$res1 = mysql_query("SELECT schoolboy_users_id, olympics_id FROM schoolboy_olympics where olympics_id = $row[id] ");	
	while($row32=mysql_fetch_array($res1))
		
	{	

		$row31[$i] .= $row32[schoolboy_users_id]."!"; 
		
	}
	$row1[$i] = explode("!", $row[date]);
		for($q=0, $arr_l=count($row1[$i]); $q<=$arr_l; $q++){
			if ($row1[$i][$q] >= date("Y-m-d 13:00")) {
				$row111[$i][$q]= $row1[$i][$q];
			}
		}
	$row33= explode("!", $row31[$i]);
	
	$row3[$i]= array('id'=>$row[id], 'date'=>$row111[$i], 'schoolboy_users_id'=>$row31[$i]); 
	$i=$i+1;
	}
	return $row3;
}

function get_json($arr){
	$data = '[';	
	for($i=0, $arr_l=count($arr); $i<$arr_l; $i++){

		for($l=0, $arr_l1=count($arr[$i]["date"]); $l<=$arr_l1; $l++){
			
			$data .= '{"id1": "' .$_SESSION['id']. '","id": "' .$arr[$i]["id"]. '","date": "' .date ("Y-m-d H:i:s", strtotime($arr[$i]["date"][$l])). '","schoolboy_users_id": "' .$arr[$i]["schoolboy_users_id"]. '"},';
			
		}
		
	}
	$data .= ']';
	return $data;
}

function print_arr($arr){
	echo '<pre>' . print_r($arr, true) . '</pre>';
}