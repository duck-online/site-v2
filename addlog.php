<?php
date_default_timezone_set("Asia/Harbin");

if (isset($_POST['log']))
{
	file_put_contents('record/online.txt',"<br>".date('Y-m-d H:i:s')."<br>".$_POST['log'],FILE_APPEND);
}
echo file_get_contents('record/online.txt');























