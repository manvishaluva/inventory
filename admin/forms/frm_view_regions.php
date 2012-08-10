<?php
session_start();
	if($_SESSION['sess_admin']!=''){
	$user_name=$_SESSION['sess_admin'];
	}else{
		echo "<script>window.location='../index.php'</script>";
	}

include('../functions/ps_pagination.php');
include('../../connections/dbcon.php');
?>

<script>
function DeletePageSection(id){
  	if(confirm("Are you sure you want to delete this Division Group?")){
		location.href='../../modules/delete.php?tbl=tbl_region_master'+'&cond=region_id='+id+'&url=../admin/forms/frm_view_regions.php';
	}
}
</script>

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
        <td width="1164" bgcolor="#eb5aa3">
        <div class="home" >
        <a href="frm_home.php">
        <img src="../images/home w93 h93.jpg"/>
        </a>
        </div> 
        
        <div class="home" >
        <img src="../images/banner 12.jpg"/>
        </div>
        
        <div class="right_allign">
        <a href="../index.php">
        <img src="../images/log out w85 h93.jpg"/>
        </a>
        </div>
        
        </td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><table width="1300 px" border="0" cellspacing="0" cellpadding="0">
      <tr height="620 px">
        <td width="123"  bgcolor="#ec5aa3" align="center" valign="top">
        
        
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
        
       
        
        </td>
        <td width="1047" bgcolor="#FFFFFF" valign="top"><table border="0" align="center" cellpadding="3" >
          <tr height="90">
              <td colspan="2">&nbsp;</td>
              </tr>
          <tr><td bgcolor="#ec5aa3">
            <table border="0" align="center" cellpadding="5" cellspacing="3" bgcolor="#FFFFFF" class="rFont10">
              
              <tr><td colspan="3"   height="25" valign="middle" bgcolor="#ec5aa3" class="head_text_admin"><strong>Regions</strong> </td>
                </tr>
              <tr bgcolor="#000000">
                <td width="500" height="25" align="left" class="style3" ><strong>Title</strong></td>
                <td width="32%" height="25" align="center" class="style3" ><strong>Actions</strong></td>
                </tr>
              <?php
                $row_count=1;
                $SQL_Query = "SELECT * FROM tbl_region_master";
				$pager = new PS_Pagination($conn, $SQL_Query, 10, 200, "param1=valu1&param2=value2");
				$pager->setDebug(true);
				$rs = $pager->paginate();
				$rows=mysql_query("SELECT * FROM `tbl_region_master`");
				if(mysql_num_rows($rows)>0)
				 {
                           while($row_user=mysql_fetch_assoc($rs))
                                    {
             ?>
              <tr <?php if($row_count%2==0) echo 'bgcolor="#F7F7F7"'; ?>  >
                <td width="68%" class="text1" align="left"><strong><?php echo $row_user['region_name'];?></strong></td>
                <td align="center">
                  
                  
                  <a href="javascript:DeletePageSection(<?php echo $row_user['region_id']?>);">
                    <img border="0" src="../images/icon_delete.gif"  /> 
                    </a>
                  </td>
                </tr>
              <?php 
                        $row_count++;
                                        }
              ?> 
              <tr>
                <td colspan="5" nowrap="nowrap" class="navigate"><?php echo $pager->renderFullNav(); ?>															            </td>
                </tr>
              <?php }else{?>
              <tr>
                <td colspan="4" align="center" height="30px"  class="red">No Regions</td>
                </tr>
              <?php }
           ?>
              <tr><td height="30" colspan="3" align="right" bgcolor="#EEEEEE" class="top_border">
                <input class="top_border" type="button" value="Add Regions" onClick="location.href='frm_add_regions.php'" />
                
                </td></tr>
          </table></td></tr></table></td>
      </tr>
    </table></td>
  </tr>
  </table>
  </body>
  </html>
  