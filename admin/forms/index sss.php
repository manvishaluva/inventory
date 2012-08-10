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

<body>

<body onLoad="MM_preloadImages('images/users w94 h93.jpg','images/regions w94 h93.jpg','images/branch w94 h93.jpg','images/sub branch w94 h93.jpg','images/divisions w94 h93.jpg','images/powered by manvish.jpg','images/log out w85 h93.jpg')">
<table width="1050" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="108"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="136" height="108" align="center" valign="middle" bgcolor="#FFFFFF">&nbsp;</td>
        <td width="1164" bgcolor="#eb5aa3">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="1300 px" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="123" height="542" bgcolor="#ec5aa3"><div><img src="../images/users w94 h93.jpg"/></div><div><img src="../images/regions w94 h93.jpg"/></div></td>
        <td width="1047" bgcolor="#FFFFFF">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  </table>
