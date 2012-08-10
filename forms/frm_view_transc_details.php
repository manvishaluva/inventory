<?php
session_start();
if($_SESSION['sess_user']!=""){
require_once('../connections/dbcon.php'); 
include('../admin/functions/ps_pagination.php');
	if(!isset($_GET['id'])){
			
	$_SESSION['end']=$_POST['enddate'];
	$_SESSION['std']=$_POST['stdate'];
	$_SESSION['brid']=$_POST['branch'];
	$_SESSION['sub_branch']=$_POST['sub_branch'];


	}

	$std=$_SESSION['std'];
	
	$end=$_SESSION['end'];

	$brid=$_SESSION['brid'];
	
	$sub_branch=$_SESSION['sub_branch'];

	$type=$_SESSION['type'];
	
		  
}else{
	header('Location:../index.php');exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript" src="jquery-1.2.2.pack.js"></script>

<style type="text/css">

div.htmltooltip{
position: absolute; /*leave this and next 3 values alone*/
z-index: 1000;
left: -1000px;
top: -1000px;
background: #272727;
border: 10px solid black;
color: white;
padding: 3px;
width: 50px; /*width of tooltip*/
}

</style>

<script type="text/javascript" src="htmltooltip.js">

/***********************************************
* Inline HTML Tooltip script- by JavaScript Kit (http://www.javascriptkit.com)
* This notice must stay intact for usage
* Visit JavaScript Kit at http://www.javascriptkit.com/ for this script and 100s more
***********************************************/

</script>


<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript">

function abcd(){
	alert('dsfsdkn');
}

function DeleteUser(id){
  	if(confirm("Are you sure you want to delete this Entry?")){
		location.href='../modules/delete.php?tbl=tbl_cheque_tran_details'+'&cond=id='+id+'&url=../forms/frm_view_chq_details.php'+'&sp=#23%';
	}
}

function EditDispatched(id){
  	if(confirm("Are you sure you want to Make It Processed?")){
	location.href='../modules/mod_cheque_dispatched.php?tbl=tbl_cheque_tran_details'+'&cond=id='+id+'&url=../forms/frm_view_chq_details.php'+'&id=#23%';
	}
}


function loadval(id){
	document.getElementById(id).innerHTML="Click Here";
}

var popUpWin=0;
function popUpWindow(id, left, top, width, height)
{
  if(popUpWin)
  {
    if(!popUpWin.closed) popUpWin.close();
  }
  URLStr='../modules/mod_branch_trans_details.php?id='+id;
  popUpWin = window.open(URLStr, 'popUpWin', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=yes, width='+width+', height='+height+', left='+left+', top='+top+', screenX='+left+', screenY='+top+'');
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Inventory</title><link rel="stylesheet" type="text/css" href="../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../css/style_tool_tip.css"/>

<textarea id="dhtmltooltip"></textarea>

<style type="text/css">
#dhtmltooltip {
position: absolute;
width: 150px;
border: 1px solid #C1C1C1;
padding: 2px;
background-color: #EFEFEF;
color: #000000;
visibility: hidden;
z-index: 100;
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
}
<!--
.style1 {color: #FFFFFF}
.style3 {color: #FFFFFF; font-weight: bold; }
.popup { 
	padding:10px;
	border:1px solid #ccc;
	background:#eee;
	width:250px;
	font-size: small; 
	position:relative;
	float:inherit;
 }
-->
</style>
</head>

<body>


<form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr height="20px;"><td></td>
<tr height="20px;"><td width="100%" bgcolor="#FFFFFF" valign="middle" align="center"><?php  include('../includes/head_all.php'); ?></td></tr>
 <tr height="20px;"><td colspan="6"></td></tr>

<tr><td valign="top"  >
        <table border="0" align="center" cellpadding="3" width="88%">
          <tr>
            <td bgcolor="#d6d6d6" ><table border="0" align="center" cellpadding="5" cellspacing="1px" bgcolor="#FFFFFF" class="rFont10">
          <tr>
            <td colspan="14" bgcolor="#FF8306" class="head_text" height="25">Transcation Details</td>
          </tr>
          <tr bgcolor="#333333">
            <td class="head_text" colspan="3"> For </td><td colspan="11"  class="head_text" height="25">
			<?php
			$sql="select branch_name from tbl_branch_master where branch_id='$brid'";
			$result=mysql_query($sql);	
			$row=mysql_fetch_array($result);
			echo ucwords($row['branch_name']);
            ?>
            </td>
          </tr>
          <tr bgcolor="#333333">
            <td colspan="3" class="head_text">From</td><td colspan="4" class="head_text" height="25"><?php echo $std ; ?></td>
           
             <td class="head_text" colspan="3"> To </td><td colspan="4"  class="head_text" height="25"><?php echo $end; ?></td>
          </tr>


          <tr bgcolor="#666666">
            <td height="25" align="center" width="133" class="style3_head">Voucher Date</td>
            <td width="187" height="25" align="center"  class="style3_head" >Voucher No</td>
            <td width="197" height="25" align="center"  class="style3_head"  >Decsription</td>
			<td   height="25" align="center"   width="103" nowrap="nowrap" class="style3_head">Voucher Type</td>
            
            <td height="25" align="center" width="133"class="style3_head">Party Name</span></td>
            <td width="187" height="25" align="center"  class="style3_head" >Party Address</td>
            
            <td width="140" height="25" align="center"  class="style3_head" >Bill Amount</td>
            
			<td  class="style3_head" height="25" align="center"   width="103" nowrap="nowrap">From Branch</td>
            <td width="140" height="25" align="center"  class="style3_head" >From Sub: Branch</td>
            <td width="140" height="25" align="center"  class="style3_head" >To Branch</td>
            <td width="140" height="25" align="center"  class="style3_head" >To Sub: Branch</td>
          </tr>
             <?php
	if( $sub_branch=='' ){
		
		$sql_user_1="select sub_branch_id  from tbl_users where user_id=".$_SESSION['sess_user'];
		$result_user_1=mysql_query($sql_user_1);
		$row_user_chk= mysql_fetch_assoc($result_user_1);
		
		
		if($row_user_chk['sub_branch_id']==0){
			
		    $sql="select * from tbl_branch_trans_details where  frm_branch ='$brid'  and voucher_date between '$std' and '$end' ";
			
		}else{
			
			$sql="select * from tbl_branch_trans_details where   frm_sub_branch=".$row_user_chk['sub_branch_id']." OR 
			to_sub_branch=".$row_user_chk['sub_branch_id']." AND  voucher_date between '$std' and '$end' ";
			
		}
		
		
	}else{
		
		$sql="select * from tbl_branch_trans_details where  frm_sub_branch='$sub_branch' OR to_sub_branch='$sub_branch' AND voucher_date between '$std' and '$end' ";

	}
$result=mysql_query($sql);	
$count=mysql_num_rows($result);


			if($count!=0){
                    while($row_user=mysql_fetch_assoc($result))
                    {
						$check_sql="select count(id) as differ from tbl_branch_trans_inventory where  branch_tranc_id='"
						.$row_user['branch_tranc_id']."'AND qty_received < item_quantity ";
						$result_check=mysql_query($check_sql);
						 $row_check=mysql_fetch_assoc($result_check);
            ?>
 	 	 	 	 	 	 	 	 	 	 	    
        	 <tr height="20"<?php if($row_count%2==0) echo 'bgcolor="#F7F7F7"'; if($row_check['differ']!=0) echo "class='red_cheq'"; ?> >
            
            <td   align="left" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $row_user['voucher_date']; ?></td>
			<td   align="center" class="rFont9">
            
           	 <a href="../modules/mod_branch_trans_details.php?id=<?php echo $row_user['branch_tranc_id']; ?>" target="_blank" onclick=	
             "popUpWindow('<?php echo $row_user['branch_tranc_id']; ?>',110,100,700,500);return false" rel="htmltooltip">
			<?php echo $row_user['voucher_no']; ?> </a>
            
            <!-- Tool Tip for Displaying How many Transcations have Difference -->
            <?php if($row_check['differ']!=0) echo "<div class='htmltooltip'>".$row_check['differ']."</div>";?>
            
			
            </td>
			<td   align="center" bordercolor="#E9E9E9"><span class="hotspot" onmousedown="tooltip.show('<?php echo $row_user['branch_tranc_id']?>');" onmouseout="tooltip.hide();">D:Click here</span></td>
            
            <td   align="left" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $row_user['voucher_type_name']; ?></td>
            <td   bordercolor="#E9E9E9" align="left" class="red_1"><?php echo $row_user['party_name']; ?></td>
                   
			<td   align="left" class="text1_cheq"><?php echo $row_user['party_address']; ?></td>
            
			<td   bordercolor="#E9E9E9" align="right" class="text1_cheq"> <?php echo abs($row_user['bill_amount']); ?> </td>
       		
			<?php  
			$sql="select branch_name from tbl_branch_master where branch_id='".$row_user['frm_branch']."'";
			$result12=mysql_query($sql);	
			$row=mysql_fetch_array($result12);
			
            ?>    
           	

            <td   bordercolor="#E9E9E9" align="left" class="text1_cheq"><?php echo ucwords($row['branch_name']); ?></td>
            
            <?php 
			$sql="select sub_branch_name from tbl_sub_branches where id='".$row_user['frm_sub_branch']."'";
			$result12=mysql_query($sql);	
			$row=mysql_fetch_array($result12);
			
            ?>
            <td   bordercolor="#E9E9E9" align="left" class="red_1"><?php echo ucwords($row['sub_branch_name']); ?></td>
            
			<?php  
			$sql="select branch_name from tbl_branch_master where branch_id='".$row_user['to_branch']."'";
			$result12=mysql_query($sql);	
			$row=mysql_fetch_array($result12);
			
            ?>    
			<td   align="left" class="text1_cheq"><?php echo ucwords($row['branch_name']); ?></td>
            
            <?php 
			$sql="select sub_branch_name from tbl_sub_branches where id='".$row_user['to_sub_branch']."'";
			$result12=mysql_query($sql);	
			$row=mysql_fetch_array($result12);
			
            ?>
			<td   align="left" class="text1_cheq"><?php echo ucwords($row['sub_branch_name']); ?></td>
            
			</tr>
           <?php
                        $row_count++;
					
              	 }
				 
				}else{
					?>
                    <tr><td width="197" height="25" align="center"  colspan="14" style="color:#F00"  >No Transcation Found</td></tr>
                    
			<?php		
				}
				
           ?>
           
        </table></td></tr>
       
       <tr><td  colspan="14" height="40px;"  ></td></tr> 
        
        </table>
</td></tr>
<tr><td height="174"></td></tr>
</table>
</form>
<?php include('../includes/footer_front.php') ?>

</body>
</html>