<?php
	require_once('../../connections/dbcon.php');
	session_start();
	if($_SESSION['sess_admin']!=''){
	$user_name=$_SESSION['sess_admin'];
	}else{
		echo "<script>window.location='../index.php'</script>";
	}
	$user_edit_id=$_GET['branch_id'];
	$msg=$_SESSION['error'];
	unset($_SESSION['error']);
	if(isset($_GET['branch_id'])){
	$_SESSION['branch']=$_GET['branch_id'];//to preserve values give session variable below 
	}
	if($_GET['flag']==1){
		$_SESSION['branch']='';
	}
	if($_GET['rflag']==1){
		$user_edit_id=$_SESSION['branch'];
	}
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
<script language="javascript">
        function checkvalues(){
  
			if (document.forms[0].brname.value==""){
				
				alert("Please Enter Some Branch Name:")
				document.forms[0].fname.focus();
				return false;
			}
			
	
            document.forms[0].submit();
        }
    </script>

<link rel="stylesheet" href="../../css/style.css"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory</title>
</head>



<body onLoad="MM_preloadImages('images/users w94 h93.jpg','images/regions w94 h93.jpg','images/branch w94 h93.jpg','images/sub branch w94 h93.jpg','images/divisions w94 h93.jpg','images/powered by manvish.jpg','images/log out w85 h93.jpg')">
<form method="post" action="../modules/mod_add_branches.php">
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
        <img src="../images/log out w85 h93.jpg"/></div></td>
      </tr>
    </table>
    </td>
  </tr>
  <tr>
    <td><table width="1301" border="0" cellspacing="0" cellpadding="0">
      <tr >
        <td width="136"  bgcolor="#ec5aa3" align="center">
        
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
        <td width="1165" bgcolor="#FFFFFF" valign="top"><table border="0" align="center" cellpadding="3" cellspacing="3">
        <tr height="90">
              <td colspan="2">&nbsp;</td>
              </tr>
          <tr>
            <td bgcolor="#eb5aa3">
              <?php
			if($_SESSION['branch']){ 
				$branch_id=$_SESSION['branch'];
				$SQL_query="SELECT * FROM  tbl_branch_master  WHERE branch_id=".$branch_id;
				$row=mysql_query($SQL_query);
				$user_detail=mysql_fetch_assoc($row);
				
				$title="Edit Branch";
				$but="Update";
				$status="E";
			}else{
				$title="Add Branch";
				$but="Add";
				$status="A";
			}
			?>
              <table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="rFont10">
                <tr>
                  <td colspan="2" bgcolor="#ec5aa3" valign="middle" class="head_text_admin" height="25">&nbsp;<strong><?php echo $title; ?></strong></td>
                  </tr>
                <tr >
                  <td colspan="2" align="center" style="color:#F00" class="error_text"><strong><?php echo $msg;?></strong> </td>
                  </tr>
                <tr> 
                  
                  <td><div align="left" class="style3_black"> Regions</div>
                    <div >
                      <select name="region" class="text1_black" style="width:150px;" >
                        <?php
				
				$SQL_query1="Select * from tbl_region_master";
				$result=mysql_query($SQL_query1);
				
				if(isset($user_edit_id)){
					
					$region_sql="SELECT * FROM  tbl_branch_master  WHERE branch_id=".$user_edit_id;
					$result_region=mysql_query($region_sql);
					$row_result_region=mysql_fetch_assoc($result_region);
					
						
					
					
						while($row=mysql_fetch_assoc($result)){
	
							echo('<option  value="'.$row['region_id']."/-/".$row['region_name'].'" ');
							if($row['region_id']==$row_result_region['region_id']){
							echo(' selected="selected"');} 
							echo('>'.$row['region_name'].'</option>');
						}
					
				}else{
					
				while($row=mysql_fetch_assoc($result)){

						echo('<option  value="'.$row['region_id']."/-/".$row['region_name'].'" ');
						
						echo('>'.$row['region_name'].'</option>');
					}
				}
			?>
                        </select>
                      </div>
                    </td>
                  <td align="left"><div align="left" >
                    <div align="left" class="style3_black"> Branch</div> 
                    </div>
                    <div>
                      <input type="text" name="brname" id="brname" class="text1_black"  value="<?php echo $user_detail['branch_name'];?>" style="width:300px" />
                      </div></td> 
                  
                  </tr>
                
                
                <tr>	<td colspan="2" align="center">
                  
                  <input type="button" name="button" class="top_border" id="button" value="Save" onclick = "checkvalues();"/>&nbsp;
                  <input type="button" name="cancel" class="top_border" value="Cancel" onClick="location.href='frm_view_branches.php'"/>
                  </td>
                  </tr>
          </table></td></tr></table></td>
      </tr>
    </table></td>
  </tr>
  </table>
  </form>
  </body>
  </html>
  