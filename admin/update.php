<?php 
session_start();
include('../cpb-db-conn.php'); 
include("../cpb-setting.php");
include("../include/function.php");
if($_SESSION['website']==$config['website'])
{
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--帳號設定--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
<script>
function cpb_update_check()
{
	if(document.cpb_update_form.password.value=="" && document.cpb_update_form.password2.value!="")
	{
		alert("密碼不能為空！");
		return false;
	}
	else if(document.cpb_update_form.password.value!="" && document.cpb_update_form.password2.value=="")
	{
		alert("密碼(再輸入一次)不能為空！");
		return false;
	}
	else if(document.cpb_update_form.password.value != document.cpb_update_form.password2.value)
	{
		alert("密碼不一致！");
		return false;
	}
	else if(document.cpb_update_form.password.value=="" && document.cpb_update_form.password2.value=="")
	{
		return true;
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
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--帳號設定</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor"){?><a href="article_list.php">文章管理</a>     <a href="comment_list.php">評論管理</a>     <a href="add.php">發表文章</a><?php }else{}?>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?><a href="setting.php">設定</a><?php }else{}?>     <span class="selected"><a href="update.php">帳號設定</a></span>     <?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?><a href="user_list.php">會員管理</a>     <a href="add_user.php">新增會員</a>     <a href="plugin.php">外掛管理</a>     <a href="theme.php">佈景主題管理</a><?php }else{}?>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php 
$username = $_SESSION['username'];
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor" or $_SESSION['level'] == "user")
{
cpb_get_user_info_2($username);
?>
<p><font color="red">若密碼不要修改，兩個欄位請留空！</font></p>
<form name="cpb_update_form" method="post" action="updatec.php">
<table border="1">
<tbody>
<tr>
<th>帳號設定</th>
</tr>
<tr>
<td>NO:<input type="text" name="NO" value="<?php echo $user_no_2;?>" readonly="readonly"></td>
</tr>
<tr>
<td>帳號：<input type="text" name="username" value="<?php echo $user_name_2;?>" readonly="readonly"></td>
</tr>
<tr>
<td>email<font color="red">(選填)</font>：<input type="text" name="email" value="<?php echo $user_email_2;?>"></td>
</tr>
<tr>
<td>密碼<font color="red">(選填)</font>：<input type="password" name="password"></td>
</tr>
<tr>
<td>密碼(再輸入一次)<font color="red">(選填)</font>：<input type="password" name="password2"></td>
</tr>
<tr>
<td>權限：
<?php if($user_level_2=="superadmin"){?>
<input type="text" name="echo" value="超級管理員" readonly="readonly">
<input type="hidden" name="level" value="<?php echo $user_level_2;?>">
<?php }elseif($user_level_2=="admin"){?>
<input type="text" name="echo" value="管理員" readonly="readonly">
<input type="hidden" name="level" value="<?php echo $user_level_2;?>">
<?php }elseif($user_level_2=="editor"){?>
<input type="text" name="echo" value="編輯者" readonly="readonly">
<input type="hidden" name="level" value="<?php echo $user_level_2;?>">
<?php }elseif($user_level_2=="user"){?>
<input type="text" name="echo" value="一般使用者" readonly="readonly">
<input type="hidden" name="level" value="<?php echo $user_level_2;?>">
<?php }else{}?>
</td>
</tr>
<tr>
<td><input type="submit" name="submit" value="修改" onclick="return cpb_update_check()"></td>
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