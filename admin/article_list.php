<?php
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
if($_SESSION['website']==$config['website'])
{
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--文章管理--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--文章管理</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <span class="selected"><a href="article_list.php">文章管理</a></span>     <a href="comment_list.php">評論管理</a>     <a href="add.php">發表文章</a>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?><a href="setting.php">設定</a><?php }else{}?>     <a href="update.php">帳號設定</a>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?><a href="user_list.php">會員管理</a>     <a href="add_user.php">新增會員</a>     <a href="plugin.php">外掛管理</a>     <a href="theme.php">佈景主題管理</a><?php }else{}?>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<h1>文章列表</h1>
<?php 
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor")
{
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin")
{
$sql="SELECT * FROM article where type='posts' order by NO desc;";
}
elseif($_SESSION['level'] == "editor")
{
$sql="SELECT * FROM article where type='posts' and writer='$username' order by NO desc;";
}
else{}
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>NO</td> 
	<td>標題</td>
	<td>作者</td>
    <td>發表日期</td>
    <td>文章類型</td>
    <td>評論狀態</td>
	<td>編輯</td>
	<td>刪除</td>
	<td>文章網址</td>
  </tr>
 
  <?php
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
                        echo "<tr>";
						echo "<td>".$row['NO']."</td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['writer']."</td>";
                        echo "<td>".$row['time']."</td>";
                        echo "<td>".$row['type']."</td>";
                        echo "<td>".$row['comment_type']."</td>";						
				        echo "<td><a href='edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='delete.php?NO=";
						echo $row[0]."'><b>刪除</b>";
						echo "<td><a href='../posts.php?NO=";
						echo $row[0]."'><b>文章網址</b>";
                        echo "</tr>";
					    }
        }
 
  ?>
</table>
<h1>頁面列表</h1>
<?php
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin")
{
$sql="SELECT * FROM article where type='page' order by NO desc;";
}
elseif($_SESSION['level'] == "editor")
{
$sql="SELECT * FROM article where type='page' and writer='$username' order by NO desc;";
}
else{}
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>NO</td> 
	<td>標題</td>
	<td>作者</td>
    <td>發表日期</td>
    <td>文章類型</td>
    <td>評論狀態</td>
	<td>編輯</td>
	<td>刪除</td>
	<td>頁面網址</td>
  </tr>
 
  <?php
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
                        echo "<tr>";
						echo "<td>".$row['NO']."</td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['writer']."</td>";
                        echo "<td>".$row['time']."</td>";
                        echo "<td>".$row['type']."</td>";
                        echo "<td>".$row['comment_type']."</td>";
				        echo "<td><a href='edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='delete.php?NO=";
						echo $row[0]."'><b>刪除</b>";
						echo "<td><a href='../page.php?NO=";
						echo $row[0]."'><b>頁面網址</b>";
                        echo "</tr>";
					    }
        }
 
  ?>
</table>
<h1>草稿列表</h1>
<?php
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin")
{
$sql="SELECT * FROM article where type='draft' order by NO desc;";
}
elseif($_SESSION['level'] == "editor")
{
$sql="SELECT * FROM article where type='draft' and writer='$username' order by NO desc;";
}
else{}
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>NO</td> 
	<td>標題</td>
	<td>作者</td>
    <td>發表日期</td>
    <td>文章類型</td>
    <td>評論狀態</td>
	<td>編輯</td>
	<td>刪除</td>
  </tr>
 
  <?php
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
                        echo "<tr>";
						echo "<td>".$row['NO']."</td>";
                        echo "<td>".$row['title']."</td>";
                        echo "<td>".$row['writer']."</td>";
                        echo "<td>".$row['time']."</td>";
                        echo "<td>".$row['type']."</td>";
                        echo "<td>".$row['comment_type']."</td>";
				        echo "<td><a href='edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='delete.php?NO=";
						echo $row[0]."'><b>刪除</b>";
                        echo "</tr>";
					    }
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