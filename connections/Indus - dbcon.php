<?php
    $dbHost="59.160.183.11";
	$dbUser="manvish";
	$dbpass="misdb";
	$dbname="db_mis";
	$conn = mysql_connect($dbHost, $dbUser, $dbpass) or trigger_error(mysql_error(),E_USER_ERROR);
	mysql_select_db( $dbname,$conn);
?>
