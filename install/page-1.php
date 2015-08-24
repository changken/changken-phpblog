<?php
session_start();
include '../cpb-db-conn.php';
include("../cpb-setting.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpblog--安裝嚮導--第二步</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1>changken-phpblog--安裝嚮導--第二步</h1>
<div class="nav">
<ul>
<li><a href="index.php">第一步</a>     <span class="selected"><a href="page-1.php">第二步</a></span>     <a href="page-2.php">第三步</a>     <a href="page-3.php">第四步</a>     <a href="page-4.php">第五步</a></li>
</ul>
</div>
</div>
<div class="aside">
歡迎使用changken-phpblog安裝嚮導！<br>
只要幾分鐘即可快速安裝完畢！<br>
</div>
<div class="content">
第二步:安裝<br>
<?php
$sql_1="CREATE TABLE IF NOT EXISTS `article` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `title` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `writer` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `type` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `comment_type` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$sql_2="CREATE TABLE IF NOT EXISTS `comment` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `posts_id` int(6) NOT NULL,
  `nickname` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `website` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$sql_3="CREATE TABLE IF NOT EXISTS `user` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` char(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$sql_4="CREATE TABLE IF NOT EXISTS `plugin` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `name` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `writer_name` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `version` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `update_date` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `folder_name` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `mode` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `p_where` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$sql_5="CREATE TABLE IF NOT EXISTS `theme` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `theme_name` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `writer_name` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `folder_name` char(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$sql_6="INSERT INTO theme (NO, theme_name, writer_name, folder_name) VALUES (1, 'classic', 'changken', 'classic');";
$sql_7="INSERT INTO theme (NO, theme_name, writer_name, folder_name) VALUES (2, 'blue', 'changken', 'blue');";
if(mysql_query($sql_1))
{
	echo"article資料表匯入成功！<br>";
}
else
{
	echo"article資料表匯入失敗！<br>";
}
if(mysql_query($sql_2))
{
	echo"comment資料表匯入成功！<br>";
}
else
{
	echo"comment資料表匯入失敗！<br>";
}
if(mysql_query($sql_3))
{
	echo"user資料表匯入成功！<br>";
}
else
{
	echo"user資料表匯入失敗！<br>";
}
if(mysql_query($sql_4))
{
	echo"plugin資料表匯入成功！<br>";
}
else
{
	echo"plugin資料表匯入失敗！<br>";
}
if(mysql_query($sql_5))
{
	echo"theme資料表匯入成功！<br>";
}
else
{
	echo"theme資料表匯入失敗！<br>";
}
if(mysql_query($sql_6))
{
	echo"classic佈景主題匯入成功！<br>";
}
else
{
	echo"classic佈景主題匯入失敗！<br>";
}
if(mysql_query($sql_7))
{
	echo"blue佈景主題匯入成功！<br>";
}
else
{
	echo"blue佈景主題匯入失敗！<br>";
}
?>
<input value="下一步" onclick="javascript:location.href='page-2.php';" type="button">
</div>
<div class="footer">
<?php include("../cpb-footer.php");?>
</div>
</body>

</html>