<?php
include('../connections/dbcon.php');
if (ini_get('max_execution_time') < 300) {
    set_time_limit(300);
}
$id=$_GET['id'];
$sql="SELECT narration FROM tbl_account_trans_details WHERE acc_tranc_id=".$id;
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
echo $row['narration'];

?>