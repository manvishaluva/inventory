<?php
	session_start();
	require_once('../../connections/dbcon.php');
	if($_SESSION['sess_admin']!=''){
	$user_name=$_SESSION['sess_admin'];
	}else{
		echo "<script>window.location='../index.php'</script>";
	}
	$msg=$_SESSION['error'];
	unset($_SESSION['error']);
	if(isset($_GET['id'])){
	$_SESSION['branch']=$_GET['id'];//to preserve values give session variable below 
	}

	/*if(isset($_GET['id'])){
		
		 $SQL_Query = "SELECT * FROM tbl_sub_branches where id=".$_GET['id'];
		 $result=mysql_query($SQL_Query);
		 $row=mysql_fetch_array($result);
		 $br_id=$row['branch_id'];
		 $brname=$row['sub_branch_name'];
		
	}*/
	 include('../../forms/frm_head_office_for_product_wise_report.php');
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
<link rel="stylesheet" href="../../css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inventory</title>
<SCRIPT language=JavaScript>

function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
self.location='frm_add_sub_branch.php?region=' + val ;
}

function reload3(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 

self.location='frm_add_sub_branch.php?region=' + val + '&branch=' + val2 ;
}


function validate(){
	if(document.getElementById('cat').value==''){
		alert('Please Select A Region');
		document.getElementById('cat').focus();
		return false;
	}
	if(document.getElementById('subcat').value==''){
		alert('Please Select A Branch');
		document.getElementById('subcat').focus();
		return false;
	}
	if(document.getElementById('subbrname').value==''){
		alert('Enter some Sub: Branch Name');
		document.getElementById('subbrname').focus();
		return false;
	}
		
document.f1.submit();
}
</script>

</head>



<body onLoad="MM_preloadImages('images/users w94 h93.jpg','images/regions w94 h93.jpg','images/branch w94 h93.jpg','images/sub branch w94 h93.jpg','images/divisions w94 h93.jpg','images/powered by manvish.jpg','images/log out w85 h93.jpg')">
<form method="post" name='f1' action='../modules/mod_add_sub_branches.php'>
<table width="1050" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="108">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="136" height="108" align="center" valign="middle" bgcolor="#eb5aa3">
        <a href="http://www.manvishonline.in/"><img src="../images/manvish new logo.jpg" width="136" height="115" /></a></td>
        
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

	<table border="0" align="center" cellpadding="5" cellspacing="2" bgcolor="#FFFFFF" class="rFont10">
		  <tr>
			<td colspan="2" bgcolor="#eb5aa3" valign="middle" class="head_text_admin" height="25">&nbsp;<strong>Cash Payments</strong></td>
		  </tr>
		  <tr >
		    <td colspan="2" align="center" class="red"><strong><?php echo $msg;?></strong> </td>
		  </tr>
		  <tr > 

			<td width="159"><div align="left" class="style3_black">Region</div>
			  <div>
			   <?php
echo "<select name='cat' id='cat'  style='width:200px;' class='text1_black' onchange=\"reload(this.form)\">";

echo "<option value=''>Select A Region</option>";

while($noticia2 = mysql_fetch_array($quer2)) { 
if($noticia2['region_id']==$cat){echo "<option selected value='".$noticia2['region_id']."'>".$noticia2['region_name']."</option>"."<BR>";}
else{echo  "<option value='".$noticia2['region_id']."'>".$noticia2['region_name']."</option>";}
}
echo "</select>";
?>
  
			    </div>          </td>
             <td width="182" align="left"><div align="left" class="style3_black">Branch</div><div>
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
			<tr>

			
			<td align="left" width="30px"><div align="left" class="style3_black">Sub Branch Name</div></td>
            <td align="left">
                  <div>
           <input type="text" class="style3_black" name="subbrname" id="subbrname" value="<?php echo $brname; ?>" style='width:200px;'/>

                  </div>
             </td>
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
         <input type="button" name="button" class="top_border" id="button" value="Save" onClick="validate();"/>&nbsp;
		 <input type="button" name="cancel" class="top_border" value="Cancel" onClick="location.href='frm_view_sub_branch.php'"/>

         </td>
		  </tr>
		</table></td></tr></table></td>
      </tr>
    </table></td>
  </tr>
  </table>
  <form>
  </body>
  </html>
  