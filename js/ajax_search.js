function search_chq(){

	var xmlobj;
	var url;
	rec=document.getElementById('search').value;
	if(rec.length==0){
	alert("Enter Some Cheque No:");	
	document.getElementById('search').focus();
	return false;
	}else{
	url="../modules/mod_ajxa_search.php?a=" + rec ;
		if(window.XMLHttpRequest()){
			xmlobj=new XMLHttpRequest();
		}else{
			xmlobj=new ActiveXobject("Microsoft.XMLHTTP");
		}
	
	xmlobj.onreadystatechange=function(){
		if((xmlobj.readystate==4)||(xmlobj.status==200)){
			document.getElementById('replace').innerHTML=xmlobj.responseText;
		}
	}
	
xmlobj.open("GET",url,true);
xmlobj.send(null)
	}
}
