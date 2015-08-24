<?php
/****************************************
changken-phpblog外掛api函數
此檔案供開發人員使用，一般使用者請忽略此檔案。
版本:v1.2
更新日期:2015.1.16
****************************************/
define("CPB_PLUGIN_FUNCTION_VERSION","v1.2");//函數庫版本
define("CPB_PLUGIN_FUNCTION_UPDATE_DATE","2015-1-16");//函數庫更新日期
define("CPB_PLUGIN_FUNCTION_VERSION_VALUE","12");//函數庫版本辨識值
/**************************************/
function cpb_plugin_install($name,$writer_name,$version,$update_date,$folder_name,$mode,$where)
{
	global $sql;
	$sql[]="INSERT INTO `plugin` (`name`, `writer_name`, `version`, `update_date`, `folder_name`, `mode`, `p_where`) VALUES ('$name', '$writer_name', '$version', '$update_date', '$folder_name', '$mode', '$where');";
	foreach($sql as $val)
	{
		if(mysql_query($val)){
			echo"安裝成功！本安裝程序會自動改名為install.lock！<br>";
			rename("install.php","install.lock");
		}	
		else
		{
			echo"安裝失敗！<a href='install.php'>返回，上一頁</a><br>";
		}
	}
}
/**************************************/
function cpb_plugin_uninstall($plugin_name)
{
	global $sql;
	$sql[]="DELETE FROM plugin WHERE name='$plugin_name';";
	foreach($sql as $val)
	{
		if(mysql_query($val))
		{
			echo"解除安裝成功！本解除安裝程序會自動改名為uninstall.lock！<br>";
			rename("uninstall.php","uninstall.lock");
		}
		else
		{
			echo"解除安裝失敗！<a href='uninstall.php'>返回，上一頁</a><br>";
		}
	}
}
/**************************************/
function cpb_plugin_upgrade($name,$writer_name,$version,$update_date,$folder_name,$mode,$where) //v1.1版更新
{
	global $sql;
	$sql[]="UPDATE plugin SET  writer_name = '$writer_name', version = '$version', update_date = '$update_date', folder_name = '$folder_name', mode = '$mode', p_where='$where' WHERE name='$name';";
	foreach($sql as $val)
	{
		if(mysql_query($val)){
			echo"升級成功！本升級程序會自動改名為upgrade.lock！<br>";
			rename("upgrade.php","upgrade.lock");
		}	
		else
		{
			echo"升級失敗！<a href='upgrade.php'>返回，上一頁</a><br>";
		}
	}
}
/**************************************/
function cpb_plugin_if_install($plugin_name)
{
	$sql = "SELECT * FROM plugin where name='$plugin_name';";
	$result = mysql_query($sql);
	$row = mysql_fetch_row($result);
	return $row[6];
}
/**************************************/
function cpb_plugin_include_config_file($db_conn,$setting,$where)
{	
	global $config;
	if($where=="index")
	{
		if($db_conn=="true")
		{
			include("../../cpb-db-conn.php");
		}
		else
		{
		}
		if($setting=="true")
		{
			include("../../cpb-setting.php");
		}
		else
		{
		}
	}
	elseif($where=="admin")
	{
		if($db_conn=="true")
		{
			include("../../../cpb-db-conn.php");
		}
		else
		{
		}
		if($setting=="true")
		{
			include("../../../cpb-setting.php");
		}
		else
		{
		}
	}
	elseif($where=="folder")
	{
		if($db_conn=="true")
		{
			include("../../../cpb-db-conn.php");
		}
		else
		{
		}
		if($setting=="true")
		{
			include("../../../cpb-setting.php");
		}
		else
		{
		}
	}
	else
	{
	}
}
/**************************************/
function cpb_plugin_include_theme_file($theme,$where)
{
	global $config;
	if($where=="index")
	{
		if($theme=="true")
		{
			echo "<link rel='stylesheet' href='../../theme/".$config['theme']."/style.css'>";
		}
		else
		{
		}
	}
	elseif($where=="admin")
	{
		if($theme=="true")
		{
			echo "<link rel='stylesheet' href='../../../theme/".$config['theme']."/style.css'>";
		}
		else
		{
		}
	}
	elseif($where=="folder")
	{
		if($theme=="true")
		{
			echo "<link rel='stylesheet' href='../../../theme/".$config['theme']."/style.css'>";
		}
		else
		{
		}
	}
	else
	{
	}
}
/**************************************/
function cpb_plugin_include_footer_file($footer,$where)
{
	if($where=="index")
	{
		if($footer=="true")
		{
			include("../../cpb-footer.php");
		}
		else
		{
		}
	}
	elseif($where=="admin")
	{
		if($footer=="true")
		{
			include("../../../cpb-footer.php");
		}
		else
		{
		}
	}
	elseif($where=="folder")
	{
		if($footer=="true")
		{
			include("../../../cpb-footer.php");
		}
		else
		{
		}
	}
	else
	{
	}
}
?>