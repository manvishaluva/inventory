
function sorting(){
	var xobj;
	
	for(var i=0;i<3;i++){
		if(document.frm1.sort1[i].checked==true){
			var value=document.frm1.sort1[i].value;
			break;
		}
	}
	

				if(window.XMLHttpRequest()){
					xobj=new XMLHttpRequest();	
				}else{
					xobj=new ActiveXobject("Microsoft.XMLHTTP");
				}
				
				url="../modules/mod_sort.php?type="+value;
				

				xobj.onreadystatechange=function(){
					if((xobj.readystate==4)||(xobj.status==200)){
						
						document.getElementById('replace').innerHTML=xobj.responseText;
						
					}
				}	
				xobj.open("GET",url,true);
				xobj.send(null);
				
}
