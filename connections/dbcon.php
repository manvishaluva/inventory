<?php
    $dbHost="localhost";
	$dbUser="root";
	$dbpass="";
	$dbname="db_inventory";
	$conn = mysql_connect($dbHost, $dbUser, $dbpass) or trigger_error(mysql_error(),E_USER_ERROR);
	mysql_select_db( $dbname,$conn);
?>
