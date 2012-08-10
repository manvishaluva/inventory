function validate()
{
		if(document.getElementById("opass").value=="")
	{
		alert("Please Enter Old Password:")
		document.frm1.opass.focus();
		return false;
	}
	if(document.getElementById("npass").value=="")
	{
		alert("Please Enter New Password:")
		document.frm1.npass.focus();
		return false;
	}
	
		if(document.getElementById("cpass").value=="")
	{
		alert("Please Confirme Password:")
		document.frm1.cpass.focus();
		return false;
	}

	
	if(document.getElementById("npass").value!=document.getElementById("cpass").value)
		{
			alert("Both new password and confirm password should be same:");
			document.frm1.npass.value="";
			document.frm1.cpass.value="";
			document.frm1.npass.focus();
			return false;
		}	
	
	
document.frm1.submit();
}