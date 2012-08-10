<?php
session_start();
	if($_SESSION['sess_admin']!=''){
	$user_name=$_SESSION['sess_admin'];
	}else{
		echo "<script>window.location='../index.php'</script>";
	}
	require_once('../../connections/dbcon.php');
	
	$msg=$_SESSION['error'];
	unset($_SESSION['error']);
	if(isset($_GET['user_id'])){
	$_SESSION['user']=$_GET['user_id'];//to preserve values give session variable below 
	}
	if($_GET['flag']==1){
		$_SESSION['user']='';
	}
	if($_GET['rflag']==1){
		$user_edit_id=$_SESSION['user'];
	}
	$flag=1;
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
<script language="javascript">
function reload(form)
{
var val=form.region.options[form.region.options.selectedIndex].value; 
var val3=document.getElementById('username').value;
var val4=document.getElementById('fname').value;

var val5=document.getElementById('pass').value;
var val6=document.getElementById('cpass').value;
self.location='frm_add_users.php?region_id=' + val + '&usermane=' + val3 + '&fname='+ val4 + '&pass='+ val5 + '&cpass=' + val6 ;
}
function reload3(form)
{
var val=form.region.options[form.region.options.selectedIndex].value; 
var val2=form.branch.options[form.branch.options.selectedIndex].value; 
var val3=document.getElementById('username').value;
var val4=document.getElementById('fname').value;


var val5=document.getElementById('pass').value;
var val6=document.getElementById('cpass').value;


self.location='frm_add_users.php?region_id=' + val + '&branch_id=' + val2 + '&usermane=' + val3 + '&fname='+ val4 + '&pass='+ val5 + '&cpass=' + val6 ;
}


        function checkvalues(sta){
            if(document.forms[0].username.value==""){
                alert("Enter A User Name");
                document.forms[0].username.focus();
				return false;
            }
			
			if (document.forms[0].fname.value==""){
				
				alert("Please Enter User Full Name:")
				document.forms[0].fname.focus();
				return false;
			}
			
			if(sta=="A"){//sss
			
					if (document.forms[0].pass.value==""){
							alert("Please Enter Password:")
							document.forms[0].pass.focus();
							return false;
					}
			
					if (document.forms[0].cpass.value==""){
							alert("Please Confirm Your Password:")
							document.forms[0].cpass.focus();
							return false;
					}
					
					if(document.forms[0].pass.value!=document.forms[0].cpass.value){
						alert("Please Verify Your Password:");
						document.forms[0].pass.value="";
						document.forms[0].cpass.value="";
						document.forms[0].pass.focus();
						return false;
					}
					
			}//ss	
var val=document.getElementById('region').value; 

var val2=document.getElementById('branch').value;	


var val3=document.getElementById('division').value;


		if((val==0)&&(val2==0)&&(val3==0)){
			
			if(document.getElementById('role').value!='Mis'){
				var v=confirm('Are You Sure Want To Create A Top User');
				if(v==true){
					document.getElementById('role').value='Mis';
				}else{
					document.getElementById('region').focus();
				return false;
				}
			}
		}

            document.forms[0].submit();
        }
    </script>
</head>



<body onLoad="MM_preloadImages('images/users w94 h93.jpg','images/regions w94 h93.jpg','images/branch w94 h93.jpg','images/sub branch w94 h93.jpg','images/divisions w94 h93.jpg','images/powered by manvish.jpg','images/log out w85 h93.jpg')">
<form method="post" action="../modules/mod_add_user.php">
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
				$SQL_query="SELECT * FROM  tbl_users  WHERE user_id=".$user_id;
				$row=mysql_query($SQL_query);
				$user_detail=mysql_fetch_assoc($row);
				
				$title="Edit User";
				$but="Update";
				$status="E";
			}else{
				$title="Add User";
				$but="Add";
				$status="A";
			}
			?>
	<table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="rFont10">
		  <tr>
			<td colspan="2" bgcolor="#eb5aa3" valign="middle" class="head_text_admin" height="25">&nbsp;<strong><?php echo $title; ?></strong></td>
		  </tr>
		  <tr >
		    <td colspan="2" align="center" class="red"><strong><?php echo $msg;?></strong> </td>
		  </tr>
		  <tr> 

			<td width="354"><div align="left" class="style3_black">User Name</div>
			  <div>
			  <input type="text"  name="username" id="username" class="text1_black"  value="<?php if($_GET['usermane']!=''){echo $_GET['usermane']; }else{echo $user_detail['user_name'];}?>" <?php if($status=="E"){echo "disabled='disabled'"; }?>  style="width:300px" />
			  <input type="hidden" name="uid" id="uid" value="<?php echo $_SESSION['user'] ?>" />  </div>          </td>
             <td align="left"><div align="left" class="style3_black">User Full Name</div><div>
			  <input type="text" name="fname" id="fname" class="text1_black"  value="<?php if($_GET['fname']!=''){echo $_GET['fname'];}else{echo $user_detail['user_full_name'];}?>" style="width:300px" />
			</div></td> 
			
		  </tr>
         

		  <tr>
			<td></td>
			<td align="left"></td>
		  </tr>
		  <tr>
			<td><div align="left" class="style3_black">Password</div><div><input type="password" name="pass" class="text1_black" id="pass" style="width:300px" value="<?php if($_GET['pass']!=''){echo $_GET['pass'];} ?>" /></div></td>
			<td align="left"><div align="left" class="style3_black">Confirm Password </div><div><input type="password" name="cpass" class="text1_black" id="cpass" style="width:300px"  value="<?php if($_GET['cpass']!=''){echo $_GET['cpass'];} ?>"/></div></td>
		  </tr>
		  <tr>
			<td></td>
			<td align="left"></td>
		  </tr>
		  <tr>

			<td><div align="left" class="style3_black"> Region</div>
            <div>
             <select name="region" id="region" class="text1_black" style="width:150px;" onChange="reload(this.form)">
			    <?php
				
				$SQL_query1="Select * from tbl_region_master";
				$result=mysql_query($SQL_query1);
				
				if(isset($_GET['user_id'])){

					$region_sql="SELECT * FROM  tbl_users  WHERE user_id=".$_GET['user_id'];
					$result_region=mysql_query($region_sql);
					$row_result_region=mysql_fetch_assoc($result_region);
					
						
					echo('<option  value="0"');	
					if($row_result_region['region_id']==0){
					echo(' selected="selected"');	
					}
					echo('>Select Region</option>');
					
						while($row=mysql_fetch_assoc($result)){
	
							echo('<option  value="'.$row['region_id'].'" ');
							if($row['region_id']==$row_result_region['region_id']){
							echo(' selected="selected"');} 
							echo('>'.$row['region_name'].'</option>');
						}
				
				}else{
				//	echo 'not editing mode<br>';
				
				echo('<option  value="0"  selected="selected"');	
				echo('>Select Region</option>');	
				while($row=mysql_fetch_assoc($result)){

						echo('<option  value="'.$row['region_id'].'" ');
						if($row['region_id']==$_GET['region_id']){
							$flag=0;
							echo(' selected="selected"');
						}
						echo('>'.$row['region_name'].'</option>');
					}
				}
			?>
			    </select>
            </div>
            </td>
			<td align="left"><div align="left" class="style3_black">Sub Branches</div>
                  <div>
                    <select name="division" id="division" class="text1_black" style="width:150px;"  >
                      <?php

				
				if(isset($_GET['user_id'])){
						
						$region_sql="SELECT * FROM  tbl_users  WHERE user_id=".$_GET['user_id'];
						$result_region=mysql_query($region_sql);
						$row_result_region=mysql_fetch_assoc($result_region);
						
						$SQL_query1="Select * from tbl_sub_branches where branch_id=".$row_result_region['sub_branch_id'];
						$result2=mysql_query($SQL_query1);	
							
						echo('<option  value="0"');	
						if($row_result_region['id']==0){
							echo(' selected="selected"');
						}
						echo('>Select Sub Branch</option>');
						

						while($row=mysql_fetch_assoc($result2)){
	
							echo('<option  value="'.$row['id'].'" ');
							if($row['id']==$row_result_region['sub_branch_id']){
								echo(' selected="selected"');
							}						
							echo('>'.$row['sub_branch_name'].'</option>');
						}
	
						
				}else{
				$SQL_query1="Select * from tbl_sub_branches where branch_id=".$_GET['branch_id'];
				$result=mysql_query($SQL_query1);
				
					echo('<option  value="0"  selected="selected"');	
					echo('>Select Sub Branch</option>');	
					while($row=mysql_fetch_assoc($result)){

						echo('<option  value="'.$row['id'].'" ');
						if($row['id']==$row_result_region['id']){
							echo(' selected="selected"');
						}						
						echo('>'.$row['sub_branch_name'].'</option>');
					}
				}
			?>
                    </select>
                  </div>
             </td>
		  </tr>
          
          <tr>
			
            <td><div align="left" class="style3_black"> Branch</div>
                  <div>
             <select name="branch" id="branch" class="text1_black" style="width:150px;" onChange="reload3(this.form)" >
			    <?php
		
				if(isset($_GET['user_id'])){
					
					$region_sql="SELECT * FROM  tbl_users  WHERE user_id=".$_GET['user_id'];
					$result_region=mysql_query($region_sql);
					$row_result_region=mysql_fetch_assoc($result_region);
					
					
					echo('<option  value="0"');	
					if($row_result_region['branch_id']==0){
						echo(' selected="selected"');
					}
					echo('>Select Branch</option>');
					
						
						$SQL_query1="Select * from tbl_branch_master where region_id=".$row_result_region['region_id'];
						$result=mysql_query($SQL_query1);
						
						while($row=mysql_fetch_assoc($result)){
	
							echo('<option  value="'.$row['branch_id'].'" ');
							if($row['branch_id']==$row_result_region['branch_id']){
							echo(' selected="selected"');
							} 
							echo('>'.$row['branch_name'].'</option>');
							
						}
				
				}else{
					
					
				$SQL_query1="Select * from tbl_branch_master where region_id=".$_GET['region_id'];
				$result=mysql_query($SQL_query1);
				
				echo('<option  value="0"  selected="selected"');	
					echo('>Select Branch</option>');	
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
			 <td width="223" align"left"><div align="left" class="style3_black">Role</div> <div>
			  <select name="role" id="role" class="text1_black" style="width:100px;" >
			    <?php
				if($_SESSION['user']){
					$SQL_query1="SELECT * FROM  tbl_users  WHERE user_id=".$_SESSION['user'];
					$row1=mysql_query($SQL_query1);
					$user_detail1=mysql_fetch_assoc($row1);
									
					
					echo('<option  value="User" ');
					if($user_detail1['user_role']=='User'){
						echo(' selected="selected"');} 
					echo('>User</option>');
					
					echo('<option  value="Mis" ');
					if($user_detail1['user_role']=='Mis'){
						echo(' selected="selected"');} 
					echo('>Mis</option>');
		
					
				}else{
				echo('<option  value="User">User</option>');
				if($flag==1){
				echo('<option  value="Mis">Mis</option>');

				}
				}
			?>
			    </select>
			</div></td>
             
		  </tr>

          
          
		  <tr>
			<td></td>
			<td align="left">            			</td>
		  </tr>
		 <tr>	<td colspan="2" align="center">

         <input type="hidden" name="submit1" value="1"/>
         <input type="button" name="button" class="top_border" id="button" value="Save" onclick = "checkvalues('<?php echo $status;?>')"/>&nbsp;
		 <input type="button" name="cancel" class="top_border" value="Cancel" onClick="location.href='frm_view_users.php'"/>
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
  