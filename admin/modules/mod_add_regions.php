<?php
	require_once('../../connections/dbcon.php'); 
    session_start();
    $title=$_POST['section'];
	$title=strtoupper($title);
	if(isset($_POST['submit'])){
		if($_POST['region_id']=="")
		{
			$SQl_Query2="SELECT * FROM tbl_region_master WHERE region_name='$title'";
			 	$result2=mysql_query($SQl_Query2);
				$rows = mysql_num_rows($result2);
				if($rows > 0)//CHECKING(THE USER IS ALREADY EXISTING OR NOT)
				{
					$_SESSION['error']="Region already  exists";
					 header('Location: ../forms/frm_add_regions.php?id=$id');exit();
				}else{
				$SQl_Query2="INSERT INTO tbl_region_master(region_name)VALUES('$title')";
				$result=mysql_query($SQl_Query2);
				echo "<script>window.location='../forms/frm_view_regions.php'</script>";
				}
		}
		
	}

?>
