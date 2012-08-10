<?php

if($cat==""){
	//echo "1"; head office + all branch + all division
	
	$quer=mysql_query("SELECT DISTINCT branch_name,branch_id FROM tbl_branch_master order by branch_name");
	
	$quer2=mysql_query("SELECT DISTINCT region_name,region_id FROM tbl_region_master order by region_name"); 
	
   //$quer3=mysql_query("SELECT DISTINCT sub_branch_name,id,branch_id FROM tbl_sub_branches  order by sub_branch_name"); 
	 // id 	branch_id 	sub_branch_name
}
 
 

$cat3=$_GET['branch']; // This line is added to take care if your global variable is off



if(($cat3!="")){
	//echo "2"; head office + any one branch + all divisions of that branch
	
	$quer3=mysql_query("SELECT DISTINCT sub_branch_name,id,branch_id  FROM tbl_sub_branches   where branch_id =$cat3 order by sub_branch_name"); 
	
}
?>