<?php 
session_start();
	if($_SESSION['sess_admin']!=''){
	$user_name=$_SESSION['sess_admin'];
	}else{
		echo "<script>window.location='../index.php'</script>";
	}
require_once('../../connections/dbcon.php');
include('../functions/ps_pagination.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="../../css/style.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory</title>
<script>
function DeletePageSection(id){
  	if(confirm("Are you sure you want to delete this Division Group?")){
		location.href='../../modules/delete.php?tbl=tbl_division_groups'+'&cond=group_id='+id+'&url=../admin/forms/frm_view_division_groups.php';
	}
}
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
</head>
<br/>
<body>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr height="20px;"><td width="100%" bgcolor="#B0F09B" valign="middle"></td></tr>
		<tr><td width="100%"><?php include('../includes/menu.php'); ?></td></tr>
 <tr height="20px;"><td width="100%" bgcolor="#B0F09B" valign="middle"></td></tr>
<tr height="50px;"><td width="100%" ></td></tr>
		   <tr><td valign="top" ><br />
        <table border="0" align="center" cellpadding="3">
          <tr><td bgcolor="#eb5aa3">
          	<table border="0" align="center" cellpadding="5" cellspacing="3" bgcolor="#FFFFFF" class="rFont10">
            <tr><td colspan="3"   height="25" valign="middle" bgcolor="#eb5aa3" class="head_text_admin"><strong>Group Name</strong> </td>
              </tr>
              <tr bgcolor="#000000">
                <td width="500" height="25" align="left" class="style3"><strong>Title</strong></td>
                <td width="32%" height="25" align="center" class="style3" ><strong>Actions</strong></td>
              </tr>
             <?php
                $row_count=1;
                $SQL_Query = "SELECT * FROM tbl_division_groups";
				$pager = new PS_Pagination($conn, $SQL_Query, 20, 200, "param1=valu1&param2=value2");
				$pager->setDebug(true);
				$rs = $pager->paginate();
				$rows=mysql_query("SELECT * FROM `tbl_division_groups`");
				if(mysql_num_rows($rows)>0)
				 {
                            while($row_user=mysql_fetch_assoc($rs))
                                    {
             ?>
              <tr <?php if($row_count%2==0) echo 'bgcolor="#F7F7F7"'; ?>  >
                <td width="68%" class="text1" align="left"><strong><?php echo $row_user['group_names'];?></strong></td>
                <td align="center">
				
                  
				  <a href="javascript:DeletePageSection(<?php echo $row_user['group_id']?>);">
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
			<td colspan="4" align="center" height="30px"  class="red">No Groups</td>
			</tr>
			  <?php }
           ?>
              <tr><td height="30" colspan="3" align="right" bgcolor="#EEEEEE" class="top_border">
			    <input class="top_border" type="button" value="Add Group Name" onclick="location.href='frm_add_division_groups.php'" />
			  
			  </td></tr>
          </table>
         </td></tr></table>
		<tr height="100px;">
<td width="80%">
</td>
</tr>
</table>
</form>
<?php include('../../includes/footer.php'); ?>
</body>
</html>