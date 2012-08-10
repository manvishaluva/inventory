<?php
include("../MIS/connections/dbcon.php");
$br=$_POST['subcat'];
$br4div=$_POST['subcat'];
$reg=$_POST['cat'];
$divi=$_POST['subcat3'];
$divi_id=$_POST['subcat4'];

if($divi_id!=""){
	
	$divi=$_POST['subcat4'];
	
}

$divisions=array();
$stdate=$_POST['stdate'];
$enddate=$_POST['enddate'];
if(date($stdate)>date($enddate)){
	
	echo "DATE SELECTION IS WRONG";
	die();
}
if($reg==""){
	include('condition_headoffice.php');
}else{
	
	if($br==""){//checking for all branches in a perti: region
	$br="";
	$sql="SELECT * FROM tbl_branch_master WHERE region_id=".$reg;
	$result=mysql_query($sql);
	while($row=mysql_fetch_assoc($result)){
	$br.="'".$row['branch_id']."'".",";
	}
	$br=substr($br,0,strlen($br)-1);
	
		$i=0;
		if($divi==""){//checking for all divisions for a perti: branch in a perti: region
		
				$divi="";
				$sql="SELECT * FROM tbl_divisions WHERE branch_id IN($br)";
				$result=mysql_query($sql);
				while($row=mysql_fetch_assoc($result)){
						$flag_exist=0;
						
						for($l=0;$l<$i;$l++){
							if($row['division_id']==$divisions[$l]){
							$flag_exist=1;	
							}
						}
					if($flag_exist!=1){
					$divisions[$i]=$row['division_id'];
					$i++;
					}
				}
				foreach ($divisions as $v){
					$divi.="'".$v."',";
				}
				$divi=substr($divi,0,strlen($divi)-1);
		}else{
			
			
				$sql="SELECT * FROM tbl_divisions WHERE branch_id IN($br) AND division_id IN($divi)";
				$result=mysql_query($sql);
				$divi="";
				while($row=mysql_fetch_assoc($result)){
						$flag_exist=0;
						
						for($l=0;$l<$i;$l++){
							if($row['division_id']==$divisions[$l]){
							$flag_exist=1;	
							}
						}
					if($flag_exist!=1){
					$divisions[$i]=$row['division_id'];
					$i++;
					}
				}
				foreach ($divisions as $v){
					$divi.="'".$v."',";
				}
				$divi=substr($divi,0,strlen($divi)-1);
			
		}
	
	}else{////checking for a perti: branches in a perti: region
	$sql="SELECT * FROM tbl_branch_master WHERE region_id='$reg' AND branch_id IN($br4div)";
	$result=mysql_query($sql);
	$br="";	
	while($row=mysql_fetch_assoc($result)){
	$br.="'".$row['branch_id']."'".",";
	}
	$br=substr($br,0,strlen($br)-1);
	
	$i=0;
		if($divi==""){//checking for all divisions for a perti: branch in a perti: region
		
				$divi="";
				$sql="SELECT * FROM tbl_divisions WHERE branch_id IN($br)";
				$result=mysql_query($sql);
				while($row=mysql_fetch_assoc($result)){
						$flag_exist=0;
						
						for($l=0;$l<$i;$l++){
							if($row['division_id']==$divisions[$l]){
							$flag_exist=1;	
							}
						}
					if($flag_exist!=1){
					$divisions[$i]=$row['division_id'];
					$i++;
					}
				}
				foreach ($divisions as $v){
					$divi.="'".$v."',";
				}
				$divi=substr($divi,0,strlen($divi)-1);
		}else{
			
			
				$sql="SELECT * FROM tbl_divisions WHERE branch_id IN($br) AND division_id IN($divi)";
				$result=mysql_query($sql);
				$divi="";
				while($row=mysql_fetch_assoc($result)){
						$flag_exist=0;
						
						for($l=0;$l<$i;$l++){
							if($row['division_id']==$divisions[$l]){
							$flag_exist=1;	
							}
						}
					if($flag_exist!=1){
					$divisions[$i]=$row['division_id'];
					$i++;
					}
				}
				foreach ($divisions as $v){
					$divi.="'".$v."',";
				}
				$divi=substr($divi,0,strlen($divi)-1);
			
		}
	
	
	
	}
	
}
//these things ok now need to start from this area
?>
<table border="1" >
<tr>
<td>ledger group name</td>
<td>price</td>
<td>st date</td>
<td>end date</td>
<td>reg id</td>
<td>branch id</td>
<td>division</td>
<td>ledger name</td>

</tr>
<?php
$i=0;
$j=0;
$k=0;
$same=0;
$global_count=0;
$name=array();
$st_date=array();
$out_name=array();
$out_price=array();
$out_stdate=array();
$out_enddate=array();
$out_region=array();
$out_branch=array();
$out_division=array();

$sql="SELECT DISTINCT (ledger_group_name) FROM tbl_ledger_details WHERE branch_id IN($br) AND region_id IN($reg)";
$result=mysql_query($sql);
while($row=mysql_fetch_array($result))
#ledger_name 	region_id 	branch_id 	ledger_amount 	Tax_Percentage 	Item_Active 	division_id 	st_date 	end_date
{
	if($row['ledger_group_name']!=""){
	$name[$i]=$row['ledger_group_name'];
	$i++;
	}
}
/*foreach($name as $value ){
	echo $value."<br>";
}
$q=1;*/
foreach($name as $value ){
	//flag is here before
	echo $q;
	echo $value."<br>";
	
	$sql1="SELECT * FROM tbl_ledger_details WHERE ledger_group_name='$value' AND branch_id IN($br) AND region_id IN($reg) AND division_id IN($divi) AND (st_date) BETWEEN ('$stdate') AND ('$enddate')";
	$result1=mysql_query($sql1);
	while($row1=mysql_fetch_assoc($result1)){
		$flag=1;
for($l=0;$l<$k;$l++){
				if($row1['ledger_group_name']==$out_name[$l]){
					if($row1['ledger_name']==$out_ledger_name[$l]){
						if($row1['st_date']==$out_stdate[$l]){
						
						$k=$k++;
						$out_branch[$k]=$row1['branch_id'];
						$out_division[$k]=$row1['division_id'];
						$out_ledger_name[$k]=$row1['ledger_name'];
						$out_name[$k]=$value;
						$out_price[$l] = $out_price[$l] + $row1['ledger_price'];
				$flag=0;	
						}
					}
				}
			}
			
			if($flag!=0){
			$out_name[$k]=$value;
			$out_region[$k]=$row1['region_id'];
			$out_branch[$k]=$row1['branch_id'];
			$out_division[$k]=$row1['division_id'];
			$out_price[$k]=$row1['ledger_price'];
			$out_stdate[$k]=$row1['st_date'];
			$out_enddate[$k]=$row1['end_date'];
			$out_ledger_name[$k]=$row1['ledger_name'];

			$k=$k+1;
			
			}
		
		
	}
}

for($m=0;$m<$k;$m++){
?>
<tr>

<td><?php echo $out_name[$m];?></td>
<td><?php echo $out_price[$m];?></td>
<td><?php echo $out_stdate[$m];?></td>
<td><?php echo $out_enddate[$m];?></td>
<td><?php echo $out_region[$m];?></td>
<td><?php echo $out_branch[$m];?></td>
<td><?php echo $out_division[$m];?></td>
<td><?php echo $out_ledger_name[$m];?></td>
</tr>
<?php

}
?>
</table>
<?php
//single branch single  division detailed report

//these codes r used to extract the month from a specific date

$my_t=getdate(mktime(0,0,0,05,20,2010));
echo $my_t[month];

print_r (explode("-","2010-20-01"));
//up to this 
?>


<?php
$j=0;
$flag=0;
$k=0;
echo "<br>";
foreach($out_name as $value){
	$flag=1;
	for($m=0;$m<$j;$m++){
		if($out_name_div[$m]==$value){
			if($out_ledger_name_div[$m]==$out_ledger_name[$k]){
				if($out_stdate_div[$m]!=$out_stdate[$k]){

					$out_price_div[$j]=$out_price[$k];
					$out_stdate_div[$j]=$out_stdate[$k];
					$flag=0;
					$j=$j+1;
				}
			}
		}
	}
	
	if($flag!=0){
		$out_name_div[$j]=$value;
		$out_ledger_name_div[$j]=$out_ledger_name[$k]; 
		$out_price_div[$j]=$out_price[$k];
		$out_stdate_div[$j]=$out_stdate[$k];
		$j=$j+1;
	}
	
	$k=$k+1;
}
echo "value of j = ".$j."<br>";
?>
<table border="2">
<tr>
<td>1</td>
<td>2</td>

<td>3</td>

<td>4</td>
</tr>
<?php
echo "value of j = ".$j."<br>";

for($k=0;$k<$j;$k++){
  
?>
<tr>
<td><?php echo $out_name_div[$k];?></td>
<td><?php echo $out_ledger_name_div[$k] ;?></td>
<td><?php echo $out_price_div[$k];?></td>
<td><?php echo $out_stdate_div[$k];?></td>
</tr>
<?php
}
?>
<?php
$months_names=array();
$months_names[0]="January";
$months_names[1]="Februvary";
$months_names[2]="March";
$months_names[3]="April";
$months_names[4]="May";
$months_names[5]="June";
$months_names[6]="July";
$months_names[7]="August";
$months_names[8]="September";
$months_names[9]="October";
$months_names[10]="November";
$months_names[11]="December";

?>
</table>
<table border="1">
<tr>
<td>Group</td>
<?php
foreach($months_names as $value){
?>
<td align="center"><?php echo $value; ?></td>
<?php
}
?>
<td>Cumulative</td>
</tr>
<?php
$end="";
for($k=0;$k<$j;$k++){
	if($out_name_div[$k]!=""){
		if(($end!="") && ($end!=$out_name_div[$k])){
			echo $start;
			if($start<12){
				for($i=$start;$i<12;$i++){
					echo "<td>&nbsp;</td>";
				}
			}
			echo "<td>total value</td></tr>";
		}
		echo "<tr><td colspan='14'>".$out_name_div[$k]."</td></tr>";
		echo"<tr><td>".$out_ledger_name_div[$k]."</td>";
		$da=explode("-",$out_stdate_div[$k]);
		$month=getdate(mktime(0,0,0,$da[1],$da[2],$da[0]));
		for($i=0;$i<12;$i++){
			if($months_names[$i]==$month[month]){
				echo "<td>".$out_price_div[$k]."</td>";
				$start=$i+1;
				break;
			}else{
				echo "<td>&nbsp;</td>";
			}
		}
		$end=$out_name_div[$k];
	}else{
		$da=explode("-",$out_stdate_div[$k]);
		$month=getdate(mktime(0,0,0,$da[1],$da[2],$da[0]));
		echo "value of start= ".$start."<br>";
		for($i=$start;$i<12;$i++){
			if($months_names[$i]==$month[month]){
				echo "value of i= ".$i."<br>";
				
				echo "<td>".$out_price_div[$k]."</td>";
				$start=$i+1;
				break;
				}else{
				echo "<td>&nbsp;</td>";
			}
		}
	}
}
if($start<12){
				for($i=$start;$i<12;$i++){
					echo "<td>&nbsp;</td>";
				}
			}
echo "<td>total value</td></tr>";
?>
</table>
