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
	$NO = $_POST['NO'];
	$name = $_POST['name'];
	$writer_name = $_POST['writer_name'];
	$version = $_POST['version'];
	$update_date = $_POST['update_date'];
	$folder_name = $_POST['folder_name'];
	$mode = $_POST['mode'];
	$where = $_POST['where'];
	
        //更新資料庫資料語法
        $sql = "UPDATE plugin SET name='$name', writer_name='$writer_name', version='$version', update_date='$update_date', folder_name='$folder_name', mode='$mode', p_where = '$where' where NO='$NO'";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=plugin.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=plugin_edit.php?NO='.$NO.'>';
        }
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