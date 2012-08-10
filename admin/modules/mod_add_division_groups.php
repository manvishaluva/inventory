<?php
	require_once('../../connections/dbcon.php'); 
    session_start();
    $title=$_POST['section'];
	$title=strtoupper($title);

	if(isset($_POST['submit'])){
		if($_POST['group_id']=="")
		{
			$SQl_Query2="SELECT * FROM tbl_division_groups WHERE group_names='$title'";
			 	$result2=mysql_query($SQl_Query2);
				$rows = mysql_num_rows($result2);
				if($rows > 0)//CHECKING(THE USER IS ALREADY EXISTING OR NOT)
				{
					$_SESSION['error']="Division Group Name already  exists";
					 header('Location: ../forms/frm_add_division_groups.php?id=$id');exit();
				}else{
				$SQl_Query2="INSERT INTO tbl_division_groups(group_names)VALUES('$title')";
				$result=mysql_query($SQl_Query2);
				echo "<script>window.location='../forms/frm_view_division_groups.php'</script>";
				}
		}
		
	}

?>
