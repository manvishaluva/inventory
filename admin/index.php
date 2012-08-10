<?php 
require_once('../connections/dbcon.php');
session_start();
$login_error=$_SESSION['login_error'];
unset($_SESSION['login_error']);
?>
<style>
<!--
body {
	background-color: #ebeff0;
}
-->
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/style.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory</title>
</head>

<body onLoad="MM_preloadImages('images/users w94 h93.jpg','images/regions w94 h93.jpg','images/branch w94 h93.jpg','images/sub branch w94 h93.jpg','images/divisions w94 h93.jpg','images/powered by manvish.jpg','images/log out w85 h93.jpg')">

<table width="1050" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td height="108">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="136" height="108" valign="middle" bgcolor="#FFFFFF">
        <a href="http://www.manvishonline.in/">
        <img src="images/manvish new logo.jpg" width="136" height="115" /></td>
        <td width="1164" bgcolor="#eb5aa3">
        
        <div class="home" >
        <img src="images/home w93 h93.jpg"/>
        </div> 
        
        <div class="home" >
        <img src="images/banner 12.jpg"/>
        </div>
        
        <div class="right_allign"></div>
        
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><table width="1300 px" border="0" cellspacing="0" cellpadding="0">
      <tr height="620 px">
        <td width="123" height="475" align="center" valign="top"  bgcolor="#ec5aa3">
        
        
        <div class="left_allign">    
        <img src="images/users w94 h93.jpg"/>
        </div>
        
        <div class="left_allign">      
        <img src="images/regions w94 h93.jpg"/>
        </div>
        
        <div class="left_allign">        
        <img src="images/branch w94 h93.jpg"/>
        </div>
        
        <div class="left_allign">       
        <img src="images/sub branch w94 h93.jpg"/>
        </div></td>
        <td width="1047" bgcolor="#FFFFFF" valign="middle">      
        <form method="post" name="frm1" action="modules/mod_login.php">      
        <table align="center" border="0" cellspacing="0" cellpadding="5" style="border: 1px solid #999999">
               
				  <tr>
					<td colspan="2" bgcolor="#eb5aa3" height="25"  class="head_text_admin" >Login</td>
				  </tr>
				  <tr>
					<td colspan="4" align="center" class="red"><?php echo $login_error;?> </td>
				  </tr>
				  <tr>
					<td width="73" align="right"  class="text1">Username:&nbsp;</td>
					<td width="168"><input type="text" class="text1" name="username1" id="username"/></td>
				  </tr>
				  
				  <tr>
					<td align="right" class="text1">Password:&nbsp;</td>
					<td><input type="password" class="text1" name="pass1" id="pass" /></td>
				  </tr>
				  
				  <tr>
					<td colspan="2" align="center"><input class="text1" type="submit" value="Login"  name="submit"/></td>
				  </tr>
		  </table></form></td>
  </tr>
  </table>
  </body>
  </html>
  