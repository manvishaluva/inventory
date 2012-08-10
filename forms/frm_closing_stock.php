<?php 
session_start();
if(isset($_SESSION['sess_user'])){
$user_id=$_SESSION['sess_user'];
}else{
header('Location: ../index.php');exit();
}
unset($_SESSION['br']); 
unset($_SESSION['reg']); 
unset($_SESSION['sub_br']); 
unset($_SESSION['usertype']); 
?>
<table width="100%">
<tr height="20px;"><td></td></tr>
<tr><td align="center"><?php include('../includes/head_all.php'); ?></td></tr>
</table>
<?php
include('../connections/dbcon.php');
if($_GET['error']){
$msg="Date selection is Wrong";
}

//  user_id 	user_name 	user_password 	region_id 	branch_id 	sub_branch_id user_active 

$sql_querry="SELECT * FROM tbl_users WHERE user_id=".$user_id;
$result=mysql_query($sql_querry);
if($row_user=mysql_fetch_array($result)){
	
	if(($row_user['region_id']==0) && ($row_user['branch_id']==0) && ($row_user['sub_branch_id']==0)){
		
		$user_type="TOP USER";
		
		
	}else if( ($row_user['region_id']!=0) && ($row_user['branch_id']==0) && ($row_user['sub_branch_id']==0)){
		
		$user_type="REGION USER";
		$region=$row_user['region_id'];
		
		
	}else if( ($row_user['region_id']!=0) && ($row_user['branch_id']!=0) && ($row_user['sub_branch_id']==0)){
		
		$user_type="BRANCH USER";
		$region=$row_user['region_id'];
		$branch=$row_user['branch_id'];
		
	}else if( ($row_user['region_id']!=0) && ($row_user['branch_id']!=0) && ($row_user['sub_branch_id']!=0)){
		
		$user_type="DIVISION USER";          // sub branch user
		$region=$row_user['region_id'];
		$branch=$row_user['branch_id'];
		$sub_branch=$row_user['sub_branch_id'];
		
		
	}
}


$sub_branch_id=array();
$division=array();
$divisions_gp=array();
?>

<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<link rel="stylesheet" href="../css/style.css"/>
<title>Inventory</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
<SCRIPT language=JavaScript>

function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
self.location='frm_closing_stock.php?region=' + val ;
}

function reload3(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 

self.location='frm_closing_stock.php?region=' + val + '&branch=' + val2 ;
}

function reload4(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
var val3=form.subcat3.options[form.subcat3.options.selectedIndex].value; 

self.location='frm_closing_stock.php?region=' + val + '&branch=' + val2 + '&dgp=' + val3 ;
}

function validate(){
document.f1.submit();
}
</script>
</head>

<body>

<?php
switch($user_type){
	
	case 'TOP USER' : 
			
			 include('frm_head_office_for_product_wise_report.php');
			
			break;
			
	case 'REGION USER' : 
				
				include('frm_region_office.php');

			break;
			
	case 'BRANCH USER' : 
				
				include('frm_branch_office.php');

			break;
			
	case 'DIVISION USER' : 
				
				include('frm_division_office.php');

			break;
}
?>

<form method="post" name='f1' action='<?php echo "../modules/mod_closing_stock.php?usertype=".$user_type;?>'>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" ><br />


        <table border="0" align="center" cellpadding="3">
          <tr>
            <td width="365" bgcolor="#d6d6d6">

	<table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="rFont10">
		  <tr>
			<td colspan="2" bgcolor="#FF8306" valign="middle" class="head_text" height="25">&nbsp;<strong>Closing Stock</strong></td>
		  </tr>
		  <tr >
		    <td colspan="2" align="center" class="red"><strong><?php echo $msg;?></strong> </td>
		  </tr>
		  <tr > 

			<td width="221"><div align="left" class="style3_black">Region</div>
			  <div>
			   <?php
echo "<select name='cat' id='cat'  style='width:200px;' class='text1_black' onchange=\"reload(this.form)\">";
if($user_type=='TOP USER'){
echo "<option value=''>Select A Region</option>";
}
while($noticia2 = mysql_fetch_array($quer2)) { 
if($noticia2['region_id']==$cat){echo "<option selected value='".$noticia2['region_id']."'>".$noticia2['region_name']."</option>"."<BR>";}
else{echo  "<option value='".$noticia2['region_id']."'>".$noticia2['region_name']."</option>";}
}
echo "</select>";
?>
  
			    </div>          </td>
             <td width="232" align="left"><div align="left" class="style3_black">Branch</div><div>
			  <?php
echo "<select name='subcat' id='subcat' style='width:200px;' class='text1_black' onchange=\"reload3(this.form)\">";
if($user_type!='DIVISION USER'){
echo "<option value=''>Select Branch</option>";
}
while($noticia = mysql_fetch_array($quer)) { 
if($noticia['branch_id']==$cat3){echo "<option selected value='".$noticia['branch_id']."'>".$noticia['branch_name']."</option>"."<BR>";}
else{echo  "<option value='".$noticia['branch_id']."'>".$noticia['branch_name']."</option>";}
}
echo "</select>";
?>

			</div></td> 

		  <tr>
          <tr>
			<td></td>
			<td align="left"></td>
		  </tr>
			<td><div align="left" class="style3_black">Sub Branch</div><div><?php

echo "<select name='subcat3' id='subcat3' style='width:200px;' class='text1_black'>";
if($user_type!="DIVISION USER"){
	echo "<option value=''>Select Sub Branch</option>";
}
while($noticia = mysql_fetch_array($quer3)) { 

	echo "<option value='".$noticia['id']."'>".$noticia['sub_branch_name']."</option>";	

}
echo "</select>";
?></div></td>
			<td align="left">&nbsp;</td>
		  </tr>
		  <tr>
			<td></td>
			<td align="left"></td>
		  </tr>
          
                
		  <tr>
			<td></td>
			<td align="left">            			</td>
		  </tr>
		 <tr>	<td colspan="2" align="center">
<?php
if(($cat!="") && ($cat3!="") && ($dgp!="")){
echo "<input type='hidden' name='report_type' value='division'/>";
}
?>
<input type="button" name="Calculate" value="Calculate" onClick="validate();" />
         </td>
		  </tr>
		</table></td></tr></table>
</td></tr>
<tr><td height="176"></td></tr>
</table>
<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user']; ?>"/>
</form>
<?php include('../includes/footer_all.php'); ?>
</body>
</html>

