


<?php
date_default_timezone_set("Asia/Harbin");
if (isset($_GET['qid']))
{
$a=file_get_contents('list.txt');
$a=$a."\n".$_GET['qid'].'在'.date("Y/m/d H-i-s").'摇出的的摇号点数是'.rand(1,100);
@file_put_contents('list.txt',$a);




}
?>



<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<body>
		<div>
		<form action='yh.php' method='get'>
		群id：<input type='text' name='qid' width='300px'><input type='submit'>
		</form> 
		</div>
		<div>
		<h2>roll列表</h2>
		<pre>
		<?php 
		
		$a=file_get_contents('list.txt');
		echo $a;

		?>
		</pre>
		</div>
	</body>
</html>