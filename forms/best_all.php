<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
<?php
 require_once 'bd.php';   
	$res = mysql_query('SELECT Users_id, Fio_schoolboy, school , class as class1, rating FROM schoolboy INNER JOIN users ON Users_id = id WHERE activation = 1 and rating > 0 ORDER BY rating DESC');
	
	$i=0;
	while($row=mysql_fetch_array($res))
		
	{	
		$row1 = explode("!", $row[Fio_schoolboy]);
		
		$row3[$i]= array('Users_id'=>$row[Users_id], 'rating'=>$row[rating], 'school'=>$row[school], 'class'=>$row[class1], 'Fio_schoolboy'=>$row1); 
		$i=$i+1;
	}
?>

<table id="table_reiting">
    <thead id="table_reiting_thead">
    <tr >
        <td class="table_reiting_td">№
        </td>
        <td class="table_reiting_FIO">ФИО
            <input id="regexp" />
        </td>
        <td class="table_reiting_td">
            <select id="digits">
            <option class = "option"  value="">Школа</option>    
				
<?				
$query = 'SELECT school FROM schoolboy inner join users on Users_id=id where activation = 1 GROUP BY school';
$result = mysql_query($query);

while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
   echo '<option class = "option" value="'.$line['school'].'" >'.$line['school'];
          }

?>
                
            </select>
        </td>
        <td class="table_reiting_td">
            <select id="digits1">
                <option class = "option" value="">Класс</option>
                <option class = "option" value="1">1</option>
                <option class = "option" value="2">2</option>
                <option class = "option" value="3">3</option>
				<option class = "option" value="4">4</option>
				<option class = "option" value="5">5</option>
				<option class = "option" value="6">6</option>
				<option class = "option" value="7">7</option>
				<option class = "option" value="8">8</option>
				<option class = "option" value="9">9</option>
				<option class = "option" value="10">10</option>
				<option class = "option" value="11">11</option>
            </select>
        </td>
        <td class="table_reiting_td_shapka" onclick="sort(document.getElementById('table_reiting_td1'))">Итоговый балл
        </td>
    </tr>
    </thead>
    <tbody id="target">
        <tr><td></td><td></td><td></td><td></td><td></td></tr>
		<? $j = 0
			
		?>
		
		

<?        for($i=0, $arr_l=count($row3); $i<=$arr_l; $i++){
			for($l=0, $arr_l1=count($row3[$i]["Fio_schoolboy"])-1; $l<$arr_l1; $l=$l+3){?>
			<tr class="besttd">
		   <td class="table_reiting_td"><? $j =$j+1; echo $j; ?> </td>
           <td class="table_reiting_td"><a id="best_href1" href="../lk_href.php?id=<?echo $row3[$i]["Users_id"]?>"> <? echo $row3[$i]["Fio_schoolboy"][$l] ." ". $row3[$i]["Fio_schoolboy"][$l+1]." ". $row3[$i]["Fio_schoolboy"][$l+2]; ?></a></td>
		   <td class="table_reiting_td"><?echo $row3[$i]["school"] ?></td>
		   <td class="table_reiting_td"><?echo $row3[$i]["class"] ?></td>
		   <td id="table_reiting_td1"><?echo $row3[$i]["rating"] ?></td> </tr>
<?                
	} 

    }
?>
    
    </tbody>
<tr id ="tr1"><td></td><td></td><td></td><td></td><td></td></tr>	
</table>

<script src="js/filterTable.v1.0.min.js"></script>
<script>
	function sort(el) {
   var col_sort = el.innerHTML;
   var tr = el.parentNode;
   var table = tr.parentNode;
   var td, arrow, col_sort_num;

   
    for (var i=0; (td = tr.getElementsByTagName("td").item(i)); i++) {
    if (td.innerHTML == col_sort) {
            col_sort_num = i;
            if (td.prevsort == "y"){

                el.up = Number(!el.up);
				td.prevsort ="n";
            }else{
                td.prevsort = "y";

                el.up = 0;
            }

        }else{
            if (td.prevsort == "n"){
                td.prevsort = "y";
            }
        }
    }
 
     var a = new Array();
 
    for(i=1; i < table.rows.length; i++) {
        a[i-1] = new Array();
        a[i-1][0]=table.rows[i].getElementsByTagName("td").item(col_sort_num).innerHTML /1000000;
        a[i-1][1]=table.rows[i];
     }

     a.sort();
     if(el.up) a.reverse();

     for(i=0; i < a.length; i++)
     table.appendChild(a[i][1]);
}

    filterTable( document.getElementById("target"), {
            /* Фильтр для второго столбца текстовое поле - только точное совпадение: */
            1: filterTable.Filter(document.getElementById("regexp"),
			/* Коллбэк ф-ция
				валидации */
			function (value, filters, i) {
				var c_value = value.toLowerCase(),
					f_value = filters[i].value.toLowerCase();
					if( c_value.indexOf(f_value)>-1){
						return true;
					}
					else{
						return false;
					}
			
			},
			/* Будем вызывать
				валидацию по событию
				onkeyup фильтра */
			"onkeyup"
            ),
			

            /* Фильтр для третьего столбца выпадающий список: */
            2: document.getElementById("digits"),

            /* Фильтр для четвертого столбца радио кнопки: */
            3: document.getElementById("digits1"),
        }
    );
</script>
