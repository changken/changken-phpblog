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
<title><?php echo $config['sitetitle'];?>--佈景主題管理--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--佈景主題管理</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <a href="article_list.php">文章管理</a>     <a href="comment_list.php">評論管理</a>     <a href="add.php">發表文章</a>     <a href="setting.php">設定</a>     <a href="update.php">帳號設定</a>     <a href="user_list.php">會員管理</a>     <a href="add_user.php">新增會員</a>     <a href="plugin.php">外掛管理</a>     <span class="selected"><a href="theme.php">佈景主題管理</a></span>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?>
<a href="theme.php?a=add">新增佈景主題</a><br>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>佈景主題名稱</td>
	<td>佈景主題作者</td>
	<td>佈景主題檔案夾名稱</td>
	<td>編輯</td>
	<td>刪除</td>
  </tr>
<?php
$sql="SELECT * FROM theme ORDER BY NO DESC";
$result=mysql_query($sql);
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
				echo "<tr>";
                        echo "<td>".$row['theme_name']."</td>";
						echo "<td>".$row['writer_name']."</td>";
						echo "<td>../theme/".$row['folder_name']."/style.css</td>";
						echo "<td><a href='theme.php?a=edit&NO=";
						echo $row['NO']."'><b>編輯</b></a></td>";
						echo "<td><a href='theme.php?a=delete&NO=";
						echo $row['NO']."'><b>刪除</b></a></td>";
                        echo "</tr>";
      }
  }
  else
  {
	  echo "您尚未使用任何佈景主題！";
  }
?>
</table>
<?php
if($_GET['a']=="add")
{
?>
<h2>新增佈景主題:</h2>
<form name="form" method="post" action="theme.php?a=addc">
<table border="1">
<tr>
<td>佈景主題名稱：<input type="text" name="theme_name" /></td>
</tr>
<tr>
<td>佈景主題作者：<input type="text" name="writer_name" /></td>
</tr>
<tr>
<td>佈景主題檔案夾名稱：<input type="text" name="folder_name" /></td>
</tr>
<tr>
<td><input type="submit" name="button" value="新增" /></td>
</tr>
</table>
</form>
<?
}
else
{
}
if($_GET['a']=="addc")
{
		$theme_name = $_POST['theme_name'];
		$writer_name = $_POST['writer_name'];
		$folder_name = $_POST['folder_name'];
	
        //新增資料庫資料語法
        $sql = "INSERT INTO theme (theme_name, writer_name, folder_name) VALUES ('$theme_name', '$writer_name', '$folder_name');";
        if(mysql_query($sql))
        {
                echo '新增成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=theme.php>';
        }
        else
        {
                echo '新增失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=theme.php?a=add>';
        }
}
else
{
}
if($_GET['a']=="delete")
{
$NO = mysql_real_escape_string($_GET['NO']);
$sql = "DELETE FROM theme WHERE NO='$NO';";
if(mysql_query($sql))
{
                echo '刪除成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=theme.php>';
}
else
{
                echo '刪除失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=theme.php>';
}
}
else
{
}
if($_GET['a']=="edit")
{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = mysql_real_escape_string($_GET['NO']);
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM theme where NO='$NO'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
?>
<h2>編輯佈景主題:</h2>
<font color="red">請小心編輯佈景主題資訊！若亂改可能會導致替換佈景主題後發生錯誤！</font>
<form name="form" method="post" action="theme.php?a=editc">
<table border="1">
<tr>
<td>NO：<input type="text" name="NO" value="<?php echo $row[0];?>" readonly="readonly"/></td>
</tr>
<tr>
<td>佈景主題名稱：<input type="text" name="theme_name" value="<?php echo $row[1];?>" /></td>
</tr>
<tr>
<td>佈景主題作者：<input type="text" name="writer_name" value="<?php echo $row[2];?>" /></td>
</tr>
<tr>
<td>佈景主題檔案夾名稱：<input type="text" name="folder_name" value="<?php echo $row[3];?>" /></td>
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
}
if($_GET['a']=="editc")
{
		$NO = $_POST['NO'];
		$theme_name = $_POST['theme_name'];
		$writer_name = $_POST['writer_name'];
		$folder_name = $_POST['folder_name'];
	
        //更新資料庫資料語法
        $sql = "UPDATE theme SET theme_name='$theme_name', writer_name='$writer_name', folder_name='$folder_name' where NO='$NO'";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=theme.php>';
        }
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=theme.php?a=edit&NO='.$NO.'>';
        }
}
else
{
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