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
				
				$query="select s.*, sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id Group BY stk_id having totstock>0";
	
			}else if(($br=='')&&($sub_br=='')){
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where region_id='$reg' Group BY stk_id having totstock>0";
				
			}else if(($br!='')&&($sub_br=='')){
				
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where branch_id='$br' Group BY stk_id having totstock>0";
						
			}else{
				
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where sub_br_id='$sub_br' Group BY stk_id having totstock>0";
			}
			
		}elseif($usertype=='REGION USER'){	//REGION USER
		
			$reg=$_SESSION['region'];
			
			if(($br=='')&&($sub_br=='')){
									
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where region_id='$reg' Group BY stk_id having totstock>0";
				
			}elseif(($br!='')&&($sub_br=='')){
									
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where branch_id='$br' Group BY stk_id having totstock>0";
				
			}else{
				
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where sub_br_id='$sub_br' Group BY stk_id having totstock>0";
						
			}
						
		}elseif($usertype=='BRANCH USER'){	//BRANCH USER
		
			$br=$_SESSION['branch'];
			
			if(($br!='')&&($sub_br!='')){
									
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where sub_br_id='$sub_br' Group BY stk_id having totstock>0";
				
			}else{
				
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where branch_id='$br' Group BY stk_id having totstock>0";
						
			}
						
		}else{  //SUB BRANCH USER

				
				$query="select s.*,sum(c.closing_stk) as totstock from tbl_closing_stock c INNER JOIN tbl_stock_master S ON s.stk_id=c.stk_id 
				        where sub_br_id='$sub_br' Group BY stk_id having totstock>0";
						
		}
