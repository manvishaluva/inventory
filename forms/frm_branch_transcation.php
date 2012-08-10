<?php 
session_start();
if(isset($_SESSION['sess_user'])){
$user_id=$_SESSION['sess_user'];
}else{
header('Location: ../index.php');exit();
}
?>
<table width="100%">
<tr height="20px;"><td></td></tr>
<tr><td align="center"><?php include('../includes/head_all.php'); ?></td></tr>
</table>
<?php
include('../connections/dbcon.php');
if($_GET['error']==1){
$msg="Wrong Date Selection";
}elseif($_GET['error']==2){
	$msg='No Values Found';
}

$sql_querry="SELECT * FROM tbl_users WHERE user_id=".$user_id;
$result=mysql_query($sql_querry);
if($row_user=mysql_fetch_array($result)){
	
	if(($row_user['region_id']==0) && ($row_user['branch_id']==0) && ($row_user['sub_branch_id']==0)){
		
		$user_type="TOP USER";
		
		
	}else if( ($row_user['region_id']!=0) && ($row_user['branch_id']!=0) && ($row_user['sub_branch_id']==0)){
		
		$user_type="BRANCH USER";
		$region=$row_user['region_id'];
		$branch=$row_user['branch_id'];
		
	}else if( ($row_user['region_id']!=0) && ($row_user['branch_id']==0) && ($row_user['sub_branch_id']==0)){

		$user_type="REGION USER";
		$region=$row_user['region_id'];
		
	}else if( ($row_user['region_id']!=0) && ($row_user['branch_id']!=0) && ($row_user['sub_branch_id']!=0)){

		$user_type="SUBBRANCH USER";
		$region=$row_user['region_id'];
		$branch=$row_user['branch_id'];
		
		$sub_branch=$row_user['sub_branch_id'];
		
	}
}


$sub_branch_id=array();
$division=array();
$divisions_gp=array();
?>


<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/cal_style.css" />
<script type="text/javascript" src="../js/cheque_validate.js"></script>
<script type="text/javascript" src="../js/jscal.js"></script>
<SCRIPT language=JavaScript>

function reload(form)
{
var val=form.branch.options[form.branch.options.selectedIndex].value; 
self.location='frm_branch_transcation.php?branch=' + val ;
}

function validate(){
	
		var val=document.getElementById('stdate').value; 
		var val1=document.getElementById('enddate').value;
		
			if(document.getElementById('branch').value==''){
				
				alert('Please Select Some Branch');
				document.getElementById('branch').focus();
				return false;
			}
		
			if(val==""){
			alert("Please enter one Starting date");
			document.frm1.stdate.focus();
			return false;
			}
			if (val1==""){
			alert("Please enter one Ending date");
			document.frm1.enddate.focus();
			return false;
			}
			
			if(val>val1){
				alert('Check Your Starting Date');
				document.getElementById('stdate').focus();
				return false;
			}
				document.frm1.submit();
			
			
}

</script>

<link rel="stylesheet" href="../css/style.css"/>
<title>Inventory</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>
</html>
<?php
switch($user_type){
	
	case 'TOP USER' : 
			
			 include('frm_head_office.php');
			
			break;
			
	case 'BRANCH USER' : 
				
				include('frm_branch_office.php');

			break;
			
	case 'REGION USER' : 
				
				include('frm_region_office.php');

			break;
			
	case 'SUBBRANCH USER' : 
				
				include('frm_sub_branch.php');

			break;
			
}
?>

<form method="post" name='frm1' action="frm_view_transc_details.php">

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td valign="top" ><br />


        <table border="0" align="center" cellpadding="3">
          <tr>
            <td bgcolor="#d6d6d6">

	<table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#FFFFFF" class="rFont10">
		  <tr>
			<td colspan="2" bgcolor="#FF8306" valign="middle" class="head_text" height="25">&nbsp;<strong>Branch Transfer</strong></td>
		  </tr>
		  <tr >
		    <td colspan="2" align="center" class="red"><strong><?php echo $msg;?></strong> </td>
		  </tr>
		  <tr > 

<td align="left"><div align="left" class="style3_black">Branch</div><div>
			  <?php
echo "<select name='branch' id='branch' style='width:200px;' class='text1_black' onchange=\"reload(this.form)\">";
echo "<option value=''>Select</option>";
while($noticia = mysql_fetch_array($quer)) { 
if($noticia['branch_id']==$cat3){echo "<option selected value='".$noticia['branch_id']."'>".$noticia['branch_name']."</option>"."<BR>";}
else{echo  "<option value='".$noticia['branch_id']."'>".$noticia['branch_name']."</option>";}
}
echo "</select>";
?>

			</div></td>
             <td align="left"><div align="left" class="style3_black">Sub Branch</div><div>
		
    
    			  <?php
echo "<select name='sub_branch' id='sub_branch' class='text1_black' style='width:200px;'>";
echo "<option value=''>Select</option>";
while($sub_br = mysql_fetch_array($quer3)) { 
echo  "<option value='".$sub_br['id']."'>".$sub_br['sub_branch_name']."</option>";
}
echo "</select>";
?>

			</div></td> 

		  <tr>
          <tr>
			<td></td>
			<td align="left"></td>
		  <tr>
			<td></td>
			<td align="left"></td>
		  </tr>
		  <tr>

			<td><div align="left" class="style3_black"> Starting Date</div>
            <div>
            <input type="date" name="stdate" id="stdate" value="" style='width:200px;'/>
            </div>
            </td>
			<td align="left"><div align="left" class="style3_black">Ending Date</div>
                  <div>
           <input type="date" name="enddate" id="enddate" value="" style='width:200px;'/>

                  </div>
             </td>
		  </tr>
          
                
		  <tr>
			<td></td>
			<td align="left">            			</td>
		  </tr>
		 <tr>	<td colspan="2" align="center">
<input type="button" name="bti" id="bti" value="Ok" onClick="validate()"/>

         </td>
		  </tr>
		</table></td></tr></table>
</td></tr>
<tr><td height="174"></td></tr>
</table>
</form>
<?php include('../includes/footer_all.php'); ?>
</body>
</html>

