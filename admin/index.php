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
<title><?php echo $config['sitetitle'];?>--管理中心--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--管理中心</h1>
<div class="nav">
<ul>
<li><span class="selected"><a href="index.php">管理中心</a></span>    <a href="logout.php">登出</a>     <a href="../index.php">回首頁</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor" or $_SESSION['level'] == "user"){?>
<h1>歡迎進入changken-phpblog管理中心！</h1>
<ul>
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor"){?>
<li><a href="article_list.php">文章管理</a></li>
<li><a href="comment_list.php">評論管理</a></li>
<li><a href="add.php">發表文章</a></li>
<?php }else{}?>
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?>
<li><a href="setting.php">設定</a></li>
<?php }else{}?>
<li><a href="update.php">帳號設定</a></li>
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?>
<li><a href="user_list.php">會員管理</a></li>
<li><a href="add_user.php">新增會員</a></li>
<li><a href="plugin.php">外掛管理</a></li>
<li><a href="theme.php">佈景主題管理</a></li>
<?php }else{}?>
</ul>
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