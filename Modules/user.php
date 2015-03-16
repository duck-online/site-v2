<?php
class usermanager
{
	static $usercache=null;
	static $usernow=null;
	static function init()
	{
		if (is_null(static::$usercache))
		{
			static::$usercache=json_decode(file_get_contents('data/user.json'),1);
			if (is_null(static::$usercache))
			{
				static::$usercache=array();
			}
		}
	}
	static function checkuser(){
		if (!(is_null(static::$usernow)))return true;
		if ((isset($_POST['act']))&&($_POST['act']=='logout'))
		{
			$_SESSION['uname']=null;
			$_SESSION['upass']=null;
		}
		$a=((isset($_POST['uname']))&&(isset($_POST['upass'])));
		$b=((isset($_SESSION['uname']))&&(isset($_SESSION['upass'])));
		if ((isset($_POST['act']))&&($_POST['act']=='reg')&&(isset($_POST['displayname']))&$a)
		{
			return static::adduser($_POST['uname'],$_POST['upass'],$_POST['displayname']);
		}
		if ($a||$b)
		{
			if ($a&&(!$b))
			{
				$_SESSION['uname']=$_POST['uname'];
				$_SESSION['upass']=$_POST['upass'];
				//echo 'pass='.$_SESSION['upass'];
				if ((isset($_POST['act']))&&($_POST['act']=='login'))
				{
					return static::checkpassword($_SESSION['uname'],$_SESSION['upass']);
				}

				return false;
			}	
			else
			{
				if (!($a))
				{
					return static::checkpassword($_SESSION['uname'],$_SESSION['upass']);
				}
				return static::checkpassword($_POST['uname'],$_POST['upass']);;
			}
		}
		else
		{
			return false;
		}
	}
	static function checkpassword($uname,$upass)
	{
		static::init();
		//echo 'try login uname='.$uname.' pass='.$upass;
		foreach(static::$usercache as $u)
		{
			//echo 'checking '.$u['uname'].'='.$uname.'|'.$u['upass'].'='.md5($upass);
			if (($u['uname']==$uname)&&($u['upass']==md5($upass)))
			{
				
				static::$usernow=$u;
				return true;
			}
		}
		return false;
	}
	static function adduser($uname,$upass,$displayname)
	{
		
		static::init();
		if ((!(isset($_SERVER["HTTP_X_FORWARDED_FOR"])))||($_SERVER["HTTP_X_FORWARDED_FOR"]==""))
		{
			$user_ip=$_SERVER["REMOTE_ADDR"];
		} 
		else
			$user_ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
		$test=static::getdisplayname($uname);
		if ($uname=="")return false;
		if ($upass=="")return false;
		if ($displayname=="")return false;

		if ($test=='UnKnown')
		{
			$u['uname']=$uname;
			$u['upass']=md5($upass);
			$u['displayname']=$displayname;
			$u['ip']=$user_ip;
			$u['time']=$_SERVER['REQUEST_TIME'];
			static::$usernow=$u;
			array_push(static::$usercache,$u);
			static::write();
			return true;
		}
		return false;
	}
	static function getdisplayname($uname)
	{
		static::init();
		foreach(static::$usercache as $u)
		{
			//echo 'checking '.$u['uname'].'='.$uname.'|'.$u['upass'].'='.md5($upass);
			if ($u['uname']==$uname)
			{
				return $u['displayname'];
			}
		}
		return "UnKnown";
	}
	static function checkdisplayname($uname)
	{
		static::init();
		foreach(static::$usercache as $u)
		{
			//echo 'checking '.$u['uname'].'='.$uname.'|'.$u['upass'].'='.md5($upass);
			if ($u['uname']==$uname)
			{
				return $u['displayname'];
			}
		}
		return false;
	}
	static function write()
	{
		file_put_contents('data/user.json',json_encode(static::$usercache));
	}
}


