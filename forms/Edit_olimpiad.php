﻿<?php
session_start();
include ("js/select_subject.js");
?>
	<form id="form" action="" method="post">
		<p>
			<label id="lk_schoolboy" >Название олимпиады</label>
			<input id="name_olimp" class="create_text" name="name_olimp" required type="text" >
		</p>
		<div>
		
			<div id="div_p_date_olimp">
				<label id="lk_schoolboy" >Дата проведения</label>
		
						
			</div>
		</div>
	<p id="knopka_retain__""><input type="button" id="knopka_retain1" onclick="create_date(number_date)" value="Добавить этап"></p>	
		<div class="lk_schoolboy_blok">
		<div>
			<label id="lk_schoolboy">Место проведения</label>
			<input id="location_olimp" class="create_text" name="location_olimp" required type="text" >
		</div>
		<div id="org_block">
			<label id="lk_schoolboy">Организатор</label>
			<input id="Org_olimp" name="Org_olimp" type="text" >
		</div>
		<div>
			<label id="lk_schoolboy">Срок подачи заявки</label>
				<label class="do" >до</label>
				<select name="day0" class="day_class" required id="day0"></select>
				<select name="month0" class="month_class" required id="month0" onchange="check(id)"  ></select>
				<select name="year0"  class="years_class" required id="year0" onchange="check(id)"  ></select>
		</div>
		</div>
		<div class="lk_schoolboy_blok">
		<div>
		<label id="lk_schoolboy">Класс</label>
			<input type="checkbox" onclick="status_chek()" id="class_olimp1" name="class_olimp1" value="ON" > <label>1</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp2" id="class_olimp2"  value="ON"> <label>2</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp3" id="class_olimp3"  value="ON"> <label>3</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp4" id="class_olimp4"  value="ON"> <label>4</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp5" id="class_olimp5"  value="ON"> <label>5</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp6" id="class_olimp6"  value="ON"> <label>6</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp7" id="class_olimp7"  value="ON"> <label>7</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp8" id="class_olimp8"  value="ON"> <label>8</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp9" id="class_olimp9"  value="ON"> <label>9</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp10" id="class_olimp10"  value="ON"> <label>10</label>
			<input type="checkbox" onclick="status_chek()" name="class_olimp11" id="class_olimp11"    value="ON"> <label>11</label>
		</div>
		<div>
			<label id="lk_schoolboy">Предмет</label>		
			<SELECT  id="select_subject" required name="select_subject" size="1" onchange="select_subject_activation(select_subject.value,select_subject.id)">			
			   <option value="">Список предметов</option>
			   <option>Математика</option>
			   <option>Русский язык</option>
			   <option>Информатика</option>
			   <option>Обществознание</option>
			   <!--<option value="1">Математика
			   <option value="2">Русский язык
			   <option value="3">Информатика
			   <option value="4">Обществознание-->
			</SELECT>
		</div>
		</div>
		
		<div>
			<label id="lk_schoolboy">Описание</label>
			<textarea style="" id="description_olimp" required name="description_olimp"></textarea>		
		</div>
		<div id="div_none">
			<input id="number_date" style="display: none;" name="number_date" type="text" >
			<input id="subject_string" style="display: none;" name="subject_string" type="text" >
		</div>
		
		<div style="margin-top: 100px;" class="button_all">
			<input type="submit" class="knopka_retain" name="submit_create" value="Сохранить изменения">
			<input type="button" onclick="location_cancel()" class="knopka_cansel" name="submit_cancel" value="Отмена">
		</div>
	
	
	
	
	</form>
		
</body>
</html>
<script>
	function location_cancel(){		
		document.location.href="../index.php";
	}
	document.getElementById('form').action='bd/edit_olimpiada.php?'+'id='+<?echo $_GET['id'];?>;	
	var stroka="";
	var par2={		
		"id": <?echo $_GET['id'];?>,		
	}
	$.ajax({
		type: "POST",
		url: "bd/edit_olymp.php",
		data: 'jsonData=' + JSON.stringify(par2),  
		success: function(html){
			html=JSON.parse(html);
			document.getElementById('name_olimp').value=html.name_olympiad;						
			document.getElementById('location_olimp').value=html.location;						
			var str=html.subject;			
			do {
				var from = str.search('!'); 
				var to = str.length;
				newstr = str.substring(0,from);
				str=str.substring(from+1,to);	
				select_subject_activation(newstr,"select_subject")								
			} while (str.length>0);
			
		
			var str=html.classes;			
			do {
				var from = str.search(','); 
				if(from!=-1){
					var str2=str.substring(0,from);
					var from2 = str2.search('-'); 
					if(from2!=-1){
						var ii=str2.substring(0,from2);
						var i2=str2.substring(from2+1,str2.length);
					
						for(var i=Number(ii);i<= Number(i2);i++){
							document.getElementById('class_olimp'+i).checked=true;
					
						}
					}
					else{
						document.getElementById('class_olimp'+str2).checked=true;
					}
					str=str.substring(from+1,str.length);
										
				}
				else{
					var from = str.search('-'); 
					if(from!=-1){
						var ii=str.substring(0,from);
						var i2=str.substring(from+1,str.length);
					
						for(var i=Number(ii);i<= Number(i2);i++){
							document.getElementById('class_olimp'+i).checked=true;
						
						}
					}
					else{
						document.getElementById('class_olimp'+str).checked=true;
					}
					str=str.substring(0,0);
			
				}
				
					
			} while (str.length>0);
			
		
			
			str=html.terms;
			
		var from = str.search('-'); 
		var to = str.length;
		newstr = str.substring(0,from);
		str=str.substring(from+1,to);							
		document.getElementById('year0').value=newstr;							
		var from = str.search('-'); 
		var to = str.length;
		newstr = str.substring(0,from);
		str=str.substring(from+1,to);							
		document.getElementById('month0').value=Number(newstr);						
		document.getElementById('day0').value=Number(str);
			
			
		var ii=0;
		var str=html.date;	
			
			/*var from = str.search('!'); 
			var to = str.length;
			newstr = str.substring(0,from);
			str=str.substring(from+1,to);				
			//document.getElementById('dt1').value=newstr.substring(0, newstr.search(' '));	

				newstr2=newstr;				
				var from2 = newstr2.search('-'); 
				var to2 = newstr2.length;
				//alert(newstr2.substring(0, from2));
				document.getElementById('year'+1).value=newstr2.substring(0, from2);
				newstr2=newstr2.substring(from2+1, newstr2.length);
				
				
				create_date2(document.getElementById('number_date').value,newstr);	
				var from2 = newstr2.search('-'); 
				var to2 = newstr2.length;
				document.getElementById('month'+1).value=Number(newstr2.substring(0, from2));
				
				newstr2=newstr2.substring(from2+1, newstr2.length);
				
				var from2 = newstr2.search(' '); 
				var to2 = newstr2.length;
				document.getElementById('day'+1).value=Number(newstr2.substring(0, from2));
				newstr2=newstr2.substring(from2+1, newstr2.length);

			
			document.getElementById('1time1').value=newstr.substring(newstr.search(' ')+1, newstr.search(':'));			
			document.getElementById('2time1').value=newstr.substring(newstr.search(':')+1, newstr.length);			
			*/
			flag=true;
			do {
				
				var from = str.search('!'); 
				var to = str.length;
				newstr = str.substring(0,from);
				str=str.substring(from+1,to);	
				//alert(newstr);
				//select_subject_activation(newstr,"select_subject")	
				create_date2(document.getElementById('number_date').value,newstr);	
				
			//	document.getElementById('dt'+document.getElementById('number_date').value).value=newstr.substring(0, newstr.search(' '));
				
				newstr2=newstr;
				//str2=newstr.substring(0, newstr.search(' '));
				
				var from2 = newstr2.search('-'); 
				var to2 = newstr2.length;
				//document.getElementById('day'+document.getElementById('number_date').value).value=10;
				//alert(from2);
				document.getElementById('year'+document.getElementById('number_date').value).value=newstr2.substring(0, from2);
				newstr2=newstr2.substring(from2+1, newstr2.length);
				
				var from2 = newstr2.search('-'); 
				var to2 = newstr2.length;
				//document.getElementById('day'+document.getElementById('number_date').value).value=10;
				//alert(from2);
				document.getElementById('month'+document.getElementById('number_date').value).value=Number(newstr2.substring(0, from2));
				newstr2=newstr2.substring(from2+1, newstr2.length);
				
				var from2 = newstr2.search(' '); 
				var to2 = newstr2.length;
				//document.getElementById('day'+document.getElementById('number_date').value).value=10;
				//alert(newstr2.substring(0, from2));
				document.getElementById('day'+document.getElementById('number_date').value).value=Number(newstr2.substring(0, from2));
				newstr2=newstr2.substring(from2+1, newstr2.length);
				//alert(newstr2);
				
				document.getElementById('1time'+document.getElementById('number_date').value).value=newstr.substring(newstr.search(' ')+1, newstr.search(':'));			
				document.getElementById('2time'+document.getElementById('number_date').value).value=newstr.substring(newstr.search(':')+1, newstr.length);		
				if(flag==true){
					document.getElementById('btn1').style.opacity=0.5;
					flag=false;
				}
				else{
					document.getElementById('btn1').style.opacity=1;
				}
				
				//document.getElementById('time'+document.getElementById('number_date').value).value=newstr.substring(newstr.search(' ')+1, newstr.length);		
			} while (str.length>0);
			
			
			document.getElementById('description_olimp').value=html.description;						
			status_chek();	
		}	
	});		
	
	form = document.getElementById('form'); 
	form.subject_string.value = "";
	form.number_date.value = "";
	document.getElementById('Org_olimp').value=<?echo $_SESSION['id'];?>;
	document.getElementById('org_block').style.display="none";
	//document.getElementById('class_olimp11').checked=true;
	
	
	/*
	window.onload = function () {
    var day = new Date,
        md = (new Date(day.getFullYear(), day.getMonth() + 1, 0, 0, 0, 0, 0)).getDate(),
        $month_name = "января февраля марта апреля мая июня июля августа сентября октября ноября декабря".split(" ");
	create_date2(document.getElementById('number_date').value);	
    function set_select(a, c, d, e) {
        var el = document.getElementsByName(a)[0];
        for (var b = el.options.length = 0; b < c; b++) {
			if(a.search('month') != -1)
			{
				el.options[b+1] = new Option(month_name[b],b + d);
			}
			else{
				el.options[b+1] = new Option(a == 'month1' ? $month_name[b] : b + d, b + d);
			}
            
         }
        el.options[0] = new Option(e);
    }
    set_select("day1", md, 1, day.getDate() - 1);
    set_select("month1", 12, 1, day.getMonth());
    set_select("year1", 11, day.getFullYear(), 10);
	
		set_select("day0", md, 1, "дд");
		set_select("month0", 12, 1, "мм");
		set_select("year0", 11, day.getFullYear(), "гг");
 
   // document.getElementsByName('hour')[0].value = day.getHours();
   // document.getElementsByName('minute')[0].value = day.getMinutes();
 
    var year1 = document.getElementById('year1');
    var month1 = document.getElementById("month1");
 
    function check_date() {
        var a = year1.value | 0,
            c = month1.value | 0;
			
        md = (new Date(a, c, 0, 0, 0, 0, 0)).getDate();
        a = document.getElementById("day1").selectedIndex;
		
        set_select("day", md, 1, a);
    };
	

	
	
   // if (document.addEventListener) {
     //   year.addEventListener('change', check_date, false);
    //    month.addEventListener('change', check_date, false);
 
  //  } else {
  //      year.detachEvent('onchange', check_date);
  //      month.detachEvent('onchange', check_date);
  //  }

}
*/
		
	 var day = new Date,
        md = (new Date(day.getFullYear(), day.getMonth() + 1, 0, 0, 0, 0, 0)).getDate();
        var month_name = "января февраля марта апреля мая июня июля августа сентября октября ноября декабря".split(" ");

	var year1 = document.getElementById('year1');
	var month1 = document.getElementById("month1");
	function check(id){
		id=id.replace("year","");
		id=id.replace("month","");
		year1 = document.getElementById('year'+id);
		month1 = document.getElementById("month"+id);
		//alert(id);
		check_date(id);
	}
	function check_date(id) {
        var a = year1.value | 0,
            c = month1.value | 0;
			
        md = (new Date(a, c, 0, 0, 0, 0, 0)).getDate();
        a = document.getElementById("day"+id).selectedIndex;
		
        set_select("day"+id, md, 1, a);
    };	 
	function set_select(a, c, d, e) {
		id=a.replace("year","");
		id=a.replace("month","");
		id=a.replace("day","");
		//alert(id);
        var el = document.getElementsByName(a)[0];
		//if()
        for (var b = el.options.length = 0; b < c; b++) {
			if(a.search('month') != -1)
			{
				el.options[b] = new Option(month_name[b],b + d);
			}
			else
            el.options[b] = new Option(a == ('month'+id) ? month_name[b] : b + d, b + d);
        }
        el.options[e] && (el.options[e].selected = !0)
		/*if(a.search('day') != -1){el.options[0] = new Option("дд");}
		if(a.search('month') != -1){el.options[0] = new Option("мм");}
		if(a.search('year') != -1){el.options[0] = new Option("гг");}*/
		//alert(document.getElementById('dt1').value);
	  
    }
			
		set_select("day0", md, 1, "дд");
		set_select("month0", 12, 1, "мм");
		set_select("year0", 11, day.getFullYear(), "гг");	
	function status_chek(){
		flag=false;
		for(i=1;i<12;i++){
			if(document.getElementById('class_olimp'+i).checked==true){
				flag=true;
			}
		}
		if(flag==false){
			document.getElementById('class_olimp1').required=true;
		}
		else{
			
			document.getElementById('class_olimp1').required=false;
		}
	}
</script>