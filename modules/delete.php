<?php
	require_once('../connections/dbcon.php');
	if (ini_get('max_execution_time') < 300) {
    set_time_limit(300);
    }
	$SQL_Query = "DELETE FROM ".$_GET['tbl']. " WHERE ".$_GET['cond'];
	$RS_Execute = mysql_query($SQL_Query) or die(mysql_error());
	//this if can be removed to use this module as a general one
	if($_GET['sp']='#23%'){
	$url=$_GET['url'].'?id=1';
	}else{
	$url=$_GET['url'];	
	}
	header("location:".$url);exit();
?>