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
function DeleteUser(id){
  	if(confirm("Are you sure you want to delete this Branch?")){
		location.href='../../modules/delete.php?tbl=tbl_branch_master'+'&cond=branch_id='+id+'&url=../admin/forms/frm_view_branches.php';
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
        <td width="1047" bgcolor="#FFFFFF" valign="top"><table border="0" align="center" cellpadding="3">
        <tr height="90">
              <td colspan="2">&nbsp;</td>
              </tr>
          <tr><td bgcolor="#eb5aa3">
          <table border="0" align="center" cellpadding="5" cellspacing="3" bgcolor="#FFFFFF" class="rFont10">
              <tr>
                <td colspan="7" bgcolor="#eb5aa3" class="head_text_admin" height="25">Branches</td>
                </tr>
              
              <tr bgcolor="#000000">
                <td  class="style3" height="25" align="left" width="350px;" >Region</td>
                <td  class="style3" height="25" align="left" width="350px;">Branch</td>
                <td  class="style3" height="25" align="center"   width="100" nowrap="nowrap"> Action</td>
                </tr>
              <?php 
                $row_count=1;
                $SQL_Query = "SELECT * FROM tbl_branch_master ORDER BY region_name";
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
                
                
                
                <td   align="left" bordercolor="#E9E9E9" class="text1"><?php echo $row_user['region_name']; ?></td>
                <td  align="left" bordercolor="#E9E9E9" class="text1"><?php echo $row_user['branch_name'] ; ?></td>
                <td align="center" bordercolor="#E9E9E9" nowrap="nowrap" class="text1">
                  <a href="frm_add_branches.php?branch_id=<?php echo $row_user['branch_id'];?>" >
                    <img src="../images/icon_edit.gif" border="0" /></a>&nbsp;
                  <a href="javascript:DeleteUser(<?php echo $row_user['branch_id']?>);">
                    <img src="../images/icon_delete.gif" onClick="" border="0" />			</a>			</td>
                </tr>
              <?php
                        $row_count++;
					
              }
           ?>
              <tr>
                <td colspan="6" nowrap="nowrap" class="navigate"><?php echo $pager->renderFullNav(); ?>															            </td>
                </tr>
              <?php 
				}else{
		   ?>
              <tr>
                <td align="center" colspan="6" nowrap="nowrap" class="red">No Branches</td>
                </tr>
              
              <?php 
				}
		   ?>
              <tr>
                <td class="top_border" colspan="7" align="right" height="30" bgcolor="#EEEEEE">
                  <input type="button" class="top_border" value="Add New Branch" onClick="location.href='frm_add_branches.php?flag=1'" /></td>
                </tr>
              
          </table></td></tr></table></td>
      </tr>
    </table></td>
  </tr>
  </table>
  </body>
  </html>
  