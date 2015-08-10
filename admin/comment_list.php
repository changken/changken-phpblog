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
<title><?php echo $config['sitetitle'];?>--評論管理--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--評論管理</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <a href="article_list.php">文章管理</a>     <span class="selected"><a href="comment_list.php">評論管理</a></span>     <a href="add.php">發表文章</a>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?><a href="setting.php">設定</a><?php }else{}?>     <a href="update.php">帳號設定</a>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?><a href="user_list.php">會員管理</a>     <a href="add_user.php">新增會員</a>     <a href="plugin.php">外掛管理</a>     <a href="theme.php">佈景主題管理</a><?php }else{}?>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor"){?>
<?php
$sql="SELECT * FROM comment ORDER BY NO DESC;";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>NO</td> 
	<td>所屬文章</td>
	<td>暱稱</td>
    <td>email</td>
    <td>網站</td>
    <td>內容</td>
    <td>發表日期</td>
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
                        echo "<td>".$row['posts_id']."</td>";
                        echo "<td>".$row['nickname']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['website']."</td>";
                        echo "<td>".$row['content']."</td>";
                        echo "<td>".$row['time']."</td>";
				        echo "<td><a href='comment_edit.php?NO=";
						echo $row[0]."'><b>編輯</b>";
						echo "<td><a href='comment_delete.php?NO=";
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