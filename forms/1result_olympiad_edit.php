<?php
	session_start();
	include ("js/fio.js");	
?>
<html>

<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8"> 
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
<div class="cont">
	<div id="name_olymp_rezult">
	<label id="name_olymp_rezult"></label>
	</div>
    <table id="table_reiting">
		<tr id="table_reiting_thead"> 
			<td class="table_reiting_td"> № </td> 
			<td class="table_reiting_FIO">ФИО
        </td>
			<td class="table_reiting_td"> Школа </td>
			<td class="table_reiting_td"> Класс </td>
			<td class="table_reiting_td_shapka"> Итоговый балл </td>
			<td class="table_reiting_td"> Диплом </td>
		</tr>
		<tbody id="target1">
		<tbody>
		<tr id ="tr1"><td></td><td></td><td></td><td></td><td></td><td></td></tr>
</table>

</div>

<div style="margin-top:30px;" class="button_all">
	<input id="save_btn" type="button" class="knopka_retain" onclick="save_rezult()" value="Сохранить">
	<input id="cancel_btn" type="button" onclick="cancel()" class="knopka_cansel" value="Отменить">
</div>

<script>
	/*$(function()	{
			$('#table_reiting').click(function()	{
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
					
					document.getElementById('name_olymp_rezult').innerHTML=html.name_olymp_rezult;
					
					var schoolboy_users_id =html.schoolboy_users_id;
					var rating_mark =html.rating_mark;	
					var place =html.place;	
					
					if((schoolboy_users_id.length==1)&&(html.schoolboy_users_id[0]=="")){
						schoolboy_users_id.length=0;
					}
					for(var i=0;i<schoolboy_users_id.length;i++){
						if(i%2 == 0){
						document.getElementById('target1').innerHTML=document.getElementById('target1').innerHTML+'<tr style="background:#E4F3FC;">'+'<td class="table_reiting_td">'+(i+1)+'</td>'+'<td class="table_reiting_td"  onclick="onclick_user(id)" id='+html.schoolboy_users_id[i]+'>'+FIO_1(html.array_fio[i])+'</td>'+'<td class="table_reiting_td">'+html.array_school[i]+'</td>'+'<td class="table_reiting_td">'+html.array_classes[i]+'</td>'+'<td style=" border-right: 1px solid #0A3C57; padding: 0 5px 0 5px; " id="rating'+i+'" contenteditable="true">'+html.rating_mark[i]+'</td>'+'<td class="table_reiting_td" contenteditable="true"><select style=" color: #0A3C57;  background: none; border-style: none; " id="place'+i+'"><option class = "option" value="0">-</option><option class = "option" value="1">I степень</option><option class = "option" value="2">II степень</option><option class = "option" value="3">III степень</option></select></td>'+'</tr>';	
						}
						else{
						document.getElementById('target1').innerHTML=document.getElementById('target1').innerHTML+'<tr style="background:#C3DCE9;">'+'<td class="table_reiting_td">'+(i+1)+'</td>'+'<td class="table_reiting_td"  onclick="onclick_user(id)" id='+html.schoolboy_users_id[i]+'>'+FIO_1(html.array_fio[i])+'</td>'+'<td class="table_reiting_td">'+html.array_school[i]+'</td>'+'<td class="table_reiting_td">'+html.array_classes[i]+'</td>'+'<td style=" border-right: 1px solid #0A3C57; padding: 0 5px 0 5px; " id="rating'+i+'" contenteditable="true">'+html.rating_mark[i]+'</td>'+'<td class="table_reiting_td" contenteditable="true"><select style=" color: #0A3C57;  background: none; border-style: none; " id="place'+i+'"><option class = "option" value="0">-</option><option class = "option" value="1">I степень</option><option class = "option" value="2">II степень</option><option class = "option" value="3">III степень</option></select></td>'+'</tr>';
						}
					}
					for(var i=0;i<schoolboy_users_id.length;i++){
						var str="";
						if(arr_place[i]=="0"){
							document.getElementById('place'+i).options[0].selected=true;			
						}
						if(arr_place[i]=="1"){
							document.getElementById('place'+i).options[1].selected=true;			
						}
						if(arr_place[i]=="2"){
							document.getElementById('place'+i).options[2].selected=true;			
						}
						if(arr_place[i]=="3"){
							document.getElementById('place'+i).options[3].selected=true;			
						}						
					}					
				}
			});	

		
		function onclick_blur(){			
			for(var i=0;i<arr_id_user.length;i++){
				var val = document.getElementById('rating'+i).innerHTML;
				arr_rating[i]=val;
		
				var val2 = document.getElementById('place'+i).value;
				arr_place[i]=val2;	
				
				

			}			
		}
		function cancel(){
			document.location.href="../arhiv.php";
			
		}
		function save_rezult(){
			onclick_blur();
			//alert(get_id);
			var par2={				
				"arr_id_user": arr_id_user,
				"arr_place": arr_place,
				"arr_rating": arr_rating,
				"get_id": get_id,
			}
				
		$.ajax({
				type: "POST",
				url: "../bd/edit_rezult.php",
				data: 'jsonData=' + JSON.stringify(par2),  
				success: function(html){
					html=JSON.parse(html);
					
					
				}
			});	
			document.location.href="../arhiv.php";
		}
			
			//alert(document.getElementById(id).innerHTML);
			/*var code = '<input type="text" id="edit" value="'+val+'" />';
			$(document.getElementById(id)).empty().append(code);
			$('#edit').focus();
			$('#edit').blur(function()	{
				var val = $(this).val();
				$(this).parent().empty().html(val);
			});*/
	
	/*	$(window).keydown(function(event){
			//ловим событие нажатия клавиши
			if(event.keyCode == 13) {	//если это Enter
				$('#edit').blur();	//снимаем фокус с поля ввода
			}
		});*/
		
	/*$(function()	{
	$('td').click(function(e)	{
		
		//ловим элемент, по которому кликнули
		var t = e.target || e.srcElement;
		//получаем название тега
		var elm_name = t.tagName.toLowerCase();
		//если это инпут - ничего не делаем
		if(elm_name == 'input')	{return false;}
		var val = $(this).html();
		var code = '<input type="text" id="edit" value="'+val+'" />';
		$(this).empty().append(code);
		$('#edit').focus();
		$('#edit').blur(function()	{
			var val = $(this).val();
			$(this).parent().empty().html(val);
		});
	});
});*/


	
</script>