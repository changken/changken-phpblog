<?php
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
include("../include/function.php");
if($_SESSION['website']==$config['website'])
{
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--會員編輯--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
<script>
function cpb_user_edit_check()
{
	if(document.cpb_user_edit_form.password.value=="" && document.cpb_user_edit_form.password2.value!="")
	{
		alert("密碼不能為空！");
		return false;
	}
	else if(document.cpb_user_edit_form.password.value!="" && document.cpb_user_edit_form.password2.value=="")
	{
		alert("密碼(再輸入一次)不能為空！");
		return false;
	}
	else if(document.cpb_user_edit_form.password.value != document.cpb_user_edit_form.password2.value)
	{
		alert("密碼不一致！");
		return false;
	}
	else if(document.cpb_user_edit_form.password.value=="" && document.cpb_user_edit_form.password2.value=="")
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
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--會員編輯</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>    <a href="logout.php">登出</a></li>
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
	$NO = mysql_real_escape_string($_GET['NO']);//防範sql注入攻擊
	cpb_get_user_info($NO);
	if($user_level!="superadmin")
	{
		if($_SESSION['level'] == "admin" and $user_level=="admin")
		{
        echo '您要編輯的會員為管理員，由於您目前的權限為管理員並非超級管理員，無法編輯!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=user_list.php>';					
		}
		else
		{
?>
<p><font color="red">若密碼不要修改，兩個欄位請留空！</font></p>
<form name="cpb_user_edit_form" method="post" action="user_editc.php">
<table border="1">
<tbody>
<tr>
<th>會員編輯</th>
</tr>
<tr>
<td>NO：<input type="text" name="NO" value="<?php echo $user_no;?>" readonly="readonly"></td>
</tr>
<tr>
<td>帳號：<input type="text" name="username" value="<?php echo $user_name;?>" readonly="readonly"></td>
</tr>
<tr>
<td>email<font color="red">(選填)</font>：<input type="text" name="email" value="<?php echo $user_email;?>"></td>
</tr>
<tr>
<td>密碼<font color="red">(選填)</font>：<input type="password" name="password"></td>
</tr>
<tr>
<td>密碼(再輸入一次)<font color="red">(選填)</font>：<input type="password" name="password2"></td>
</tr>
<tr>
<td>
權限：
	<select name="level">
	<?php if($user_level=="admin"){?>
		<option selected="true" value="<?php echo $user_level;?>">管理員(目前設定)</option>
		<option value="editor">編輯者</option>
		<option value="user">一般使用者</option>
	<?php }elseif($user_level=="editor"){?>
		<option value="admin">管理員</option>
		<option selected="true" value="<?php echo $user_level;?>">編輯者(目前設定)</option>
		<option value="user">一般使用者</option>
	<?php }elseif($user_level=="user"){?>
		<option value="admin">管理員</option>
		<option value="editor">編輯者</option>
		<option selected="true" value="<?php echo $user_level;?>">一般使用者(目前設定)</option>
	<?php }else{}?>
	</select>
</td>
</tr>
<tr>
<td><input type="submit" name="submit" value="修改" onclick="return cpb_user_edit_check()"></td>
</tr>
</tbody>
</table>
</form>
<?php
		}
	}
	else
	{
        echo '此會員為超級管理員，無法編輯!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=user_list.php>';		
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