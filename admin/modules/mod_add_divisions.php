<?php
require_once('../../connections/dbcon.php'); 
session_start();
$regionandid=$_POST['region'];
$branch=$_POST['branch'];
$division_gp=$_POST['division'];
$division=$_POST['dname'];
$division=strtoupper($division);
$uid= $_POST['division_id'];
	if($uid!=""){  
		$SQl_Query1="SELECT * FROM tbl_divisions WHERE  division_name='$division'" ;
			 $result2=mysql_query($SQl_Query1);
			 while($rows =mysql_fetch_array($result2))
			 {
				if(($rows['branch_id']==$branch)&&($rows['region_id']==$regionandid)&&($rows['division_group_name']==$division_gp))
				{
					header('Location: ../forms/frm_view_divisions.php');exit();
				}
			 }
				$SQl_Query3="UPDATE tbl_divisions SET region_id='$regionandid',branch_id='$branch',division_name='$division',division_group_name='$division_gp' WHERE division_id='$uid'";	
				$result3=mysql_query($SQl_Query3) or die(mysql_error());
				header('Location: ../forms/frm_view_divisions.php');exit();
				
	}else{

			 $SQl_Query1="SELECT * FROM tbl_divisions WHERE division_name='$division'";
			 $result1=mysql_query($SQl_Query1);
			while($rows = mysql_fetch_array($result1))
			{
			 
				if(($rows['branch_id']==$branch))
				{
					$_SESSION['error']="This division name already  exists under the Selected Branch";
					 header('Location: ../forms/frm_add_division.php');exit();
					 
				}
			}
			$SQl_Query="select group_id from tbl_division_groups where group_names='$division_gp'";
			$result=mysql_query($SQl_Query); 
			$row=mysql_fetch_assoc($result);
			$gpid=$row['group_id'];
				$SQl_Query="INSERT INTO tbl_divisions(branch_id,region_id,division_name,division_group_name,division_group_name_id)
				VALUES('$branch','$regionandid','$division','$division_gp',$gpid)";
				$result=mysql_query($SQl_Query);
				header('Location: ../forms/frm_view_divisions.php');exit();
		}


?>

