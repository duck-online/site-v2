<?php
if((isset($_GET['people']))&&(isset($_GET['fz'])))
{
	$_GET['people']=$_GET['people'];
	$fz=json_decode(file_get_contents('fz.json'),1);
	$fz1=array();
	foreach ($fz as $sl){
		$tmp=array();
		foreach ($sl['people'] as $people){
			
			if ($people!=$_GET['people'])array_push($tmp,$people);
			
			
		}
		$sl['people']=$tmp;
		array_push($fz1,$sl);
	}
	$fz=$fz1;
	$fz1=array();
	foreach ($fz as $sl){
		if (strcmp($sl['id'],$_GET['fz'])==0)
		{
			if(!(is_array($sl['people'])))$sl['people']=array($_GET['people']);
			else array_push($sl['people'],$_GET['people']);
			

		}
		array_push($fz1,$sl);


	}
	file_put_contents('fz.json',json_encode($fz1));
}

header("Location: /czlb.php"); 
//确保重定向后，后续代码不会被执行 
exit;