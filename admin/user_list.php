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
<title><?php echo $config['sitetitle'];?>--會員管理--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--會員管理</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <a href="article_list.php">文章管理</a>     <a href="comment_list.php">評論管理</a>     <a href="add.php">發表文章</a>     <a href="setting.php">設定</a>     <a href="update.php">帳號設定</a>     <span class="selected"><a href="user_list.php">會員管理</a></span>     <a href="add_user.php">新增會員</a>     <a href="plugin.php">外掛管理</a>     <a href="theme.php">佈景主題管理</a>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<h1>會員列表</h1>
<?php 
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin")
{
$sql="SELECT * FROM user ORDER BY NO DESC";
$result=mysql_query($sql);
?>
<table width="500" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>NO</td> 
	<td>帳號</td>
	<td>email</td>
    <td>權限</td>
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
                        echo "<td>".$row['username']."</td>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['level']."</td>";
						if($row['level']=="superadmin")
						{
				        echo "<td><font color='red'><b>不能編輯</b></font></td>";
						echo "<td><font color='red'><b>不能刪除</b></font></td>";
						}
						else
						{
						echo "<td><a href='user_edit.php?NO=";
						echo $row[0]."'><b>編輯</b></a></td>";
						echo "<td><a href='user_delete.php?NO=";
						echo $row[0]."'><b>刪除</b></a></td>";
						}
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