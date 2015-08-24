<?php
session_start();
include("../cpb-setting.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpblog--安裝嚮導--第一步</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1>changken-phpblog--安裝嚮導--第一步</h1>
<div class="nav">
<ul>
<li><span class="selected"><a href="index.php">第一步</a></span>     <a href="page-1.php">第二步</a>     <a href="page-2.php">第三步</a>     <a href="page-3.php">第四步</a>     <a href="page-4.php">第五步</a></li>
</ul>
</div>
</div>
<div class="aside">
歡迎使用changken-phpblog安裝嚮導！<br>
只要幾分鐘即可快速安裝完畢！<br>
</div>
<div class="content">
第一步:安裝前請先確認以下動作是否完成。<br>
1.cpb-config.php請先設定完成。<br>
<input value="下一步" onclick="javascript:location.href='page-1.php';" type="button">
</div>
<div class="footer">
<?php include("../cpb-footer.php");?>
</div>
</body>

</html>