<?php
session_start();

if(isset($_SESSION['sess_user'])){
$user_id=$_SESSION['sess_user'];
}else{
header('Location: ../index.php');exit();
}
include('../connections/dbcon.php');
?><head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<link href="../css/style_front.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function EnableDisable(id,action){
		location.href='../modules/enabledisable.php?tbl=tbl_mis_freezing' + '&action='+ action +'&set=mis_value=' + '&cond=id=' + id + '&url=../forms/frm_home.php';
}
</script>
</head>



<div class="nav-container-outer">
   <img src="../images/nav-bg-l.jpg" alt="" class="float-left" />
   <img src="../images/nav-bg-r.jpg" alt="" class="float-right" />
   <ul id="nav-container" class="nav-container">
      <li><a class="item-primary" href="../forms/frm_cheque_home.php">HOME</a>
         </li>
      <li><a class="item-primary" href="../forms/frm_cheq_delivary.php">Cheque-Delivery</a>
         </li>
          <li><a href="../forms/frm_change_password_cheq_u.php">Change-Password</a>
          <li><a href="../modules/mod_logout.php">Log Out</a>
         </li>
   <li class="clear">&nbsp;</li></ul>
</div>
