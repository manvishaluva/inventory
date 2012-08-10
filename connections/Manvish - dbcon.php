<?php
    $dbHost="76.162.254.175";
	$dbUser="C320085_manvish";
	$dbpass="Lr09Dc7ynsj";
	$dbname="C320085_manvish";
	$conn = mysql_connect($dbHost, $dbUser, $dbpass) or trigger_error(mysql_error(),E_USER_ERROR);
	mysql_select_db( $dbname,$conn);
?>
