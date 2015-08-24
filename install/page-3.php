<?php
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpblog--安裝嚮導--第四步</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
<script>
function install_plugin_check()
{
	if(document.install_plugin_form.install_cpb_info.value=="")
	{
		alert("您尚未勾選！");
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
<h1>changken-phpblog--安裝嚮導--第四步</h1>
<div class="nav">
<ul>
<li><a href="index.php">第一步</a>     <a href="page-1.php">第二步</a>     <a href="page-2.php">第三步</a>     <span class="selected"><a href="page-3.php">第四步</a></span>     <a href="page-4.php">第五步</a></li>
</ul>
</div>
</div>
<div class="aside">
歡迎使用changken-phpblog安裝嚮導！<br>
只要幾分鐘即可快速安裝完畢！<br>
</div>
<div class="content">
第四步:選擇您想要安裝的內建外掛<br>
<?php
if($_GET['a']=="1")
{
	if($_POST['install_cpb_info']=="install")
	{
		$cpb_info_sql="INSERT INTO `plugin` (`NO`, `name`, `writer_name`, `version`, `update_date`, `folder_name`, `mode`, `p_where`) VALUES (1, 'cpb-info', 'changken', 'v1.1', '2015-2-2', 'cpb-info', 'true', 'null');";
		if(mysql_query($cpb_info_sql))
		{
			echo '<span style="color:green;">安裝「cpb版本資訊」外掛成功！10秒後跳轉！</span>';
			echo '<meta http-equiv=REFRESH CONTENT=10;url=page-4.php>';	
		}
		else
		{
			echo '<span style="color:red;">安裝「cpb版本資訊」外掛失敗！</span>';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=page-3.php>';	
		}
	}
	elseif($_POST['install_cpb_info']=="do_not_install")
	{
			echo '<span style="color:green;">您選擇不安裝！將自動轉至下一步</span>';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=page-4.php>';			
	}
	else
	{
	}
}
else
{
}
?>
<form name="install_plugin_form" method="post" action="page-3.php?a=1">
<table border="1">
<tbody>
<tr>
<th>安裝內建外掛</th>
</tr>
<tr>
<td>cpb版本資訊:<label><input type="radio" name="install_cpb_info" value="install">安裝</label><label><input type="radio" name="install_cpb_info" value="do_not_install">不安裝</label></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="下一步" onclick="return install_plugin_check()"></td>
</tr>
</tbody>
</table>
</form>
</div>
<div class="footer">
<?php include("../cpb-footer.php");?>
</div>
</body>

</html>