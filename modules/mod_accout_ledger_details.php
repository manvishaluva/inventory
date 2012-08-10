<?php
session_start();
if($_SESSION['sess_user']!=""){
require_once('../connections/dbcon.php'); 
include('../admin/functions/ps_pagination.php');
/*	if(!isset($_GET['id'])){
			
	$_SESSION['end']=$_POST['enddate'];
	$_SESSION['std']=$_POST['stdate'];
	$_SESSION['brid']=$_POST['branch'];
	$_SESSION['sub_branch']=$_POST['sub_branch'];


	}

	$std=$_SESSION['std'];
	
	$end=$_SESSION['end'];

	$brid=$_SESSION['brid'];

	$type=$_SESSION['type'];
	
*/		  
}else{
	header('Location:../index.php');exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory</title><link rel="stylesheet" type="text/css" href="../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../css/style_tool_tip.css"/>

<textarea id="dhtmltooltip"></textarea>

<style type="text/css">
#dhtmltooltip {
position: absolute;
width: 150px;
border: 1px solid #C1C1C1;
padding: 2px;
background-color: #EFEFEF;
color: #000000;
visibility: hidden;
z-index: 100;
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
}
<!--
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-weight: bold; }
.popup { 
	padding:10px;
	border:1px solid #ccc;
	background:#eee;
	width:250px;
	font-size: small; 
	position:relative;
	float:inherit;
 }
-->
</style>
</head>

<body>
<table border="0" align="center" cellpadding="3">
          <tr><td height="50">&nbsp;</td></tr>
          <tr>
          
            <td bgcolor="#d6d6d6"><table border="0" align="center" cellpadding="5" cellspacing="3" bgcolor="#FFFFFF" class="rFont10">
         
          <tr>
          
            <td colspan="4" bgcolor="#FF8306" class="head_text" height="25">Ledgers</td>
          </tr>

          <tr bgcolor="#666666">
            <td height="25" align="left" width="250"><span class="style3"><strong>Ledger Name</strong></span></td>
            <td width="93" height="25" align="left"  class="style3" >Voucher No</td>
            <td width="81" height="25" align="left"  class="style3" >Vat Rate</td>
            <td width="129" height="25" align="left"  class="style3"  >Ledger Amount</td>
          </tr>
             <?php

                $row_count=1;
                $SQL_Query = "SELECT * FROM tbl_accounts_led_details where acc_tranc_id =".$_GET['id'];
				$result=mysql_query($SQL_Query);
				$count=mysql_num_rows($result);
				if($count!=0){

				$pager = new PS_Pagination($conn, $SQL_Query, 10, 200, "");
				$pager->setDebug(true);
				$rs = $pager->paginate();
				
				
                    while($row_user=mysql_fetch_assoc($rs))
                    {
					
            ?>
           
		 	<tr height="20"<?php if($row_count%2==0) echo 'bgcolor="#F7F7F7"';?> >
           
			<td   align="left" bordercolor="#E9E9E9" class="text1"><?php echo $row_user['led_name'];; ?></td>
			<td  align="left" bordercolor="#E9E9E9" class="text1"><?php echo $row_user['voucher_no']; ; ?></td>
            <td   align="left" bordercolor="#E9E9E9" class="text1"><?php echo $row_user['rate_of_vat']; ?></td>
            <td   align="left" bordercolor="#E9E9E9" class="text1"><?php echo $row_user['led_amount']; ?></td>
           
			
			</tr>
           <?php
                        $row_count++;
					
              }
           ?>
            <tr>
			<td colspan="4" nowrap="nowrap" class="navigate"><?php echo $pager->renderFullNav(); ?>															            </td>
			</tr>
                       <?php 
				}else{
		   ?>
            <tr>
			<td align="center" colspan="6" nowrap="nowrap" class="red">Nothing To Display</td>
			</tr>

           <?php 
				}
		   ?>

		   
        </table>

</body>
</html>