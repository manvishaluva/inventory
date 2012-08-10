<?php
session_start();
require_once('../connections/dbcon.php'); 
include('../functions/ps_pagination.php');
if(isset($_POST['cat'])){

	$_SESSION['br']=$_POST['subcat'];
	$_SESSION['reg']=$_POST['cat'];
	$_SESSION['sub_br']=$_POST['subcat3'];
	$_SESSION['usertype']=$_GET['usertype'];
}
	$br=$_SESSION['br'];
	$reg=$_SESSION['reg'];
	$sub_br=$_SESSION['sub_br'];
	$usertype=$_SESSION['usertype'];
	
//			$_SESSION['branch']=$type_detail['branch_id'];
//			$_SESSION['region']=$type_detail['region_id'];
//			$_SESSION['sub_branch']=$type_detail['sub_branch_id'];
	
		
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
$i=0;
$flg=0;

        if($usertype=='TOP USER'){ // 	 	c.sub_br_id,c.region_id,
        	
			if($reg==''){	//'TOP USER'
				
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id, sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id Group BY stk_id having totstock=0";
	
			}else if(($br=='')&&($sub_br=='')){
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where region_id='$reg' Group BY stk_id having totstock=0";
				
			}else if(($br!='')&&($sub_br=='')){
				
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where branch_id='$br' Group BY stk_id having totstock=0";
						
			}else{
				
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where sub_br_id='$sub_br' Group BY stk_id having totstock=0";
			}
			
		}elseif($usertype=='REGION USER'){	//REGION USER
		
			$reg=$_SESSION['region'];
			
			if(($br=='')&&($sub_br=='')){
									
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where region_id='$reg' Group BY stk_id having totstock=0";
				
			}elseif(($br!='')&&($sub_br=='')){
									
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where branch_id='$br' Group BY stk_id having totstock=0";
				
			}else{
				
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where sub_br_id='$sub_br' Group BY stk_id having totstock=0";
						
			}
						
		}elseif($usertype=='BRANCH USER'){	//BRANCH USER
		
			$br=$_SESSION['branch'];
			
			if(($br!='')&&($sub_br!='')){
									
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where sub_br_id='$sub_br' Group BY stk_id having totstock=0";
				
			}else{
				
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where branch_id='$br' Group BY stk_id having totstock=0";
						
			}
						
		}else{  //SUB BRANCH USER

				
				$query="select s.*,c.branch_id,c.sub_br_id,c.region_id,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where sub_br_id='$sub_br' Group BY stk_id having totstock=0";
						
		}
		
		
	$result=mysql_query($query);
	$count=mysql_num_rows($result);	
	$pager = new PS_Pagination($conn, $query, 100, 10, "");
	$pager->setDebug(true);
	$result = $pager->paginate();
	
	
		
				
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
            
            <td width="187" height="25" align="center"  class="style3_head" >Part No </td>
            <td width="197" height="25" align="center"  class="style3_head"  >Decsription</td>
			
            <td height="25" align="center" width="197" class="style3_head">Brand Name</td>
            <td   height="25" align="center"   width="103" nowrap="nowrap" class="style3_head">Category</td>
            
            <td height="25" align="center" width="133"class="style3_head">Unit</td>
            <td width="187" height="25" align="center"  class="style3_head" >Location</td>
            
            <td width="140" height="25" align="center"  class="style3_head" >Vat Rate</td>
            
			<td  class="style3_head" height="25" align="center"   width="103" nowrap="nowrap">MRP</td>
          
          </tr>
             <?php
             if($count>0){
			 	while($row=mysql_fetch_assoc($result)){
				
            ?>
            
 	 	 	 	 	 	 	 	 	 	 	    
        	 <tr height="20"<?php if($row_count%2==0) echo 'bgcolor="#F7F7F7"';?> >
            
          
			<td   align="left" class="rFont9"><?php echo $row['part_no']; ?></td>
			<td   align="left" bordercolor="#E9E9E9"><?php echo $row['description'] ;?><!--<span class="hotspot" onmousedown="tooltip.show('<?php echo $row_user['branch_tranc_id']?>');" onmouseout="tooltip.hide();">D:Click here</span>--></td>
            
            
            
            <td   align="left" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $row['brand_name']; ?></td>
            <td   align="center" bordercolor="#E9E9E9" class="text1_cheq"><?php echo $row['category']; ?></td>
            <td   bordercolor="#E9E9E9" align="center" class="text1_cheq"><?php echo $row['unit']; ?></td>
                   
			<td   align="center" class="text1_cheq"><?php echo $row['location']; ?></td>
            
			<td   bordercolor="#E9E9E9" align="right" class="text1_cheq"> <?php echo $row['rate_of_vat']; ?> </td>
            <td   bordercolor="#E9E9E9" align="right" class="text1_cheq"><?php echo $row['mrp_rate']; ?></td>
                  
          
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
           <tr>
			<td colspan="6"  nowrap="nowrap"><?php echo $pager->renderFullNav(); ?>															            </td>
			</tr>
        </table></td></tr>
       
       <tr><td  colspan="14" height="40px;"  ></td></tr> 
        
        </table>
</td></tr>
<tr><td height="50"></td></tr>
</table>

</form>
<?php include('../includes/footer_front.php') ?>