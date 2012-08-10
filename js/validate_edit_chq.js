// JavaScript Document
function validate(){
	
	if(document.forms[0].pmdate.value==""){
		alert("Enter Payment Date");
		document.forms[0].pmdate.focus();
		return false;
	}
	
	if(document.forms[0].vno.value==""){
		alert("Enter Voucher No:");
		document.forms[0].vno.focus();
		return false;
	}
	
	if(document.forms[0].acname.value==""){
		alert("Enter A/c  Name");
		document.forms[0].acname.focus();
		return false;
	}

	if(document.forms[0].amount.value==""){
		alert("Enter Amount");
		document.forms[0].amount.focus();
		return false;
	}

	if(document.forms[0].chqno.value==""){
		alert("Enter A Cheque No:");
		document.forms[0].chqno.focus();
		return false;
	}

	if(document.forms[0].chqdate.value==""){
		alert("Enter A Cheque Date");
		document.forms[0].chqdate.focus();
		return false;
	}

document.forms[0].submit();
	
}