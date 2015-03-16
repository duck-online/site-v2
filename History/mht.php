<?php
require '../vendor/autoload.php';
session_start();
use Avos\AVClient as AVClient;
use Avos\AVSessionStorage as AVSessionStorage;
use Avos\AVUser as AVUser;
use Avos\AVException as AVException;
use Avos\AVObject as AVObject;
use Avos\AVQuery as AVQuery;
//configs
//avos
$avos_class="test_history";
$app_id="0ncv0lpnyfovb8ofz4h4bky4jfuvrfskrujy05woh1e4s401";
$app_key="mhcqngbvu2s6zhhsmj9jrxh5rojwsahau145mims7cphn57p";
$master_key="b441hdjvhiijq1l6wpspit2la00vio459qkg95pia0me3ui6";

//mht
$mht_path="../dev/gunduck.mht";
$min_timestamp=strtotime("1111-11-11 11:11:11");
//configs end




//avos init
file_put_contents('php://stdout', "avos init\n");

AVClient::initialize( $app_id, $app_key, $master_key );
file_put_contents('php://stdout',"avos init success\n");
AVClient::setStorage(new AVSessionStorage());
file_put_contents('php://stdout', "avos success\n");

try{
	$avq=new AVQuery($avos_class);
	$lastobj=$avq->descending("time")->first();
	if (!is_object($lastobj))throw new Exception("");
	$date=($lastobj->get("time")->format("Y-m-d H:i:s"));
	$min_timestamp=strtotime($date);
	file_put_contents('php://stdout',"new min_timestamp is ".$date."\n");
}
catch (Exception $e)
{
	file_put_contents('php://stdout',"no new min_timestamp, set as 1111-11-11 11:11:11\n");
}



//avos end

$file=file_get_contents($mht_path);
//find html start
$content_start= strpos($file,"<html");
$content_end= strpos($file,"</html>");
$content=substr($file,$content_start,$content_end-$content_start);
$content=str_replace(
	"<tr><td><div style=color:#006EFE;padding-left:10px;><div style=float:left;margin-right:6px;>",
	"",$content);
$content=str_replace(
	"<div style=padding-left:20px;><font style=\"font-size:15pt;font-family:'宋体','MS Sans Serif',sans-serif;\" color='000000'>",
	"",$content);
$content=str_replace(
	"<div style=padding-left:20px;>",
	"",$content);

//echo $content;
$ans=array();
$content_dates=explode("<tr><td style=border-bottom-width:1px;border-bottom-color:#8EC3EB;border-bottom-style:solid;color:#3568BB;font-weight:bold;height:24px;line-height:24px;padding-left:10px;margin-bottom:5px;>日期: ",$content);
unset($content_dates[0]);
//echo $content_date[1];
foreach ($content_dates as $content_date)
{
	$count=0;
	$count0=0;
	$time_st=time();
	$content_lines=explode("</td></tr>",$content_date);
	foreach ($content_lines as $content_line)
	{	
		$content_info=explode("</div>",$content_line);
		if (isset($content_info[2]))
		{
			$timestamp=strtotime($content_lines[0]." ".$content_info[1]);
			$content_info[1]=$content_lines[0]." ".$content_info[1];
			$count++;
			
			if ($timestamp>$min_timestamp)
			{
				$count0++;
				//file_put_contents('php://stdout', "avos create\n");
				$object = AVObject::create($avos_class);
				$objectId = $object->getObjectId();
				$object->set("message",$content_info[2]);
				$object->set("time",new DateTime($content_info[1]));
				$object->set("user",$content_info[0]);
				//file_put_contents('php://stdout', "avos saving $objectId\n");
				try{
				$object->save();
				}catch (Exception $e){}
				//file_put_contents('php://stdout', "avos save line id $objectId\n");
				$persent=$count*100/(count($content_lines)-2);
				$msg="Saved message at $content_info[1],running ".
					sprintf("%d/%d %.2f%%",$count,(count($content_lines)-2),$persent).
					sprintf(" %.2f line/s",(time()==$time_st)?0:$count0/(time()-$time_st));
					//."\n";
				for ($i=0;$i<count($msg);$i++)
					file_put_contents('php://stdout',"\b");
				file_put_contents('php://stdout',$msg);
				//readline_redisplay();
				//readline_callback_handler_install($msg,null);
	//			array_push($messagestack,$content_info);
			}
		}
	}
}





