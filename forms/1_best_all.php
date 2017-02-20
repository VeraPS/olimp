<meta charset="UTF-8">
<?php
 require_once 'bd.php';
 include ("js/fio.js");
    
    $MySQLRecordSet = mysql_query('SELECT Fio_schoolboy, school, class, rating FROM schoolboy ORDER BY rating DESC');
?>
    <table>
    <tr> 
	<td> № </td> 
	<td> ФИО </td>
	<td> Школа </td>
	<td> Класс </td>
	<td> Итоговый балл </td>
	</tr>

<?
    
?>
   
<?
    while($Result = mysql_fetch_assoc($MySQLRecordSet))
    {
?>
        <tr>
		
		<td><? $i =$i+1;
		echo $i; ?></td>

<?        foreach($Result as $k => $val)
        {
?>
            <td><? echo $val; ?></td>
<?                
	} 
?>
        </tr>
		
<?
    }
?>

</table>
 <table>
<tr></tr>
</table>