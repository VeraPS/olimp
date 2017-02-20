<?php
	session_start();	
	require_once 'bd.php';
	 include ("js/fio.js");
?>
<html>

<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8"> 
<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<div class="cont">

    <table id="Number_tr" >
		<thead id="table_reiting_thead">
		<tr class="table_reiting_FIO"> 
			<td> № </td> 
			<td >ФИО
            <input id="regexp" />
        </td>
		
			<td> Школа </td>
			<td class="table_reiting_td">
            <select id="digits1" >
                <option value="">Класс</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
            </select>
        </td>
			<td> Итоговый балл </td>
			<td class="table_reiting_td">
            <select id="digits">
            <option value="">Диплом</option>    
			<option value="-">-</option>
            <option value="I степень">I степень</option>
            <option value="II степень">II степень</option>	
			<option value="III степень">III степень</option>					
            </select>
        </td>
		</tr>
		
		<thead>
</table>
</div>



<script>
	/*$(function()	{
			$('#Number_tr').click(function()	{
				//document.getElementById('rara').focus();
				document.activeElement.focus();
				//alert("dsa");
			});
		});*/
				
	/*	$(window).keydown(function(event){			
			if(event.keyCode == 13) {	//если это Enter
				//document.activeElement.blur();
				
				//$('Number_user').focus();
				//$('Number_user').blur();

				document.getElementById('place_rating').focus();
				document.getElementById('place_rating').blur();
			}
		});*/
	var get_id=<?php echo $_GET['id'];?>;
	//alert(get_id);
	var arr_id_user = [];
	var arr_place = [];
	var arr_rating = [];
	var par2={
				
				"id": get_id,
				"action": "id_schoolboy",
				}
				
			$.ajax({
				type: "POST",
				url: "../bd/past_result_olympiad_edit.php",
				data: 'jsonData=' + JSON.stringify(par2),  
				success: function(html){
					html=JSON.parse(html);
					arr_id_user=html.schoolboy_users_id;
					arr_rating=html.rating_mark;
					arr_place=html.place;
					
					var schoolboy_users_id =html.schoolboy_users_id;
					var rating_mark =html.rating_mark;	
					var place =html.place;	
					
					if((schoolboy_users_id.length==1)&&(html.schoolboy_users_id[0]=="")){
						schoolboy_users_id.length=0;
					}
					for(var i=0;i<schoolboy_users_id.length;i++){
						if(i%2==0){
							var color="fon_table";
						}
						else
						{
							var color="fon_table2";
						}
						if(html.place[i]=="0"){
							html.place[i]="-";			
						}
						if(html.place[i]=="1"){
							html.place[i]="I степень";		
						}
						if(html.place[i]=="2"){
							html.place[i]="II степень";				
						}
						if(html.place[i]=="3"){
							html.place[i]="III степень";				
						}
						document.getElementById('Number_tr').innerHTML=document.getElementById('Number_tr').innerHTML+'<tr class="'+color+'" >'+'<td>'+(i+1)+'</td>'+'<td   id='+html.schoolboy_users_id[i]+' onclick="onclick_user(id)">'+FIO_1(html.array_fio[i])+'</td>'+'<td>'+html.array_school[i]+'</td>'+'<td>'+html.array_classes[i]+'</td>'+'<td id="rating'+i+'">'+html.rating_mark[i]+'</td>'+'<td id="place'+i+'">'+html.place[i]+'</td>'+'</tr>';
						
						
						//document.getElementById('t').innerHTML='<p>'+document.getElementById('t').innerHTML+schoolboy_users_id[i];
					}
					document.getElementById('Number_tr').innerHTML=document.getElementById('Number_tr').innerHTML+'<tr id="tr1"><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
					
				}
			});	

		
	
		function cancel(){
			document.location.href="../arhiv.php";
			
		}
		function onclick_user(id){
			document.location.href="../lk_href.php?id="+id;
		}




	
</script>