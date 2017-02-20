<?php
 include ("js/fio.js");
?>
<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8"> 
<div class="cont">
	<table id="Number_tr" >
		<thead id="table_reiting_thead">
		<tr class="table_reiting_FIO"> 
			<td id="Number_user"> № </td> 
			<td> ФИО </td>
			<td> Статус </td>
		</tr>
</table>
</div>
<script>	
		var par2={	
				'rights':<?php echo $_SESSION['rights'];?>,
						
		}			

			$.ajax({
				type: "POST",
				url: "../bd/edit_user_list.php",
				data: 'jsonData=' + JSON.stringify(par2),  
				success: function(html){
					html=JSON.parse(html);		
					var array_id=html.array_id;
					var ii=0;
					for(var i=0;i<array_id.length;i++){
						if(html.array_name_rights[i]=="Администратор"){
							continue;
						}
						ii++;
						if(ii%2!=0){
							var color="fon_table";
						}
						else
						{
							var color="fon_table2";
						}
						document.getElementById('Number_tr').innerHTML=document.getElementById('Number_tr').innerHTML+'<tr class="'+color+'" onclick="onclick_user(id)" id='+html.array_id[i]+'>'+'<td>'+(ii)+'</td>'+'<td>'+FIO_1(html.array_name_user[i])+'</td>'+'<td>'+html.array_name_rights[i]+'</td>'+'</tr>';
						//document.getElementById('Number_user').innerHTML=document.getElementById('Number_user').innerHTML+i;
						
					}				
					//alert(html.array_name_user[1]);						
				}
			});
			function onclick_user(id){
				
				document.location.href='../edit_user_lk_admin.php?'+'id='+id;	
				
			}
</script>