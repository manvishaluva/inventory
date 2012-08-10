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
$name=$_POST['username'];
$pass=ENCRYPT_DECRYPT($_POST['pass']);

$fname=$_POST['fname'];
$role=$_POST['role'];
$region=$_POST['region'];
$branch=$_POST['branch'];
$division=$_POST['division'];
$uid= $_POST['uid'];
if(isset($_POST['submit1']))
{
	if($uid!=""){
	$SQl_Query1="UPDATE tbl_users SET user_full_name='$fname',user_role='$role',region_id='$region',branch_id='$branch',sub_branch_id='$division' WHERE user_id='$uid'";	
	$result1=mysql_query($SQl_Query1) or die(mysql_error());
	header('Location: ../forms/frm_view_users.php');exit();
			//s	}
	}else{
			 $SQl_Query1="SELECT * FROM tbl_users WHERE user_name='$name'";
			 $result1=mysql_query($SQl_Query1);
			 $rows = mysql_num_rows($result1);
				if($rows > 0)//CHECKING(THE USER IS ALREADY EXISTING OR NOT)
				{
					$_SESSION['error']="User Name already  exists";
					 header('Location: ../forms/frm_add_users.php?rflag=1');exit();
				}
			   else
			   {
				$SQl_Query="INSERT INTO tbl_users(user_password,user_name,user_full_name,user_role,region_id,branch_id,sub_branch_id)
				VALUES('$pass','$name','$fname','$role','$region','$branch','$division')";
				$result=mysql_query($SQl_Query);
				 header('Location: ../forms/frm_view_users.php');exit();
				}
		}
}

?>

