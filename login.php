<?php
session_start();
include("cpb-db-conn.php");
include("cpb-setting.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--會員登入--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="theme/<?php echo $config['theme']?>/style.css">
<script>
function cpb_login_check()
{
	if(document.cpb_login_form.username.value=="")
	{
		alert("使用者名稱不能為空！");
		return false;
	}
	else if(document.cpb_login_form.password.value=="")
	{
		alert("密碼不能為空！");
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
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--會員登入</h1>
<div class="nav">
<ul>
<li><span class="selected"><a href="index.php">首頁</a></span></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<form name="cpb_login_form" method="post" action="loginc.php">
<table border="1">
<tr>
<th>會員登入</th>
</tr>
<tr>
<td>帳號：<input type="text" name="username" /></td>
</tr>
<tr>
<td>密碼：<input type="password" name="password" /></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="登入" onclick="return cpb_login_check()" /></td>
</tr>
</table>
</form>
</div>
<div class="footer">
<?php include("cpb-footer.php");?>
</div>
</body>

</html>