<?php
	
	$reg="";
	$sql="SELECT * FROM tbl_region_master";
	$result=mysql_query($sql);
	while($row=mysql_fetch_assoc($result)){
	$reg.="'".$row['region_id']."'".",";
	}
	$reg=substr($reg,0,strlen($reg)-1);
	
	if($br==""){
	$br="";
	$sql="SELECT * FROM tbl_branch_master";
	$result=mysql_query($sql);
	while($row=mysql_fetch_assoc($result)){
	$br.="'".$row['branch_id']."'".",";
	}
	$br=substr($br,0,strlen($br)-1);
	}
	
	$i=0;
	if($divi==""){
		$divi="";
		$sql="SELECT * FROM tbl_divisions";
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
		//calling for A PARTICULAR  DIVISION FORM THE HEAD OFFICE
		$sql="SELECT * FROM tbl_divisions WHERE division_id IN($divi)";
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
?>