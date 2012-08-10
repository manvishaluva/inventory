<?php

if($cat==""){
	$quer2=mysql_query("SELECT DISTINCT region_name,region_id FROM tbl_region_master order by region_id"); 
}
 
 
$cat=$_GET['region']; // This line is added to take care if your global variable is off

$cat3=$_GET['branch']; // This line is added to take care if your global variable is off

$dgp=$_GET['dgp'];


if(($cat3!="")){
	//echo "2"; head office + any one branch + all divisions of that branch
	
	$quer3=mysql_query("SELECT  * FROM tbl_sub_branches where branch_id =$cat3 order by sub_branch_name");  
	
}

if($cat!=""){
	//echo "3"; single region + all branch of a region + all divisions of that perticular region
	
	$quer=mysql_query("SELECT DISTINCT branch_name,branch_id FROM tbl_branch_master WHERE region_id=$cat order by branch_name");

//$quer3=mysql_query("SELECT DISTINCT * FROM tbl_sub_branches where  region_id=$cat order by division_name"); 

}

?>