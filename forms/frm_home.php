<?php 
session_start();
if(isset($_SESSION['sess_user'])){
$user_id=$_SESSION['sess_user'];
}else{
header('Location: ../index.php');exit();
}
?>
<table width="100%">
<tr height="20px;"><td></td></tr>
<tr><td align="center"><?php include('../includes/head_all.php'); ?></td></tr>
</table>
<?php

$msg='';

if(isset($_SESSION['ok'])){
	unset($_SESSION['ok']);
	$msg='Password Changed Successfully';
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../css/style_front.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory</title>
</head>

<body>
<center>
<table border="0" width="100%">


<tr height="20px;">
<td>
</td>
<tr>
<td  align="center" style="font:Arial, Helvetica, sans-serif;font-size:14px; color:#F00;">
<?php echo $msg;  ?>
</td>
<td></td>
</tr>
<tr>
<td height="400px;" align="center" valign="middle"><img src="../images/Maruti-Swift-VXi(ABS).jpg"/></td>
<td valign="top"  style="color:#999">

     
    </td>
</tr>
</table>
</center>
</body>
<?php
include('../includes/footer_front.php');
if(isset($_GET['msg'])){
	echo "<script>alert('Amounts Allocated Successfully');</script>";
}
?>
</html>
