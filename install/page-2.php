<?php
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
include("../include/function.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpblog--安裝嚮導--第三步</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
<script>
function cpb_add_superadmin_check()
{
	if(document.cpb_add_superadmin_form.username.value=="")
	{
		alert("帳號不能為空！");
		return false;
	}
	else if(document.cpb_add_superadmin_form.password.value=="")
	{
		alert("密碼不能為空！");
		return false;
	}
	else if(document.cpb_add_superadmin_form.password2.value=="")
	{
		alert("密碼(再輸入一次)不能為空！");
		return false;
	}
	else if(document.cpb_add_superadmin_form.password.value!=document.cpb_add_superadmin_form.password2.value)
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
<h1>changken-phpblog--安裝嚮導--第三步</h1>
<div class="nav">
<ul>
<li><a href="index.php">第一步</a>     <a href="page-1.php">第二步</a>     <span class="selected"><a href="page-2.php">第三步</a></span>     <a href="page-3.php">第四步</a>     <a href="page-4.php">第五步</a></li>
</ul>
</div>
</div>
<div class="aside">
歡迎使用changken-phpblog安裝嚮導！<br>
只要幾分鐘即可快速安裝完畢！<br>
</div>
<div class="content">
第三步:新增超級管理員<br>
<?php 
if($_GET['a']=="1"){
	
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

	if(cpb_user_reg($username,$email,$password,$password2,"superadmin"))
	{
		echo '<span style="color:green;">成功！10秒後跳轉！</span>';
		echo '<meta http-equiv=REFRESH CONTENT=10;url=page-3.php>';
	}
	else
	{
		echo '<span style="color:red;">失敗！</span>';
		echo '<meta http-equiv=REFRESH CONTENT=2;url=page-2.php>';
	}
}
else
{
}
?>
<p><font color="red">*為必填</font></p>
<form name="cpb_add_superadmin_form" action="page-2.php?a=1" method="post">
<table border="1">
<tbody>
<tr>
<th>新增超級管理員</th>
</tr>
<tr>
<td>帳號<font color="red">*</font>:<input name="username" type="text"></td>
</tr>
<tr>
<td>email:<input name="email" type="text"></td>
</tr>
<tr>
<td>密碼<font color="red">*</font>:<input name="password" type="password"></td>
</tr>
<tr>
<td>密碼(再輸入一次)<font color="red">*</font>:<input name="password2" type="password"></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="下一步" onclick="return cpb_add_superadmin_check()"></td>
</tr>
</tbody>
</table>
</form>
<div class="footer">
<?php include("../cpb-footer.php");?>
</div>
</body>

</html>