<?php
/**
Plugin Name:cpb-info
Author:changken
Version:v1.1
Update Date:2015-2-2
 */
session_start();
include("../../../include/plugin_function.php");
cpb_plugin_include_config_file("true","true","admin");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--cpb版本資訊--後台管理--Powered by changken-phpblog</title>
<meta charset="utf8">
<?php cpb_plugin_include_theme_file("true","admin");?>
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--cpb版本資訊--後台管理</h1>
<div class="nav">
<ul>
<li><a href="../../../index.php">回網站首頁</a>     <a href="../index.php">回外掛首頁</a>     <span class="selected"><a href="index.php">後台管理</a></span></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php
if(cpb_plugin_if_install("cpb-info")=="true")
{
	if($_SESSION['website']==$config['website'])
	{
		if($_SESSION['level']=="superadmin" or $_SESSION['level']=="admin")
		{
		include("../../../cpb-version.php");
?>
<table border="1">
<tr>
<td>軟體名稱:changken-phpblog(簡稱cpb)</td>
</tr>
<tr>
<td>軟體作者:changken</td>
</tr>
<tr>
<td>軟體官網:<a href="http://cpb.changken.org">http://cpb.changken.org</a></td>
</tr>
<tr>
<td>作者個人部落格:<a href="http://changken.biz">changken隨意寫</a></td>
</tr>
<tr>
<td>作者個人網站:<a href="http://changken.org">哈囉！我是changken！</a></td>
</tr>
<tr>
<td>作者個人電子郵件地址:<a href="mailto:admin@changken.biz">admin@changken.biz</a></td>
</tr>
<tr>
<td>您目前使用的版本:<?php echo $_CPB['version'];?></td>
</tr>
</table>
<?php
		}
		else
		{
			echo "您無權限觀看此頁面！";
			echo "<meta http-equiv='refresh' content='1;url=../index.php'>";
		}
	}
	else
	{
		echo "您無權限觀看此頁面！";
		echo "<meta http-equiv='refresh' content='1;url=../index.php'>";
	}
}
elseif(cpb_plugin_if_install("cpb-info")=="false")
{
echo "很抱歉！網站管理員已將本外掛關閉！";
}
else
{
echo "很抱歉！本外掛尚未安裝！";
}
?>
</div>
<div class="footer">
<?php cpb_plugin_include_footer_file("true","admin");?>
</div>
</body>

</html>
