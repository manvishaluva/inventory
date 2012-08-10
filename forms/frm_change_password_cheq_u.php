<?php
session_start();
if(isset($_SESSION['sess_user'])){
$user_id=$_SESSION['sess_user'];
}else{
header('Location: ../index.php');exit();
}

$register='';
include('../includes/spuser_head.php');
if(isset($_SESSION['error'])){
	$register="Invalid Old password";
	unset($_SESSION['error']);
}
?>
<link rel="stylesheet" href="css/style.css"/>
<html>
<head>
<script type="text/javascript" src="../js/change pass validate.js"></script>
<script type="text/javascript">

function clear1(){
	document.getElementById('opass').value='';
	document.getElementById('npass').value='';
	document.getElementById('cpass').value='';
	
}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr height="50px;"><td colspan="6"></td></tr>
    </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		
<tr><td class="font3" align="center" style="padding:10px;"></td></tr>
		<tr><td>
		<form method="post" name="frm1" action="../modules/mod_change_password.php">
				<table align="center" border="0" cellspacing="0" cellpadding="5" style="border: 3px solid #FF8306">
                
				  <tr>
					<td colspan="2" bgcolor="#FF8306" height="25"  class="head_text" >Change Password</td>
				  </tr>
				  <tr>
					<td colspan="4" align="center" class="red"><?php echo $login_error;?> </td>
				  </tr>
				  <tr>
					<td align="right"  class="text1">Old Password:&nbsp;</td>
					<td><input type="password" class="text1" name="opass" id="opass"/></td>
				  </tr>
                  <?php 
                  if($register!=''){
					  ?>
				  <tr>
					<td colspan="2" bgcolor="#FFFFFF" align="center" style="color:red;font-family:Verdana, Geneva, sans-serif;font-size:11px"  ><?php echo $register;?></td>
				  </tr>
                  <?php
				  }
				  ?>
				  <tr>
					<td align="right" class="text1">New Password:&nbsp;</td>
					<td><input type="password" class="text1" name="npass" id="npass" /></td>
				  </tr>
                  
                  <tr>
					<td align="right" class="text1">Confirm Password:&nbsp;</td>
					<td><input type="password" class="text1" name="cpass" id="cpass" /></td>
				  </tr>
				  
				  <tr>
					<td align="right"><input class="text1" type="button" value="Save"  name="bt2" onClick="validate();"/></td>
                    <td align="left"><input type="button" name="bt1" id="bt1" value="Reset" class="text1" onClick="clear1();"/></td>
				  </tr>
		  </table>
          <input type="hidden" name="id" value="<?php echo $_SESSION['sess_user'];  ?>"/>

		  </form>		
			</td></tr>
            <tr height="170px"><td></td></tr>
		<tr><td width="100%"><?php include('../includes/footer_front.php') ?></td></tr>

  </table>
</body>
</html>