<?php
session_start();
include("../cpb-setting.php");
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title>changken-phpblog--安裝嚮導--第五步</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1>changken-phpblog--安裝嚮導--第五步</h1>
<div class="nav">
<ul>
<li><a href="index.php">第一步</a>     <a href="page-1.php">第二步</a>     <a href="page-2.php">第三步</a>     <a href="page-3.php">第四步</a>     <span class="selected"><a href="page-4.php">第五步</a></span></li>
</ul>
</div>
</div>
<div class="aside">
歡迎使用changken-phpblog安裝嚮導！<br>
只要幾分鐘即可快速安裝完畢！<br>
</div>
<div class="content">
第五步:完成！<br>
<span style="color: red;">請將install資料夾刪除</span><br>
<input value="回首頁" onclick="javascript:location.href='../index.php';" type="button">
</div>
<div class="footer">
<?php include("../cpb-footer.php");?>
</div>
</body>

</html>