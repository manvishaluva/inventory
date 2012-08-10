<table border="2">
<tr>
<td>1</td>
<td>2</td>

<td>3</td>

<td>4</td>
</tr>
<?php
//echo "value of j = ".$j."<br>";

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

</table>
code paste there