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
<title><?php echo $config['sitetitle'];?>--會員刪除--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--會員刪除</h1>
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
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?>
<span style="color:red;">您確定？此動作一旦執行將無法回復！！！</span><br>
<?php 
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
<form name="cpb_user_delete_form" method="post" action="user_deletec.php">
<table border="1">
<tbody>
<tr>
<th>會員刪除</th>
</tr>
<tr>
<td>要刪除的會員編號：<input type="text" name="NO" value="<?php echo $user_no;?>" readonly="readonly"></td>
</tr>
<tr>
<td>要刪除的會員名稱：<input type="text" name="username" value="<?php echo $user_name;?>" readonly="readonly"></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="刪除"/></td>
</tr>
</tbody>
</table>
</form>
<?php
		}
	}
	else
	{
        echo '此會員為超級管理員，無法刪除!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=user_list.php>';		
	}
}
else
{	echo '您無權限觀看此頁面!!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';}
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
	echo '您無權限觀看此頁面!!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>