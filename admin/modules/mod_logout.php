<?php
session_start();
$_SESSION['sess_admin']="";
unset($_SESSION['sess_admin']);
echo "<script>window.location='../index.php'</script>";
?>
