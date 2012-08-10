<?php 
session_start();
if(isset($_SESSION['sess_user'])){
$user_id=$_SESSION['sess_user'];
}else{
header('Location: ../index.php');exit();
}
unset($_SESSION['br']); 
unset($_SESSION['reg']); 
unset($_SESSION['sub_br']); 
unset($_SESSION['usertype']); 
?>
<table width="100%">
<tr height="20px;"><td></td></tr>
<tr><td align="center"><?php include('../includes/head_all.php'); ?></td></tr>
</table>

<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/cal_style.css" />
<script type="text/javascript" src="../js/cheque_validate.js"></script>
<script type="text/javascript" src="../js/jscal.js"></script>
<script type="text/javascript" >

function validate () {  
	if((document.getElementById('partno').value=='')&(document.getElementById('description').value=='')){
		alert("Specify Any One Value For Searching")
		document.getElementById('partno').focus();
		return false;
	}
	document.frm1.submit();
  
}
	
</script>

<link rel="stylesheet" href="../css/style.css"/>
<title>Inventory</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>
</html>

<form method="post" name='frm1' action="../modules/mod_search.php">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" ><br />


        <table border="0" align="center" cellpadding="3">
          <tr>
            <td bgcolor="#d6d6d6">

	<table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="rFont10">
		  <tr>
			<td colspan="2" bgcolor="#FF8306" valign="middle" class="head_text" height="25">&nbsp;<strong>Search</strong></td>
		  </tr>
		  <tr >
		    <td colspan="2" align="center" class="red"><strong><?php echo $msg;?></strong> </td>
		  </tr>
		  <tr > 

				<td align="left"><div align="left" class="style3_black">Part No</div></td>
				<td><div><input type="text" name="partno" id="partno" value="" /></div></td>  
			  </tr>
			  <tr>
             <td align="left"><div align="left" class="style3_black">Description</div></td>
             <td><div><textarea name="description" id="description" rows="1" cols="25"></textarea></div></td> 

		  <tr>
          <tr>
			<td></td>
			<td align="left"></td>
		  <tr>
			<td></td>
			<td align="left"></td>
		  </tr>
		  
          
                
		  <tr>
			<td></td>
			<td align="left">            			</td>
		  </tr>
		 <tr>	<td colspan="2" align="center">
<input type="button" name="bti" id="bti" value="Ok"  onclick="validate()"/>

         </td>
		  </tr>
		</table></td></tr></table>
</td></tr>
<tr><td height="174"></td></tr>
</table>
</form>
<?php include('../includes/footer_all.php'); ?>
</body>
</html>

