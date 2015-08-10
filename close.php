<?php
session_start();
include("cpb-db-conn.php");
include("cpb-setting.php");
/*獲取外掛資訊(在頁尾下方)*/
$plugin_sql_footer = "SELECT * FROM plugin where p_where = 'footer' ORDER BY NO DESC";
$plugin_result_footer = mysql_query($plugin_sql_footer);
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--網站關閉中--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--網站關閉中</h1>
<div class="nav">
<ul>
<li><?php echo $config['nav'];?></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<table border="1">
<tbody>
<tr>
<td>
網站關閉中，可能是以下原因:<br>
<?php echo $config['site_close_description'];?>
</td>
</tr>
</tbody>
</table>
</div>
<div class="footer">
<?php include("cpb-footer.php");?>
</div>
<?php
/*嵌入式外掛(在頁尾)*/
$i=0;
$plugin_num_footer=mysql_num_rows($plugin_result_footer);
do{
$plugin_row_footer = mysql_fetch_row($plugin_result_footer);
	include("plugin/".$plugin_row_footer[5]."/index.php");
$i++;
}while($i<$plugin_num_footer);
?>
</body>

</html>