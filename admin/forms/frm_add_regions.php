<?php
session_start();
	if($_SESSION['sess_admin']!=''){
	$user_name=$_SESSION['sess_admin'];
	}else{
		echo "<script>window.location='../index.php'</script>";
	}
require_once('../../connections/dbcon.php');

?>
<script type="text/javascript" src="../js/add_division_groups.js"></script>
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

<form method="post" action="../modules/mod_add_regions.php" name="frm1">
<?php
  if(isset($_GET['region_id'])){
			  $image=mysql_query("SELECT * FROM `tbl_region_master` WHERE `region_id`='{$_GET['region_id']}'");
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

<table width="1050" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="108">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="136" height="108" bgcolor="#eb5aa3">
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
        <td width="1047" bgcolor="#FFFFFF" valign="top"><table border="0" align="center" cellpadding="3">
        <tr height="90">
              <td colspan="2">&nbsp;</td>
              </tr>
          <tr><td bgcolor="#eb5aa3">
          	<table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="rFont10">
  <tr>	<td colspan="2" bgcolor="#eb5aa3" height="30" valign="middle" class="head_text_admin" ><strong><?php echo $head;?>Regions</strong></td>
				  </tr>
                  <?php
            if($msg!=''){
			?>
            <tr>	<td colspan="2" bgcolor="#FFFFFF" height="30" align="center" class="red" ><?php echo $msg."!";?></td>
				  </tr>
           <?php
			}
			?>
				  <tr>
					<td width="151" align="right" nowrap="nowrap"  class="style3_black">Region Name</td>
					<td ><input type="text"  name="section" class="text1_black" id="section" value="<?php echo $image_detail['region_name']?>" style="width:500px;" /></td>
		  </tr>
          
				  <tr>
					<td colspan="2" align="center">
                    <input type="submit" name="submit" id="submit"class="top_border"  value="<?php echo $but;?>" onClick="return validate();" />
					&nbsp;<input type="button" name="cancel" class="top_border" value="Cancel" onClick="location.href='frm_view_regions.php'"/>
                    <input type="hidden" value="<?php echo $_GET['region_id'];?>" name="region_id" id="region_id" />
                    </td>
		  </tr>
				</table>
		</td></tr></table></td>
      </tr>
    </table></td>
  </tr>
  </form>
  </body>
  </html>
  