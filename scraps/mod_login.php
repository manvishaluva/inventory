<?php
require_once('../MIS/connections/dbcon.php');
        session_start();
		$numrow=-1;
		  $uname=$_POST['username'];
		 $upass=$_POST['pass'];
		$query= "SELECT * FROM tbl_users WHERE user_name='$uname' AND user_password='$upass' AND user_active=1";
		$result=mysql_query($query) or die(mysql_error()) ;
		$numrow=mysql_num_rows($result);
		
			if($numrow==0){
			$_SESSION['login_error']="Invalid User";
			echo "<script>window.location='frm_login_screen.php'</script>";
			
			}else{
		$type_detail=mysql_fetch_assoc($result);
		 $type_name=$type_detail['id'];
		 
			$_SESSION['sess_user']=$type_name;
			
			echo "<script>window.location='dd3.php'</script>";
			
			}
?>
<!-- user_id 	user_name 	user_password 	region_id 	branch_id 	division_id user_active-->