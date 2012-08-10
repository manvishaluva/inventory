<?php
session_start();
include('../connections/dbcon.php');
if (ini_get('max_execution_time') < 300) {
    set_time_limit(300);
}
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
$sql="SELECT * FROM tbl_users WHERE user_id=".$_POST['id'];
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$opass=ENCRYPT_DECRYPT($row['user_password']);

$old=$_POST['opass'];
$npass=$_POST['npass'];

if($opass!=$old){
	$_SESSION['error']=1;
	
	if($_SESSION['uname']!='CHQUSER'){

	header('Location:../forms/frm_change_password.php');
	
	}else{
		header('Location:../forms/frm_change_password_cheq_u.php');
	}
}else{
	$pass=ENCRYPT_DECRYPT($npass);	
	$sql="UPDATE  tbl_users  SET user_password='$pass' WHERE user_id=".$_POST['id'];
	$result=mysql_query($sql);
	$_SESSION['ok']=1;
	if($_SESSION['uname']!='CHQUSER'){
	header('Location:../forms/frm_home.php');
	}else{
		header('Location:../forms/frm_cheque_home.php');
	}
}
?>
