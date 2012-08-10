<?php
session_start();
	if($_SESSION['sess_admin']!=''){
	$user_name=$_SESSION['sess_admin'];
	}else{
		echo "<script>window.location='../index.php'</script>";
	}

//include('../includes/menu.php');

?>
<style type="text/css">
<!--
body {
	background-color: #ebeff0;
}
-->
</style>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../../css/style.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory</title>
</head>



<body onLoad="MM_preloadImages('images/users w94 h93.jpg','images/regions w94 h93.jpg','images/branch w94 h93.jpg','images/sub branch w94 h93.jpg','images/divisions w94 h93.jpg','images/powered by manvish.jpg','images/log out w85 h93.jpg')">

<table width="1050" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="108">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="136" height="108" valign="middle" bgcolor="#eb5aa3">
        <a href="http://www.manvishonline.in/">
        <img src="../images/manvish new logo.jpg" width="136" height="115" /></a></td>
        <td width="1164" bgcolor="#eb5aa3"><div class="home" >
        <a href="frm_home.php">
        <img src="../images/home w93 h93.jpg"/>
        </a>
        </div>
        
        <div class="home" >
        <img src="../images/banner 12.jpg"/>
        </div>
        
          <div class="right_allign">
            <a href="../index.php">
          <img src="../images/log out w85 h93.jpg"/></div></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><table width="1300 px" border="0" cellspacing="0" cellpadding="0">
      <tr >
        <td width="123"  bgcolor="#ec5aa3" align="center">
        
        <span height="620 px" style="vertical-align:top;">
        <div class="left_allign">
        <a href="frm_view_users.php">
        <img src="../images/users w94 h93.jpg"/>
        </a>
        </div>
        
        <div class="left_allign">
        <a href="frm_view_regions.php">
        <img src="../images/regions w94 h93.jpg"/>
        </a>
        </div>
        
        <div class="left_allign">
        <a href="frm_view_branches.php">
        <img src="../images/branch w94 h93.jpg"/>
        </a>
        </div>
        
        <div class="left_allign">
        <a href="frm_view_sub_branch.php">
        <img src="../images/sub branch w94 h93.jpg"/>
        </a>
        </div>
        
        <div class="left_allign"></div>
        
        </span>
        
        </td>
        <td width="1047" align="center" valign="middle" bgcolor="#FFFFFF"><img src="../images/globe.jpg" width="450" height="450" align="middle" /></td>
      </tr>
    </table></td>
  </tr>
  </table>
  </body>
  </html>
  