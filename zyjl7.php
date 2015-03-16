<?php include 'tools.php';?>

<?php
//settings
$left=array(
	"file"=>"laoguo-def",
	"duck_name"=>"完全潇洒的鸭子"
);
$right=array(
	"file"=>"laoguo-att",
	"duck_name"=>"星之扉"
);
//end




$rsum=array();

foreach(recload_timefirst($left["file"]) as $r)
{ $r['type']='fh';$r['time']=date('H:i:s',strtotime($r['time'])+0*3600);array_push($rsum,$r);}
foreach(recload_timefirst($right["file"]) as $r)
{ $r['type']='lzls';$r['time']=date('H:i:s',strtotime($r['time'])+0*3600);array_push($rsum,$r);}


function cmp($a, $b) {
	$ta=strtotime($a['time']);
	$tb=strtotime($b['time']);
    if(abs($ta-$tb)<2) {
        return 0;
    }
    return ($ta>$tb) ? (1) : (-1);
}
uasort($rsum,'cmp');


file_put_contents('record/laoguo.json',json_encode($rsum));

$rsum=json_decode(file_get_contents('record/laoguo.json'),1);
?>
<html lang="zh-cn">

<head>
    <link href="http://cdn.bootcss.com/bootstrap/3.1.1/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="http://cdn.bootcss.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<body style='padding-top: 70px;'>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<a  class="btn btn-default navbar-btn" href='index.php' ><span class='glyphicon glyphicon-arrow-left'></span></a>
	<p class="navbar-text">源程序2092-老郭暗杀战记录</p>
	</nav>
	<div class='container'>

        <div class='row'>

            <?php foreach($rsum as $r){?>
            <div class='row'>
                <div class="col-md-5 " style="text-align:right">
                    <strong style='color:<?php if ($r["name"]==$left["duck_name"]){echo 'blue';}  ?>'>
					<?php if ($r["type"]=='fh'){echo $r['name'];}  ?></strong>
                    <br>
                    <div style='color:<?php if ($r["name"]==$left["duck_name"]){echo 'blue';}  ?>'>
                    <?php if ($r[ "type"]=='fh' ){echo $r[ 'rec'];} ?>
					</div>


                </div>
                <div class="col-md-2 " style='text-align:<?php if ($r["type"]=='fh'){echo "left" ;}else{echo "right";}   ?>'>
                    <?php echo $r[ 'time'];?>
                </div>
                <div class="col-md-5">
                    <strong style='color:<?php if ($r["name"]==$right["duck_name"]){echo 'blue';}  ?>'>
					<?php if ($r["type"]=='lzls'){echo $r['name'];}  ?></strong>
                    <br>
                    <div style='color:<?php if ($r["name"]==$right["duck_name"]){echo 'blue';}  ?>'>
					<?php if ($r[ "type"]=='lzls' ){echo $r[ 'rec'];} ?>
					</div>

                </div>
            </div>
            <?php }?>
        </div>
    </div>
</body>

</html>