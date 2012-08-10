<?php
session_start();
include('../connections/dbcon.php');
if (ini_get('max_execution_time') < 300) {
    set_time_limit(300);
}
$brids=$_SESSION['branch'];
$val=$_GET['a'];
$sql="SELECT * FROM tbl_cheque_tran_details WHERE chq_no LIKE '$val%' AND branch_id IN($brids)" ;
$result=mysql_query($sql);
?>

<table border="0" align="center" cellpadding="3">
<tr>
  <td bgcolor="#FF8306">  
  <table border="0" align="center" cellpadding="5" cellspacing="1px" bgcolor="#FFFFFF" class="rFont10">
    <tr>
      <td colspan="12" bgcolor="#FF8306" class="head_text" height="25">Cheques Ready To Delivery
        <div style="float:right">Cheque #:
          <input type="text" name="search" id="search" style="width:150px;" value=""/>
          <input type="button" name="bt1" value="Search" onclick="search_chq();"/>
        </div></td>
    </tr>
        <tr bgcolor="#999999">
        <td colspan="12" class="text1_black">&nbsp;<div style="float:right">Sort By:<input type="radio" name="sort1" value="1" onclick="sorting();" />Porcessed<input type="radio" name="sort1" value="2"  onclick="sorting();"/>Dispatched<input type="radio" name="sort1" value="3"  onclick="sorting();"/>All </div></td>
        </tr>
    <tr bgcolor="#666666">
      <td height="25" align="center" width="133" class="style3_head">Req Date</td>
      <td width="187" height="25" align="center"  class="style3_head" >Req No</td>
      <td  class="style3_head" height="25" align="center"   width="103" nowrap="nowrap">Req A/c Name</td>
      <td height="25" align="center" width="133"class="style3_head">Req Amount</span></td>
      <td width="187" height="25" align="center"  class="style3_head" >PMT Date</td>
      <td width="197" height="25" align="center"  class="style3_head"  >Voucher No</td>
      <td width="140" height="25" align="center"  class="style3_head" >PMT A/c Name</td>
      <td  class="style3_head" height="25" align="center"   width="103" nowrap="nowrap">PMT Amount</td>
      <td width="140" height="25" align="center"  class="style3_head" >CHQ No</td>
      <td width="140" height="25" align="center"  class="style3_head" >CHQ Date</td>
      <td width="140" height="25" align="center"  class="style3_head" >Status</td>
      <td width="197" height="25" align="center"  class="style3_head"  >Dispatch Time</td>

    </tr>
    <?php		
			$count=mysql_num_rows($result);

			if($count!=0){
                    while($row_user=mysql_fetch_assoc($result))
                    {
            ?>
    <tr height="20"<?php if($row_count%2==0) echo 'bgcolor="#F7F7F7"';?> >
      <td   align="left" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $row_user['pay_req_date']; ?></td>
      <td   align="center" class="rFont9"><?php echo $row_user['pay_req_no']; ?></td>
      
      <td   align="left" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $row_user['pay_ac_name']; ?></td>
      <td   bordercolor="#E9E9E9" align="right" class="red_1"><?php echo $row_user['pay_req_amount']; ?></td>
      <td   align="center" class="text1_cheq"><?php echo $row_user['pay_resp_date']; ?></td>
      <td   align="center" bordercolor="#E9E9E9" align="center" class="text1_cheq">
      
      <?php echo $row_user['pay_voucher_no']; ?>
      
    </td>
    
    
    <td   bordercolor="#E9E9E9" align="left" class="text1_cheq"><?php echo $row_user['pay_resp_ac_name']; ?></td>
      <td   bordercolor="#E9E9E9" align="right" class="red_1"><?php echo $row_user['pay_resp_amount']; ?></td>
      <td   align="center" class="text1_cheq"><?php echo $row_user['chq_no']; ?></td>
      <td   align="left" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $row_user['chq_date']; ?></td>
      <td   align="left" bordercolor="#E9E9E9" class="text1_cheq" style="" ><?php 
			if($row_user['req_status']==0){
				echo " <span style='text-decoration:blink;color:#F00'>Waiting</span>";
			}else if (($row_user['req_status']==1)||($row_user['req_status']==5)){
			?>
 <span style='color:#1DAFE0'><a href='../modules/mod_cheque_dispatched.php?chno=<?php echo $row_user['chq_no'] ?> & url=../forms/frm_delivery_details.php' style='text-decoration:blink;color:#F00'>Processing</a></span>               
            <?php	
			}else{
				echo "<span style='color:#7500EA;'> <marquee>Dispatched </marquee></span>";
			}
			?></td>
     <td   align="left" bordercolor="#E9E9E9"><?php echo $row_user['Dispatch_time'] ?></td>
    </tr>
    <a href="mod_cheque_dispatched.php?chno="></a>
    <?php
                        $row_count++;
					
              	 }
				}else{
					?>
    <tr>
      <td width="197" height="25" align="center"  colspan="12" style="color:#F00"  >No Transcation Found</td>
    </tr>
    <?php		
				}
				
           ?>
    
  </table>