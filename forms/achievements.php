<?php
	session_start();
?>
<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8"> 
<div id="ach1">
	<p><label>Место в рейтинге:</label><label id="place_in_the_ranking"></label></p>
	<p><label id="count_olympiad">Кол-во олимпиад: </label></p>
</div>

<div class="cont">
    <table id="bestt">
		<tr id="besttr"><td>Достижения<td></tr>
		<tbody id="target1">
		<tbody>
		<tr id ="tr1"><td></td><td></td></tr>
</table>
</div>
<script>	
	var par2={	
		'id':<?php echo $_SESSION['id'];?>,						
	}	
	$.ajax({
		type: "POST",
		url: "../bd/achievements_list.php",
		data: 'jsonData=' + JSON.stringify(par2),  
		success: function(html){
			html=JSON.parse(html);		
			var array_name_olympiad=html.array_name_olympiad;
			var array_place=html.array_place;
			var array_id_olympiad=html.array_id_olympiad;
			
			if((array_id_olympiad.length==1)&&(array_id_olympiad[0]=="")){
				array_id_olympiad.length = 0;
			}
			
			document.getElementById('count_olympiad').innerHTML=document.getElementById('count_olympiad').innerHTML+array_id_olympiad.length;
						
			for(var i=0;i<array_id_olympiad.length;i++){
				if(array_place[i]=="0"){
						array_place[i]="-";			
				}
				if(array_place[i]=="1"){
					array_place[i]="I степень";		
				}
				if(array_place[i]=="2"){
					array_place[i]="II степень";				
				}
				if(array_place[i]=="3"){
					array_place[i]="III степень";				
				}	
				
			if(i%2 == 0){
				document.getElementById('target1').innerHTML=document.getElementById('target1').innerHTML+'<tr style="background:#E4F3FC;">'+'<td class="table_reiting_td">'+array_place[i]+'</td>'+'<td style="text-decoration: underline; max-width: 207px;" class="table_reiting_td" onclick="onclick_olimp(id)" id='+html.array_id_olympiad[i]+'>'+array_name_olympiad[i]+'</td>'+'</tr>';						
			}
			else{
				document.getElementById('target1').innerHTML=document.getElementById('target1').innerHTML+'<tr style="background:#C3DCE9;">'+'<td class="table_reiting_td">'+array_place[i]+'</td>'+'<td style="text-decoration: underline; max-width: 207px;" class="table_reiting_td" onclick="onclick_olimp(id)" id='+html.array_id_olympiad[i]+'>'+array_name_olympiad[i]+'</td>'+'</tr>';						
			}
			}
			document.getElementById('place_in_the_ranking').innerHTML+=html.array_number_rating;
			document.getElementById('place_in_the_ranking').onclick= function() {document.location.href='../reiting.php';}
		}
	});
	function onclick_user(id){
		
		document.location.href='../lk_href.php?'+'id='+id;	
		
	}
	function onclick_olimp(id){
		
		document.location.href='../arhiv_result.php?'+'id='+id;	
	}
</script>