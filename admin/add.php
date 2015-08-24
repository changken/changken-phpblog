<?php
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
if($_SESSION['website']==$config['website'])
{
$adminname = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--發表文章--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
<script src="../ckeditor-full/ckeditor.js" type="text/javascript"><!--mce:2--></script>
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--發表文章</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <a href="article_list.php">文章管理</a>     <a href="comment_list.php">評論管理</a>     <span class="selected"><a href="add.php">發表文章</a></span>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?><a href="setting.php">設定</a><?php }else{}?>     <a href="update.php">帳號設定</a>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?><a href="user_list.php">會員管理</a>     <a href="add_user.php">新增會員</a>     <a href="plugin.php">外掛管理</a>     <a href="theme.php">佈景主題管理</a><?php }else{}?>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor"){?>
<form name="form" method="post" action="addc.php">
<table>
<tbody>
<tr>
<td>標題：<input type="text" name="title"></td>
</tr>
<tr>
<td>內容：<textarea name="content" cols="100" rows="50" id="full"></textarea></td>
</tr>
<tr>
<td>作者：<input type="text" name="writer" value="<?php echo $adminname;?>" readonly="readonly"></td>
</tr>
<tr>
<td>
文章類型：
<select name="type">
<option value="posts">文章</option>
<option value="page">頁面</option>
<option value="draft">草稿</option>
</select>
</td>
</tr>
<tr>
<td>
評論狀態：
<select name="comment_type">
<option value="true">開啟</option>
<option value="false">關閉</option>
</select>
</td>
</tr>
<tr>
<td><input type="submit" name="button" value="發表"></td>
</tr>
</tbody>
</table>
</form>
<script>
CKEDITOR.replace('full'); 
</script>
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