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
<title><?php echo $config['sitetitle'];?>--新增會員--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
<script>
function cpb_add_user_check()
{
	if(document.cpb_add_user_form.username.value=="")
	{
		alert("帳號不能為空！");
		return false;
	}
	else if(document.cpb_add_user_form.password.value=="")
	{
		alert("密碼不能為空！");
		return false;
	}
	else if(document.cpb_add_user_form.password2.value=="")
	{
		alert("密碼(再輸入一次)不能為空！");
		return false;
	}
	else if(document.cpb_add_user_form.password.value!=document.cpb_add_user_form.password2.value)
	{
		alert("密碼不一致！");
		return false;
	}
	else
	{
		return true;	
	}
}
</script>
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--新增會員</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <a href="article_list.php">文章管理</a>     <a href="comment_list.php">評論管理</a>     <a href="add.php">發表文章</a>     <a href="setting.php">設定</a>     <a href="update.php">帳號設定</a>     <a href="user_list.php">會員管理</a>     <span class="selected"><a href="add_user.php">新增會員</a></span>     <a href="plugin.php">外掛管理</a>     <a href="theme.php">佈景主題管理</a>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php 
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin")
{
?>
<p><font color="red">*為必填</font></p>
<form name="cpb_add_user_form" method="post" action="add_userc.php">
<table border="1">
<tbody>
<tr>
<th>新增會員</th>
</tr>
<tr>
<td>帳號<font color="red">*</font>：<input type="text" name="username"></td>
</tr>
<tr>
<td>email：<input type="text" name="email"></td>
</tr>
<tr>
<td>密碼<font color="red">*</font>：<input type="password" name="password"></td>
</tr>
<tr>
<td>密碼(再輸入一次)<font color="red">*</font>：<input type="password" name="password2"></td>
</tr>
<tr>
<td>
權限：<font color="red">*</font>
<select name="level">
<option value="admin">管理員</option>
<option value="editor">編輯者</option>
<option value="user">一般使用者</option>
</select>
</td>
</tr>
<tr>
<td><input type="submit" name="submit" value="新增" onclick="return cpb_add_user_check()"></td>
</tr>
</tbody>
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