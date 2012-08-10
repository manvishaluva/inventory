<?php
require_once('../../connections/dbcon.php'); 
session_start();
$branch=$_POST['subcat'];
$subbranch=$_POST['subbrname'];
$subbranch=strtoupper($subbranch);
$flg=0			 ;
			 $SQl_Query1="SELECT * FROM tbl_sub_branches WHERE sub_branch_name='$subbranch'";
			 $result1=mysql_query($SQl_Query1);
			 while( $rows = mysql_fetch_array($result1)){
				if($rows['sub_branch_name']==$subbranch)//CHECKING(THE USER IS ALREADY EXISTING OR NOT)
				{
					$_SESSION['error']="Sub Branch already  exists";
					 header('Location: ../forms/frm_add_sub_branch.php?rflag=1');exit();
					 $flg=1;
				}
			 }
			   if( $flg==0)
			   {
				$SQl_Query="INSERT INTO tbl_sub_branches(branch_id,sub_branch_name)
				VALUES('$branch','$subbranch')";
				$result=mysql_query($SQl_Query);
				 header('Location: ../forms/frm_view_sub_branch.php');exit();
				}


?>

