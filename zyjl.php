<?php include 'tools.php';?>
<html lang="zh-cn">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="http://cdn.bootcss.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="http://cdn.bootcss.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<a  class="btn btn-default navbar-btn" href='index.php' ><span class='glyphicon glyphicon-arrow-left'></span></a>
	<p class="navbar-text">源程序2092-潜艇战记录</p>
	</nav>
	<div class='container'>
	<div class='row'>
	<div class='col-md-12'>
	<ul class="nav nav-tabs">
  <li><a href="#dg" data-toggle="tab">帝国侧记录</a></li>
  <li><a href="#dq" data-toggle="tab">地球圈侧记录</a></li>

	</ul>
	<div class="tab-content">
  <div class="tab-pane fade " id="dg">


<?php 
foreach(recload('qtc-dg') as $r)
{
	?>
	<div>
<strong><?php echo $r['name'];?></strong> <?php echo $r['time'];?><br>
<div><?php echo $r['rec'];?></div>
</div>
<?php
}
?>













</div>
  <div class="tab-pane fade in  active" id="dq"><?php 
foreach(recload('qtc-dqq') as $r)
{
	?>
	<div>
<strong><?php echo $r['name'];?></strong> <?php echo $r['time'];?><br>
<div><?php echo $r['rec'];?></div>
</div>
<?php
}
?></div>
	</div></div>
	</div>
</div>

	
	
	
	</body>
</html>