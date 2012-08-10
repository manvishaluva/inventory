<?php
require_once('../../connections/dbcon.php'); 
session_start();
$regionandid=$_POST['region'];
list($region_id, $region_name) = split('/-/', $regionandid);
$branch=$_POST['brname'];
$branch=strtoupper($branch);
$uid= $_POST['branch_id'];
	if($uid!=""){  
		$SQl_Query1="SELECT * FROM tbl_branch_master WHERE  branch_name='$branch'" ;
			 $result2=mysql_query($SQl_Query1);
			 $rows =mysql_fetch_array($result2);
				if(($rows['branch_id']==$uid)&&($rows['region_name']==$region_name))
				{
					header('Location: ../forms/frm_view_branches.php');exit();
				}
				$SQl_Query3="UPDATE tbl_branch_master SET region_name='$region_name',region_id='$region_id',branch_name='$branch' WHERE branch_id='$uid'";	
				$result3=mysql_query($SQl_Query3) or die(mysql_error());
				header('Location: ../forms/frm_view_branches.php');exit();
				
	}else{
			 $SQl_Query1="SELECT * FROM tbl_branch_master WHERE branch_name='$branch'";
			 $result1=mysql_query($SQl_Query1);
			 $rows = mysql_fetch_array($result1);
			 
				if($rows['branch_name']==strtoupper($branch))//CHECKING(THE branch IS ALREADY EXISTING OR NOT)
				{
					$_SESSION['error']="Branch already  exists";
					 header('Location: ../forms/frm_add_branches.php?rflag=1');exit();
				}
			   else 
			   {
				$SQl_Query="INSERT INTO tbl_branch_master(region_name,region_id,branch_name)
				VALUES('$region_name','$region_id','$branch')";
				$result=mysql_query($SQl_Query);
				 header('Location: ../forms/frm_view_branches.php');exit();
				}
		}


?>

