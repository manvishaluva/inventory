<?php
require "config.php"; // Your Database details 
$division_id=array();
$division=array();
$divisions_gp=array();
?>

<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Inventory</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
<SCRIPT language=JavaScript>

function reload(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
self.location='dd3.php?region=' + val ;
}

function reload3(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 

self.location='dd3.php?region=' + val + '&branch=' + val2 ;
}

function reload4(form)
{
var val=form.cat.options[form.cat.options.selectedIndex].value; 
var val2=form.subcat.options[form.subcat.options.selectedIndex].value; 
var val3=form.subcat3.options[form.subcat3.options.selectedIndex].value; 

self.location='dd3.php?region=' + val + '&branch=' + val2 + '&dgp=' + val3 ;
}


</script>
</head>

<body>
<?php
if($cat==""){
	//echo "1"; head office + all branch + all division
	
	$quer=mysql_query("SELECT DISTINCT branch_name,branch_id FROM tbl_branch_master order by branch_name");
	
	$quer2=mysql_query("SELECT DISTINCT region_name,region_id FROM tbl_region_master order by region_name"); 
	
	$quer3=mysql_query("SELECT DISTINCT division_name,division_id,branch_id,division_group_name FROM tbl_divisions order by division_name"); 
	
}
 
 
$cat=$_GET['region']; // This line is added to take care if your global variable is off

$cat3=$_GET['branch']; // This line is added to take care if your global variable is off

$dgp=$_GET['dgp'];


if(($cat=="") &&($cat3!="")){
	//echo "2"; head office + any one branch + all divisions of that branch
	
	$quer3=mysql_query("SELECT DISTINCT division_name,division_id,branch_id,division_group_name FROM tbl_divisions where branch_id =$cat3 order by division_name"); 
	
}else if($cat!=""){
	//echo "3"; single region + all branch of a region + all divisions of that perticular region
	
	$quer=mysql_query("SELECT DISTINCT branch_name,branch_id FROM tbl_branch_master WHERE region_id=$cat order by branch_name");

$quer3=mysql_query("SELECT DISTINCT division_name,division_id,branch_id,division_group_name FROM tbl_divisions where  region_id=$cat order by division_name"); 

}

if(($cat!="") && ($cat3!="")){
	//echo "4"; single region + single branch of a region + all divisions of that branch
	
$quer=mysql_query("SELECT DISTINCT branch_name,branch_id FROM tbl_branch_master WHERE region_id=$cat order by branch_name");

$quer3=mysql_query("SELECT DISTINCT division_name,division_id,branch_id,division_group_name FROM tbl_divisions where  region_id=$cat AND branch_id=$cat3 order by division_name");
	
}



?>

<form method="post" name='f1' action='mod_display_details.php'>

<?php
echo "<select name='cat' onchange=\"reload(this.form)\"><option value=''>Head Office</option>";
while($noticia2 = mysql_fetch_array($quer2)) { 
if($noticia2['region_id']==$cat){echo "<option selected value='".$noticia2['region_id']."'>".$noticia2['region_name']."</option>"."<BR>";}
else{echo  "<option value='".$noticia2['region_id']."'>".$noticia2['region_name']."</option>";}
}
echo "</select>";



echo "<select name='subcat' onchange=\"reload3(this.form)\"><option value=''>Select Branch</option>";
while($noticia = mysql_fetch_array($quer)) { 
if($noticia['branch_id']==$cat3){echo "<option selected value='".$noticia['branch_id']."'>".$noticia['branch_name']."</option>"."<BR>";}
else{echo  "<option value='".$noticia['branch_id']."'>".$noticia['branch_name']."</option>";}
}
echo "</select>";



echo "<select name='subcat3' onchange=\"reload4(this.form)\" ><option value=''>Select division Group</option>";
$i=0;
$j=0;
while($noticia = mysql_fetch_array($quer3)) { 

$flag_div_grup=0;

		for($m=0;$m<$j;$m++){
					if($noticia['division_group_name']==$divisions_gp[$m]){
						
						$ids=$division_id[$m];
						$ids=$ids.",".$noticia['division_id'];
						$division_id[$m]=$ids;
						
					$flag_div_grup=1;	
					}
				}
			if($flag_div_grup!=1){
				if($noticia['division_group_name']!=""){
			$divisions_gp[$j]=$noticia['division_group_name'];
			$division_id[$j]=$noticia['division_id'];
			$j++;
				}
			}
}
$dgp=$_GET['dgp'];
for($k=0;$k<$j;$k++){
	if($dgp==$division_id[$k]){
	echo "<option selected value='".$division_id[$k]."'>".$divisions_gp[$k]."</option>";	
	}else{
	echo  "<option value='".$division_id[$k]."'>".$divisions_gp[$k]."</option>";
	}
}

echo "</select>";

if(($cat!="") && ($cat3!="") && ($dgp!="")){
	// using to enable the region user  to take values of a particular division under a particular division group
	
	$query4=mysql_query("SELECT DISTINCT division_group_name FROM tbl_divisions where  region_id=$cat AND branch_id=$cat3 AND division_id='$dgp'");
	if($row=mysql_fetch_array($query4)){
		//taking division group usin $dgp value
		
		$division_gp_name=$row['division_group_name'];
	}
	
	$query5=mysql_query("SELECT DISTINCT division_name,division_id,branch_id,division_group_name FROM tbl_divisions where  region_id=$cat AND branch_id=$cat3 AND division_group_name='$division_gp_name' order by division_name");
	
echo "<select name='subcat4' ><option value=''>Select Divisions</option>";

while($row= mysql_fetch_array($query5)) { 

echo  "<option value='".$row['division_id']."'>".$row['division_name']."</option>";

}

echo "</select>";
	
}
$sql=mysql_query("SELECT DISTINCT(st_date)FROM tbl_ledger_details");
echo "<select name='stdate'>";
while($row=mysql_fetch_array($sql)){
echo  "<option value='".$row['st_date']."'>".$row['st_date']."</option>";	
}
echo"</select>";
$sql=mysql_query("SELECT DISTINCT(end_date)FROM tbl_ledger_details");
echo "<select name='enddate'>";
while($row=mysql_fetch_array($sql)){
echo  "<option value='".$row['end_date']."'>".$row['end_date']."</option>";	
}
echo"</select>";

echo "<input type=submit value='Submit the form data'/>";
for($k=0;$k<$j;$k++){
	echo $divisions_gp[$k]."<br>";
}
?>
</form>

</body>

</html>