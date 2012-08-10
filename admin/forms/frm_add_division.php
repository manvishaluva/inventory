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
          <tr>
            <td bgcolor="#eb5aa3">
        	<?php
			
			
			if($_SESSION['user']){ 
				$user_id=$_SESSION['user'];
				$SQL_query="SELECT * FROM  tbl_divisions  WHERE division_id=".$user_id;
				$row=mysql_query($SQL_query);
				$user_detail=mysql_fetch_assoc($row);
				
				$title="Edit division";
				$but="Update";
				$status="E";
			}else{
				$title="Add division";
				$but="Add";
				$status="A";
			}
			?>
	<table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="rFont10">
		  <tr>
			<td colspan="2" bgcolor="#eb5aa3" valign="middle" class="head_text_admin" height="25">&nbsp;<strong><?php echo $title; ?></strong></td>
		  </tr>
		  <tr >
		    <td colspan="2" align="center" class="error_text" style="color:#F30"><strong><?php echo $msg;?></strong> </td>
		  </tr>
		  <tr>

			<td width="194"><div align="left" class="style3_black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Region</div>
           <div > &nbsp;&nbsp;&nbsp;
             <select name="region" id="region" class="text1_black" style="width:150px;"  onchange="reload(this.form)">
			    <?php
				
				$SQL_query1="Select * from tbl_region_master";
				$result=mysql_query($SQL_query1);
				
				if(isset($user_edit_id)){
					
					$region_sql="SELECT * FROM  tbl_divisions  WHERE division_id=".$user_edit_id;
					$result_region=mysql_query($region_sql);
					$row_result_region=mysql_fetch_assoc($result_region);
					
						
					
					
						while($row=mysql_fetch_assoc($result)){
	
							echo('<option  value="'.$row['region_id'].'" ');
							if($row['region_id']==$row_result_region['region_id']){
							echo(' selected="selected"');} 
							echo('>'.$row['region_name'].'</option>');
						}
					
				}else{
					echo('<option  value="">Select a Region</option>');
				while($row=mysql_fetch_assoc($result)){

						echo('<option  value="'.$row['region_id'].'" ');
						if($row['region_id']==$_GET['region_id']){
							echo(' selected="selected"');
						}
						echo('>'.$row['region_name'].'</option>');
					}
				}
			?>
			    </select>
            </div>
            </td>
			<td align="left"><div align="left" class="style3_black">Group</div>
                  <div>
                               <select name="division" id="division" class="text1_black" style="width:150px;"  >
			    <?php

				
				if(isset($user_edit_id)){
						 //division_id 	branch_id 	region_id 	division_name 	division_group_name
						$region_sql="SELECT * FROM  tbl_divisions  WHERE division_id=".$user_edit_id;
						$result_region=mysql_query($region_sql);
						$row_result_region=mysql_fetch_assoc($result_region);
						
						$SQL_query1="Select * from tbl_division_groups";
						$result2=mysql_query($SQL_query1);	
						while($row=mysql_fetch_assoc($result2)){
	
							echo('<option  value="'.$row['group_names'].'" ');
							if($row['group_names']==$row_result_region['division_group_name']){
								$k=1;
								echo(' selected="selected"');
							}						
							echo('>'.$row['group_names'].'</option>');
						}
						if($k!=1){
							echo('<option  value="" selected="selected">Select a Group</option>');
						}
	
						
				}else{
				$SQL_query1="Select * from tbl_division_groups order by group_names ";
				$result=mysql_query($SQL_query1);
				
					echo('<option  value="">Select a Group</option>');
					while($row=mysql_fetch_assoc($result)){

						echo('<option  value="'.$row['group_names'].'" ');
						if($row['group_names']==$_GET['division']){
								echo(' selected="selected"');
							}					
						echo('>'.$row['group_names'].'</option>');
					}
				}
			?>
			    </select>

                  </div>
             </td>
		  </tr>
          
          <tr>
			
            <td><div align="left" class="style3_black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Branch</div>
                  <div>&nbsp;&nbsp;&nbsp;
             <select name="branch" class="text1_black" style="width:150px;" >
			    <?php
		
				if(isset($user_edit_id)){
					
					
						
						$SQL_query1="Select * from tbl_divisions where division_id=".$user_edit_id;
						$result=mysql_query($SQL_query1);
						$row=mysql_fetch_assoc($result);
						
						$region_sql="SELECT * FROM  tbl_branch_master WHERE region_id=".$row['region_id'];
						$result_region=mysql_query($region_sql);
						
						while($row_result_region=mysql_fetch_assoc($result_region)){
	
							echo('<option  value="'.$row_result_region['branch_id'].'" ');
							if($row['branch_id']==$row_result_region['branch_id']){
							echo(' selected="selected"');
							} 
							echo('>'.$row_result_region['branch_name'].'</option>');
							
						}
					
				}else{
				//	echo $_GET['region_id'];
				
				$SQL_query1="Select * from tbl_branch_master where region_id=".$_GET['region_id'];
				$result=mysql_query($SQL_query1);
				
					
				while($row=mysql_fetch_assoc($result)){

						echo('<option  value="'.$row['branch_id'].'" ');
						if($row['branch_id']==$_GET['branch_id']){
							echo(' selected="selected"');
						}						
						echo('>'.$row['branch_name'].'</option>');
					}
				}
			?>
			    </select>
                   </div>
             </td>
			 <td width="180" align"left"><div align="left" class="style3_black">Division</div> 
			 <div>
			  <input type="text" name="dname" class="text1_black" id="dname" value="<?php if($_GET['dname']){echo $_GET['dname']; }else{echo $user_detail['division_name'];} ?>" style="width:150px;"/>
			</div></td>
             
		  </tr>

          
          
		  <tr>
			<td></td>
			<td align="left">            			</td>
		  </tr>
		 <tr>	<td colspan="2" align="center">

         <input type="hidden" name="submit1" value="1"/>
         <input type="button" name="button" class="top_border" id="button" value="Save" onclick = "checkvalues();"/>&nbsp;
		 <input type="button" name="cancel" class="top_border" value="Cancel" onClick="location.href='frm_view_divisions.php'"/>
         </td>
		  </tr>
		</table></td></tr></table></td>
      </tr>
    </table></td>
  </tr>
  </table>
  </body>
  </html>
  