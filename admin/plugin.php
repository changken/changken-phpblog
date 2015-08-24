<?php
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
include("../include/plugin_function.php");
if($_SESSION['website']==$config['website'])
{
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--外掛管理--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--外掛管理</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <a href="article_list.php">文章管理</a>     <a href="comment_list.php">評論管理</a>     <a href="add.php">發表文章</a>     <a href="setting.php">設定</a>     <a href="update.php">帳號設定</a>     <a href="user_list.php">會員管理</a>     <a href="add_user.php">新增會員</a>     <span class="selected"><a href="plugin.php">外掛管理</a></span>     <a href="theme.php">佈景主題管理</a>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?>
<h2>目前您的網站使用的外掛函數庫資訊:</h2>
<table width="500" border="1" cellspacing="0" cellpadding="0">
<tr>
<td>外掛函數庫版本:<?php echo CPB_PLUGIN_FUNCTION_VERSION;?></td>
</tr>
<tr>
<td>外掛函數庫更新日期:<?php echo CPB_PLUGIN_FUNCTION_UPDATE_DATE;?></td>
</tr>
<tr>
<td>外掛函數庫版本辨識值:<?php echo CPB_PLUGIN_FUNCTION_VERSION_VALUE;?></td>
</tr>
</table>
<h2>目前您的網站安裝的外掛列表:</h2>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>外掛名稱</td>
	<td>外掛作者</td>
    <td>外掛版本</td>
    <td>外掛更新日期</td>
	<td>外掛狀態</td>
	<td>外掛位置</td>
	<td>前台網址</td>
	<td>後台網址</td>
	<td>編輯</td>
	<td>解除安裝</td>
  </tr>
<?php
$sql="SELECT * FROM plugin ORDER BY NO DESC";
$result=mysql_query($sql);
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
				echo "<tr>";
                        echo "<td>".$row['name']."</td>";
						echo "<td>".$row['writer_name']."</td>";
                        echo "<td>".$row['version']."</td>";
                        echo "<td>".$row['update_date']."</td>";
						echo "<td>".$row['mode']."</td>";
						echo "<td>".$row['p_where']."</td>";
				        echo "<td><a href='../plugin/";
						echo $row['folder_name']."'><b>前台網址</b></a></td>";
						echo "<td><a href='../plugin/";
						echo $row['folder_name']."/admin'><b>後台網址</b></a></td>";
						echo "<td><a href='plugin_edit.php?NO=";
						echo $row['NO']."'><b>編輯</b></a></td>";
						echo "<td><a href='../plugin/";
						echo $row['folder_name']."/uninstall.php'><b>解除安裝</b></a></td>";
                        echo "</tr>";
      }
  }
  else
  {
	  echo "您尚未安裝任何外掛！";
  }
?>
</table>
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