<?php 
session_start();
	if($_SESSION['sess_admin']!=''){
	$user_name=$_SESSION['sess_admin'];
	}else{
		echo "<script>window.location='../index.php'</script>";
	}
require_once('../../connections/dbcon.php');
$msg=$_SESSION['error'];
if($msg!=''){
	$_SESSION['error']='';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../../css/style.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory</title><script type="text/javascript" src="../js/add_division_groups.js"></script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>
<body>
<br />
<form method="post" action="../modules/mod_add_led_mapping_groups.php" name="frm1">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <?php
  if(isset($_GET['group_id'])){
			  $image=mysql_query("SELECT * FROM `tbl_division_groups` WHERE `group_id`='{$_GET['group_id']}'");
			  $image_detail=mysql_fetch_assoc($image);
			  $head="Edit";
			  $but="Update";
			  }
  else
  {
  $head="Add";
  $but="Add";
  }			  
  ?>
  <tr height="20px;"><td width="100%" bgcolor="#B0F09B" valign="middle"></td></tr>
		<tr><td width="100%"><?php include('../includes/menu.php'); ?></td></tr>
 <tr height="20px;"><td width="100%" bgcolor="#B0F09B" valign="middle"></td></tr>
<tr height="50px;"><td width="100%" ></td></tr>
		<tr><td valign="top" ><br />
        <table border="0" align="center" cellpadding="3">
          <tr><td bgcolor="#eb5aa3">
          	<table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="rFont10">
  <tr>	<td colspan="2" bgcolor="#eb5aa3" height="30" valign="middle" class="head_text_admin" ><strong><?php echo $head;?>Ledger Group Name</strong></td>
				  </tr>
                  <?php
            if($msg!=''){
			?>
            <tr>	<td colspan="2" bgcolor="#FFFFFF" height="30" align="center" class="red"><?php echo $msg."!";?></td>
				  </tr>
           <?php
			}
			?>
				  <tr>
					<td width="151" align="right" nowrap="nowrap"  class="style3_black">Group Name&nbsp;</td>
					<td ><input type="text"  name="section" class="text" id="section" value="<?php echo $image_detail['group_names']?>" style="width:500px;" /></td>
		  </tr>
          
				  <tr>
					<td colspan="2" align="center">
                    <input type="submit" name="submit" id="submit"class="top_border"  value="<?php echo $but;?>" onclick="return validate();" />
					&nbsp;<input type="button" name="cancel" class="top_border" value="Cancel" onclick="location.href='frm_view_mapping_led_groups.php'"/>
                    <input type="hidden" value="<?php echo $_GET['group_id'];?>" name="group_id" id="group_id" />
                    </td>
		  </tr>
				</table>
		</td></tr></table>
		<tr><td height="100"></td></tr>

  </table>
</form>
<table>
<tr>
<td height="150px;">
</td>
</tr>
</table>

<?php include('../../includes/footer.php'); ?>

</body>
</html>
