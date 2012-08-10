<?php
if($cat==""){
	//echo "1"; head office + all branch + all division
	
	$quer2=mysql_query("SELECT * FROM tbl_region_master where region_id =$region order by region_name"); 

	$quer=mysql_query("SELECT DISTINCT branch_name,branch_id FROM tbl_branch_master WHERE region_id=$region AND branch_id=$branch order by branch_name");
	
	
}
 
 
$cat=$_GET['region']; // This line is added to take care if your global variable is off

$cat3=$_GET['branch']; // This line is added to take care if your global variable is off

$dgp=$_GET['dgp'];


if($cat3!=""){
	//echo "2"; head office + any one branch + all divisions of that branch
	
	$quer3=mysql_query("SELECT DISTINCT sub_branch_name,id,branch_id FROM tbl_sub_branches where branch_id =$cat3 order by sub_branch_name"); 
	
}

 	 	

?>
