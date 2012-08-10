<?php session_start();?>
<table width="100%">
<tr height="20px;"><td></td></tr>
<tr><td align="center"><?php include('includes/index_head.php'); ?></td></tr>
</table>
<?php
$_SESSION['sess_admin'];
$login_error=$_SESSION['login_error'];
unset($_SESSION['login_error']);
$register=$_SESSION['register'];
unset($_SESSION['register']);
?>
<title>Inventory</title>
<link rel="stylesheet" href="css/style.css"/>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr height="50px;"><td colspan="6"></td></tr>
    </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		
<tr><td class="font3" align="center" style="padding:10px;"><?php echo $register;?></td></tr>
		<tr><td>
		<form method="post" name="frm1" action="modules/mod_login.php">
				<table align="center" border="0" cellspacing="0" cellpadding="5" style="border: 3px solid #d6d6d6">
                
				  <tr>
					<td colspan="2" bgcolor="#939393" height="25"  class="head_text" >Login</td>
				  </tr>
				  <tr>
					<td colspan="4" align="center" class="red"><?php echo $login_error;?> </td>
				  </tr>
				  <tr>
					<td align="right"  class="text1">Username:&nbsp;</td>
					<td><input type="text" class="text1" name="username" id="username"/></td>
				  </tr>
				  
				  <tr>
					<td align="right" class="text1">Password:&nbsp;</td>
					<td><input type="password" class="text1" name="pass" id="pass" /></td>
				  </tr>
				  
				  <tr>
					<td colspan="2" align="center"><input class="text1" type="submit" value="Login"  name="submit"/></td>
				  </tr>
		  </table>
		  </form>		
			</td></tr>
            <tr height="174px"><td></td></tr>
		<tr><td width="100%"><?php include('includes/index_footer.php') ?></td></tr>

  </table>
