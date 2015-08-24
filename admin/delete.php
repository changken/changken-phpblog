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
<title><?php echo $config['sitetitle'];?>--刪除文章--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--刪除文章</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>    <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php 
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor")
{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = mysql_real_escape_string($_GET['NO']);
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM article where NO='$NO'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or ($_SESSION['level'] == "editor" and $_SESSION['username'] == $row[3])){
?>
<form name="form" method="post" action="deletec.php">
要刪除的文章：<input type="text" name="NO" value="<?php echo $_GET['NO'];?>" readonly="readonly"><br>
<input type="hidden" name="type" value="<?php echo $row[5];?>"><br>
<input type="submit" name="button" value="刪除"/>
</form>
<?php
}
else
{
        echo '您無權限刪除此文章!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=article_list.php>';
}  
}
else
{
		echo '您無權限觀看此頁面!!';
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