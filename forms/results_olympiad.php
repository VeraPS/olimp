	<label id="week" onclick="periud(7)">неделя</label>
	<label id="month" onclick="periud(31)">за месяц</label>
	<label id="all">показать все</label>
	<div id="-1">
	</div>
<script> 
			var date_vidod = [];
			var count_record=0;
			var par2={				
				}
			$.ajax({
				type: "POST",
				url: "../bd/past_olympiad.php",
				data: 'jsonData=' + JSON.stringify(par2),  
				success: function(html){						
					html=JSON.parse(html);	
						count_record=html.array_id.length;
							for(var i=0;i<html.array_id.length;i++){
								create_div_olimpics(i,html.array_id[i],html.array_name_olympiad[i],html.array_subject[i],html.array_classes[i],html.array_date[i]);
							}
						
					
				}
			});
	function periud(n){	
		for(var i=0;i<n;i++){
			document.getElementById(date_vidod[i]).style.display="block";
		}
		for(var i=n;i<count_record;i++){
			document.getElementById(date_vidod[i]).style.display="none";
		}
		
	}	
	function action_olimpiad(id){
		var str=id;
		var from = str.search('name'); 
		var to = str.length;
		var newstr = str.substring(0,from);
		//alert(newstr);			
		document.location.href='../olimpiada.php?'+'id='+newstr;	
	}
	
	function  create_div_olimpics(i,id, name, subject, classes, date){
			var div_elem = document.createElement('div');
			div_elem.id=i;			
			var label_date = document.createElement('label');		
			label_date.id =i+'date';			

			var str = date;	
			
			var from = str.search('!'); 
			var to = str.length;
			var newstr = str.substring(0,from);
			var dat = new Date(newstr);		
		
			label_date.value=newstr;		
			label_date.innerHTML = newstr;
			div_elem.appendChild(label_date);
			
			
			var label_name = document.createElement('label');		
			label_name.id =id+'name';
			label_name.innerHTML = name;
				
			label_name.onclick= function(){action_olimpiad(label_name.id);};
			div_elem.appendChild(label_name);				
			
			var label_classes= document.createElement('label');		
			label_classes.id =i+'classes';
			label_classes.innerHTML = 'Класс '+classes;
			div_elem.appendChild(label_classes);
			
			var label_subject= document.createElement('label');		
			label_subject.id =i+'subject';
			label_subject.innerHTML =subject;
			div_elem.appendChild(label_subject);
			
			var next_elem=-1;
			for(var j=0;j<i;j++){
		
				var next=document.getElementById(date_vidod[j]+'date').value;	
				var dat2 = new Date(next);					
				if(dat<dat2){
					next_elem=date_vidod[j];
				}
			}
			if(i==0){
				next_elem=-1;
				date_vidod[i]=next_elem+1;
			}	
			else{
				for(var j=i;j>next_elem;j--){
					date_vidod[j]=date_vidod[j-1];				
				}
				date_vidod[next_elem+1]=i;
			}
		
		
			next_elem=document.getElementById(next_elem);
			if(next_elem.nextSibling){
				next_elem.parentNode.insertBefore(div_elem, next_elem.nextSibling);
			}
			else{
				next_elem.parentNode.appendChild(div_elem);
			}	

					
	}
</script>
 

