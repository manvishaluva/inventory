<?php
	$quer2=mysql_query("SELECT * FROM tbl_region_master where region_id =$region order by region_name"); 

	$quer=mysql_query("SELECT DISTINCT branch_name,branch_id FROM tbl_branch_master WHERE branch_id=$branch order by branch_name");
	
	$quer3=mysql_query("SELECT DISTINCT sub_branch_name,id,branch_id FROM tbl_sub_branches where id =$sub_branch order by sub_branch_name"); 
?>
