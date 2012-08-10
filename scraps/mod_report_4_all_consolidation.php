<?php
//if needed pls include the data base details
//FOR taking report of particular branch + all division consolidation/ taking report from the head office /taking report of a region 
$i=0;

$k=0;

$j=0;

foreach($out_name as $value ){
	$flag=1;
	
	for($m=0;$m<$j;$m++){
		if($value==$out_name_br[$m]){
			if($out_division_br[$m]==$out_division[$k]){
			$out_price_br[$m]=$out_price_br[$m]+$out_price[$k];
			$flag=0;
			}
		}
	}
	
	if($flag!=0){
			
			$out_name_br[$j]=$value;
			$out_division_br[$j]=$out_division[$k];
			$out_price_br[$j]=$out_price[$k];
			$j=$j+1;
		
			}
			
				
			
$k=$k+1;
}
//echo "last value of j".$j."<br>";
?>
<table border="1" >
<tr>
<td>ledger group name</td>
<td>division name</td>
<td>total value/division</td>

</tr>

<?php
for($k=0;$k<$j;$k++){
?>
<tr>
<td><?php echo $out_name_br[$k];?></td>
<td><?php echo $out_division_br[$k];?></td>
<td><?php echo $out_price_br[$k];?></td>
</tr>
<?php
}
?>
</table>
<?php 

$result_divisions = array_unique($out_division_br);//make unique the integer values of the division
foreach($result_divisions as $value){
	
	$SQL="SELECT division_group_name FROM tbl_divisions  WHERE division_id=".$value;
	$RESULT=mysql_query($SQL);
		if($ROW=mysql_fetch_array($RESULT)){
			$divisn_name=$ROW['division_group_name'];
		}
	
	for($k=0;$k<$j;$k++){
		if($out_division_br[$k]==$value){
			$out_division_br[$k]=$divisn_name;
		}
	}
	
}

?>
<table border="1">
<?php
for($k=0;$k<$j;$k++){
?>
<tr>
<td><?php echo $out_name_br[$k];?></td>
<td><?php echo $out_division_br[$k];?></td>
<td><?php echo $out_price_br[$k];?></td>
</tr>
<?php
}
?>
</table>

<?php
$i=0;

$k=0;

$j=0;



foreach($out_division_br as $value){
	
		$flag=1;
	
	for($m=0;$m<$j;$m++){
		if($value==$out_division_br_unique[$m]){
			if($out_name_br_unique[$m]==$out_name_br[$k]){
			$out_price_br_unique[$m]=$out_price_br_unique[$m]+$out_price_br[$k];
			$flag=0;
			}
		}
	}
	
	if($flag!=0){
			//create new array here if needed
			$out_name_br_unique[$j]=$out_name_br[$k];
			$out_division_br_unique[$j]=$value;
			$out_price_br_unique[$j]=$out_price_br[$k];
			$j=$j+1;
		
			}
			
				
			
$k=$k+1;
	
}
$result_ledger_gp_names = array_unique($out_name_br_unique);
$result_divisions = array_unique($out_division_br_unique);//make unique the string values of the division
$q=0;
foreach($result_ledger_gp_names as $value ){
$result_ledger_gp_names_check[$q]=$value;
$q++;
}

?>
<table border="1" >
<tr>
<td>division names</td>
<?php
foreach($result_ledger_gp_names as $value ){
?>
<td><?php echo $value;?></td>

<?php } ?>
</tr>

<?php
$i=0;
//particular branch + all division consolidation final stage ok tested and varified
foreach($result_divisions as $value ){
	$q=0;
	echo "<tr><td>". $value ."</td>";
	for($k=0;$k<$j;$k++){
		
		if($out_division_br_unique[$k]==$value){
			if($out_name_br_unique[$k]==$result_ledger_gp_names_check[$q]){
				
				echo "<td align='center'>".$out_price_br_unique[$k]."</td>";
				$q=$q+1;
				
			}else{
				echo "<td>&nbsp;</td>";
				$q=$q+1;
				$k=$k-1;
			}
			
		}
	}
	echo "</tr>";
	
}

?>
