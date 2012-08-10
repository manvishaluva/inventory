<?php
session_start();
require_once('../connections/dbcon.php'); 

	//$br=$_SESSION['br'];
	$reg=$_SESSION['reg'];
	//$sub_br=$_SESSION['sub_br'];
	//$usertype=$_SESSION['usertype'];

		
$partno=array();
$brand_name=array();
$category=array();
$unit=array();
$supplair_name=array();
$rate_of_vat=array();
$description=array();
$mrp_rate=array();
$location=array();
$stk_id= array();
$region_id=array();
$i=0;
$flg=0;
$_SESSION['stk_id']=$_GET['sid'];
		
		 $sql="select c.*,s.* from tbl_stock_master s INNER JOIN tbl_closing_stock c ON s.stk_id=c.stk_id WHERE c.stk_id=".$_GET['sid']." and c.closing_stk>0";
		 
		 if($reg!=''){
		 	
			$sql=$sql." and c.region_id=$reg";
		 	
		 }

		$result_sql=mysql_query($sql);
		
		while($row_sql=mysql_fetch_assoc($result_sql)){
										 
			$flg=0;	
				for($j=0;$j<$i;$j++){
							if($region_id[$j]==$row_sql['region_id']){
								
								$closing_stock[$j]+=$row_sql['closing_stk'];
								$flg=1;
							}
				}
										 
										 
			if($flg==0){
				$region_id[$i]=$row_sql['region_id'];
				$partno[$i]=$row_sql['part_no'];
				$brand_name[$i]=$row_sql['brand_name'];
				$category[$i]=$row_sql['category'];
				$unit[$i]=$row_sql['unit'];
				//$supplair_name[$i]=$row_sql['supplair_name'];
				$rate_of_vat[$i]=$row_sql['rate_of_vat'];
				$description[$i]=$row_sql['description'];
				$mrp_rate[$i]=$row_sql['mrp_rate'];
				$location[$i]=$row_sql['location'];	
				$closing_stock[$i]=$row_sql['closing_stk'];
				$i++;
			}
			
		}
?>
<form>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr height="20px;"><td></td>
<tr height="20px;"><td width="100%" bgcolor="#FFFFFF" valign="middle" align="center"><?php  include('../includes/head_all.php'); ?></td></tr>
 <tr height="20px;"><td colspan="6"></td></tr>

<tr><td valign="top"  >
        <table border="0" align="center" cellpadding="3" width="88%">
          <tr>
            <td bgcolor="#d6d6d6" ><table border="0" align="center" cellpadding="5" cellspacing="1px" bgcolor="#FFFFFF" class="rFont10">
          <tr>
            <td colspan="14" bgcolor="#FF8306" class="head_text" height="25">Closing Stock</td>
          </tr>

          <tr bgcolor="#666666">
          <td height="25" align="center" width="197" class="style3_head">region</td>
            
            <td width="187" height="25" align="center"  class="style3_head" >Part No </td>
            <td width="197" height="25" align="center"  class="style3_head"  >Decsription</td>
            <td height="25" align="center" width="197" class="style3_head">Brand Name</td>
			<td   height="25" align="center"   width="103" nowrap="nowrap" class="style3_head">Category</td>
            
            <td height="25" align="center" width="133"class="style3_head">Unit</td>
            <td width="187" height="25" align="center"  class="style3_head" >Location</td>
            
            <td width="140" height="25" align="center"  class="style3_head" >Vat Rate</td>
            
			<td  class="style3_head" height="25" align="center"   width="103" nowrap="nowrap">MRP</td>
            <td width="140" height="25" align="center"  class="style3_head" >Closing Stock</td>
          </tr>
             <?php
			 if($i!=0){
				 
				 for($k=0;$k<$i;$k++){
					 
		 
            ?>
 	 	 	 	 	 	 	 	 	 	 	    
        	 <tr height="20"<?php if($row_count%2==0) echo 'bgcolor="#F7F7F7"';?> >
             <td   align="left" bordercolor="#E9E9E9" class="text1_cheq"> <a href="mod_br_wise_c_st.php?reg=<?php echo $region_id[$k] ?>">
			 <?php
		 
			 $sql="select region_name from tbl_region_master where region_id=".$region_id[$k];
			 $result=mysql_query( $sql);
			 
			 $row=mysql_fetch_assoc($result);
			 
			 ?>
			 <?php if($closing_stock[$k]>1){?>
			 
             <?php echo $row['region_name']; ?>
             
			 <?php }else{?>
			 <?php echo $row['region_name']; ?>
             <?php }?>
             </a>
             </td>
            
			<td   align="left" class="rFont9"><?php echo $partno[$k]; ?></td>
			<td   align="left" bordercolor="#E9E9E9"><?php echo $description[$k] ;?><!--<span class="hotspot" onmousedown="tooltip.show('<?php echo $row_user['branch_tranc_id']?>');" onmouseout="tooltip.hide();">D:Click here</span>--></td>
            <td   align="left" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $brand_name[$k]; ?></td>
            <td   align="center" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $category[$k]; ?></td>
            <td   bordercolor="#E9E9E9" align="center" class="text1_cheq"><?php echo $unit[$k]; ?></td>
                   
			<td   align="center" class="text1_cheq"><?php echo $location[$k]; ?></td>
            
			<td   bordercolor="#E9E9E9" align="right" class="text1_cheq"> <?php echo $rate_of_vat[$k]; ?> </td>
            <td   bordercolor="#E9E9E9" align="right" class="text1_cheq"><?php echo $mrp_rate[$k]; ?></td>
            <td   bordercolor="#E9E9E9" align="right" class="red_1"><?php echo $closing_stock[$k]; ?></td>
            
          
			</tr>
           <?php
                        $row_count++;
					
              	 }
				 
				}else{
			?>
            <tr><td width="197" height="25" align="center"  colspan="14" style="color:#F00"  >Nothing To Display</td></tr>
                    
		   <?php		
				}
				
           ?>
           
        </table></td></tr>
       
       <tr><td  colspan="14" height="40px;"  ></td></tr> 
        
        </table>
</td></tr>
<tr><td height="224"></td></tr>
</table>

</form>
<?php include('../includes/footer_front.php') ?>