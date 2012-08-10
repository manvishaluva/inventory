<?php 
if (ini_get('max_execution_time') < 300) {
    set_time_limit(300);
}
	require_once('../../connections/dbcon.php'); 
	if($_GET['action']=='enable'){
		$SQL_Query = "UPDATE ".$_GET['tbl']." SET ".$_GET['set'] ."1 WHERE ".$_GET['cond'];
	}else{
		 $SQL_Query = "UPDATE ".$_GET['tbl']. " SET ".$_GET['set']."0 WHERE ".$_GET['cond'];
	}
	$result1 = mysql_query($SQL_Query) or die(mysql_error());
	
	header("location:".$_GET['url']);exit();
	
?>
