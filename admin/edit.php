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
<title><?php echo $config['sitetitle'];?>--編輯文章--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
<script src="../ckeditor-full/ckeditor.js" type="text/javascript"><!--mce:2--></script>
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--編輯文章</h1>
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
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor")
{
        //將$_GET['NO']丟給$NO
        //這樣在下SQL語法時才可以給搜尋的值
        $NO = mysql_real_escape_string($_GET['NO']);
        //若以下$NO直接用$_GET['NO']將無法使用
        $sql = "SELECT * FROM article where NO='$NO'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or ($_SESSION['level'] == "editor" and $_SESSION['username'] == $row[3])){
?>   
<form name="form" method="post" action="editc.php">
<table>
<tbody>
<tr>
<td>NO：<input type="text" name="NO" value="<?php echo $row[0];?>" readonly="readonly"></td>
</tr>
<tr>
<td>標題：<input type="text" name="title" value="<?php echo $row[1];?>"></td>
</tr>
<tr>
<td>內容：<textarea name="content" cols="100" rows="50" id="full"><?php echo $row[2];?></textarea></td>
</tr>
<tr>
<td>作者：<input type="text" name="writer" value="<?php echo $row[3];?>" readonly="readonly"></td>
</tr>
<tr>
<td>發表日期：<input type="text" name="time" value="<?php echo $row[4];?>" readonly="readonly"></td>
</tr>
<tr>
<td>
文章類型:
<select name="type">
<?php if($row[5]=="posts"){?>
<option selected="true" value="<?php echo $row[5];?>">文章(目前設定)</option>
<option value="page">頁面</option>
<option value="draft">草稿</option>
<?php }elseif($row[5]=="page"){?>
<option value="posts">文章</option>
<option selected="true" value="<?php echo $row[5];?>">頁面(目前設定)</option>
<option value="draft">草稿</option>
<?php }elseif($row[5]=="draft"){?>
<option value="posts">文章</option>
<option value="page">頁面</option>
<option selected="true" value="<?php echo $row[5];?>">草稿(目前設定)</option>
<?php }else{}?>
</select>
</td>
</tr>
<tr>
<td>
評論狀態:
<select name="comment_type">
<?php if($row[6]=="true"){?>
<option selected="true" value="<?php echo $row[6];?>">開啟(目前設定)</option>
<option value="false">關閉</option>
<?php }elseif($row[6]=="false"){?>
<option value="true">開啟</option>
<option selected="true" value="<?php echo $row[6];?>">關閉(目前設定)</option>
<?php }else{}?>
</select>
</td>
</tr>
<tr>
<td><input type="submit" name="button" value="確定"></td>
</tr>
</tbody>
</table>
</form>
<script>
CKEDITOR.replace('full'); 
</script>
<?php
}
else
{
        echo '您無權限編輯此文章!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=article_list.php>';
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