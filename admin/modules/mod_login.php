<?php
require_once('../../connections/dbcon.php');
        session_start();
		
	
	function ENCRYPT_DECRYPT($Str_Message) {
	$Len_Str_Message=STRLEN($Str_Message);
	$Str_Encrypted_Message="";
	FOR ($Position = 0;$Position<$Len_Str_Message;$Position++){
	$Key_To_Use = (($Len_Str_Message+$Position)+1); // (+5 or *3 or ^2)
	$Key_To_Use = (255+$Key_To_Use) % 255;
	$Byte_To_Be_Encrypted = SUBSTR($Str_Message, $Position, 1);
	$Ascii_Num_Byte_To_Encrypt = ORD($Byte_To_Be_Encrypted);
	$Xored_Byte = $Ascii_Num_Byte_To_Encrypt ^ $Key_To_Use;  //xor operation
	$Encrypted_Byte = CHR($Xored_Byte);
	$Str_Encrypted_Message .= $Encrypted_Byte;
	
	}
	RETURN $Str_Encrypted_Message;
	} 

		
		
		$numrow=-1;
		  $uname1=$_POST['username1'];
		 $upass1=ENCRYPT_DECRYPT($_POST['pass1']);
		 
		 
		$query= "SELECT * FROM tbl_users WHERE user_name='$uname1' AND user_password='$upass1' AND user_active=1 AND user_role='Mis'";
		$result=mysql_query($query) or die(mysql_error()) ;
		
		$numrow=mysql_num_rows($result);
		
			if($numrow==0){
			$_SESSION['login_error']="Invalid User";
			echo "<script>window.location='../index.php'</script>";
			
			}else{
			$type_detail=mysql_fetch_assoc($result);
			 $type_name=$type_detail['user_id'];
			 
			 if(($type_detail['profit_anlys']&&$type_detail['led__anlys']&&$type_detail['fund_anlys']&&$type_detail['chq_reg'])==1){
		 
			$_SESSION['sess_admin']=$type_name;
			
			echo "<script>window.location='../forms/frm_home.php'</script>";
			 }else{
				 
				 $_SESSION['login_error']="You have no permission to Login here";
			echo "<script>window.location='../index.php'</script>";
				 
			 }
			
			}
?>
<!-- user_id 	user_name 	user_password 	region_id 	branch_id 	division_id user_active-->