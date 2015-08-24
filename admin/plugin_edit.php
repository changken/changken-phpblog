<?php
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
if($_SESSION['website']==$config['website'])
{
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--外掛管理--編輯外掛--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--外掛管理--編輯外掛</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin")
{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = mysql_real_escape_string($_GET['NO']);
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM plugin where NO='$NO'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
?>
<form name="form" method="post" action="plugin_editc.php">
<table border="1">
<tr>
<td>NO：<input type="text" name="NO" value="<?php echo $row[0];?>" readonly="readonly"/></td>
</tr>
<tr>
<td>外掛名稱：<input type="text" name="name" value="<?php echo $row[1];?>" /></td>
</tr>
<tr>
<td>外掛作者：<input type="text" name="writer_name" value="<?php echo $row[2];?>" /></td>
</tr>
<tr>
<td>外掛版本：<input type="text" name="version" value="<?php echo $row[3];?>" /></td>
</tr>
<tr>
<td>外掛更新日期：<input type="text" name="update_date" value="<?php echo $row[4];?>" /></td>
</tr>
<tr>
<td>外掛檔案夾名稱：<input type="text" name="folder_name" value="<?php echo $row[5];?>" /></td>
</tr>
<tr>
<td>外掛狀態：
<?php if($row[6]=="true"){?>
<select name="mode">
	<option value="true" selected="true">開啟(目前設定)</option>
	<option value="false">關閉</option>
</select>
<?php }elseif($row[6]=="false"){?>
<select name="mode">
	<option value="true">開啟</option>
	<option value="false" selected="true">關閉(目前設定)</option>
</select>
<?php }else{}?>
</td>
</tr>
<tr>
<td>外掛位置：
<?php if($row[7]=="contentheader"){?>
<select name="where">
	<option value="contentheader" selected="true">內容上方(目前設定)</option>
	<option value="postspagefooter">文章/頁面下方(僅適用於文章以及頁面)</option>
	<option value="contentfooter">內容下方</option>
	<option value="footer">頁尾下方</option>
	<option value="null">獨立外掛(不內嵌)</option>
</select>
<?php }elseif($row[7]=="postspagefooter"){?>
<select name="where">
	<option value="contentheader">內容上方</option>
	<option value="postspagefooter" selected="true">文章/頁面下方(僅適用於文章以及頁面)(目前設定)</option>
	<option value="contentfooter">內容下方</option>
	<option value="footer">頁尾下方</option>
	<option value="null">獨立外掛(不內嵌)</option>
</select>
<?php }elseif($row[7]=="contentfooter"){?>
<select name="where">
	<option value="contentheader">內容上方</option>
	<option value="postspagefooter">文章/頁面下方(僅適用於文章以及頁面)</option>
	<option value="contentfooter" selected="true">內容下方(目前設定)</option>
	<option value="footer">頁尾下方</option>
	<option value="null">獨立外掛(不內嵌)</option>
</select>
<?php }elseif($row[7]=="footer"){?>
<select name="where">
	<option value="contentheader">內容上方</option>
	<option value="postspagefooter">文章/頁面下方(僅適用於文章以及頁面)</option>
	<option value="contentfooter">內容下方</option>
	<option value="footer" selected="true">頁尾下方(目前設定)</option>
	<option value="null">獨立外掛(不內嵌)</option>
</select>
<?php }elseif($row[7]=="null"){?>
<select name="where">
	<option value="contentheader">內容上方</option>
	<option value="postspagefooter">文章/頁面下方(僅適用於文章以及頁面)</option>
	<option value="contentfooter">內容下方</option>
	<option value="footer">頁尾下方</option>
	<option value="null"  selected="true">獨立外掛(不內嵌)(目前設定)</option>
</select>
<?php }else{}?>
</td>
</tr>
<tr>
<td><input type="submit" name="button" value="確定" /></td>
</tr>
</table>
</form>
<?php
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>
</div>
<div class="footer">
<?php include("../cpb-footer.php");?>
</div>
</body>

</html>
<?php
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>