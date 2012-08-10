<?php
	require_once('../../connections/dbcon.php'); 
    session_start();
    $title=$_POST['section'];
	$title=strtoupper($title);

	if(isset($_POST['submit'])){
		if($_POST['group_id']=="")   //mapping_id Ascending 	mapping_group_name   tbl_ledger_group_mapping
		{
			$SQl_Query2="SELECT * FROM tbl_ledger_group_mapping WHERE mapping_group_name='$title'";
			 	$result2=mysql_query($SQl_Query2);
				$rows = mysql_num_rows($result2);
				if($rows > 0)//CHECKING(THE name IS ALREADY EXISTING OR NOT)
				{
					$_SESSION['error']="Ledger Mapping Name already  exists";
					 header('Location: ../forms/frm_add_mapping_led_groups.php?id=$id');exit();
				}else{
				$SQl_Query2="INSERT INTO tbl_ledger_group_mapping(mapping_group_name)VALUES('$title')";
				$result=mysql_query($SQl_Query2);
				echo "<script>window.location='../forms/frm_view_mapping_led_groups.php'</script>";
				}
		}
		
	}

?>
