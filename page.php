<?php
session_start();
include("cpb-db-conn.php");
include("cpb-setting.php");
/*獲取文章資訊*/
$NO = mysql_real_escape_string($_GET['NO']);
$sql = "SELECT * FROM article where NO='$NO'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
/*獲取外掛資訊(在內容上方)*/
$plugin_sql_content_header = "SELECT * FROM plugin where p_where = 'contentheader' ORDER BY NO DESC";
$plugin_result_content_header = mysql_query($plugin_sql_content_header);
/*獲取外掛資訊(在文章/頁面下方)*/
$plugin_sql_postspage_footer = "SELECT * FROM plugin where p_where = 'postspagefooter' ORDER BY NO DESC";
$plugin_result_postspage_footer = mysql_query($plugin_sql_postspage_footer);
/*獲取外掛資訊(在內容下方)*/
$plugin_sql_content_footer = "SELECT * FROM plugin where p_where = 'contentfooter' ORDER BY NO DESC";
$plugin_result_content_footer = mysql_query($plugin_sql_content_footer);
/*獲取外掛資訊(在頁尾下方)*/
$plugin_sql_footer = "SELECT * FROM plugin where p_where = 'footer' ORDER BY NO DESC";
$plugin_result_footer = mysql_query($plugin_sql_footer);
if($row[5]=="page"){
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--<?php echo $row[1];?>--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="theme/<?php echo $config['theme']?>/style.css">
<script src="ckeditor-basic/ckeditor.js" type="text/javascript"><!--mce:2--></script>
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--<?php echo $row[1];?></h1>
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
<?php if($config["site_state"]=="true"){?>
<?php
/*嵌入式外掛(在內容上方)*/
$i=0;
$plugin_num_content_header=mysql_num_rows($plugin_result_content_header);
do{
$plugin_row_content_header = mysql_fetch_row($plugin_result_content_header);
	include("plugin/".$plugin_row_content_header[5]."/index.php");
$i++;
}while($i<$plugin_num_content_header);
?>
<?php  
$NO = $_GET['NO'];
$sql = "SELECT * FROM article where NO='$NO'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
$comment_type = $row[6];
if($row[5]=="page"){
?>
<div class="page">
<blockquote>
<h1><a href="<?php echo $config['url'];?>/posts.php?NO=<?php echo $row[0];?>"><?php echo $row[1];?></a></h1>
<?php echo $row[2];?>
<p>作者:<?php echo $row[3];?></p>
<p>發表日期:<?php echo $row[4];?></p>
</blockquote>
<?php
/*嵌入式外掛(在文章/頁面下方)*/
$i=0;
$plugin_num_postspage_footer=mysql_num_rows($plugin_result_postspage_footer);
do{
$plugin_row_postspage_footer = mysql_fetch_row($plugin_result_postspage_footer);
	include("plugin/".$plugin_row_postspage_footer[5]."/index.php");
$i++;
}while($i<$plugin_num_postspage_footer);
?>
</div>
<hr><size=5>
<h1>評論</h1>
<?php
}
else{}
$sql="SELECT * FROM comment where posts_id = '$NO' ORDER BY NO DESC;";
$result=mysql_query($sql);
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
echo"<div class='comment'>";
echo"<blockquote><b><span style='color: blue;'>";
echo"<h2><a href=".$row['website'].">".$row['nickname']."</a></h2>";
echo"</span></b>";
echo"<b>".$row['time']."</b>";
echo"<br>";
echo $row['content']."<br>";
echo"<br>";
echo"</blockquote>";
echo"</div>";
        }
 
  }
  ?>
<p><b>發表評論</b><br>
您的email不會被公開。<font color="red">*為必填</font></p>
<?php if($comment_type=="true"){?>
<?php if($_GET['a']=="err3"){echo"<font color='red'>很抱歉！該暱稱已有會員使用了！</font>";}else{}?>
<form action="comment.php" method="post">
<table>
<tr>
<td><input type="hidden" name="posts_id" value="<?php echo $NO?>"></td>
</tr>
<?php
if($_SESSION['website']==$config['website'])
{  
$username = $_SESSION['username'];
$sql = "SELECT * FROM user where username='$username'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);
?>
<?php if($_SESSION['username']!=null){?>
<tr>
<td>暱稱:<input type="text" name="nickname" value="<?php echo $row[1]?>" readonly="readonly"></td>
</tr>
<tr>
<td>email:<input type="text" name="email" value="<?php echo $row[2]?>" readonly="readonly"></td>
</tr>
<?php }else{}?>
<?php }else{?>
<tr>
<td>暱稱:<input type="text" name="nickname"><font color="red">*</font><?php if($_GET['a']=="err1"){echo"<font color='red'>錯誤！暱稱不能無空！</font>";}else{}?></td>
</tr>
<tr>
<td>email:<input type="text" name="email"><font color="red">*</font><?php if($_GET['a']=="err2"){echo"<font color='red'>錯誤！email不能無空！</font>";}else{}?></td>
</tr>
<?php }?>
<tr>
<td>網站:<input type="text" name="website"></td>
</tr>
<tr>
<td>內容:<textarea rows="5" cols="50" name="content" id="basic"></textarea></td>
</tr>
<tr>
<td><input type="hidden" name="posts_type" value="page"></td>
</tr>
<?php
if($config['verification_code']=="true"){
	if($_SESSION['website']==$config['website'])
	{ 	
		if($_SESSION['username']!=null)
		{
?>
<tr>
<td>您已登入！不須輸入驗證碼！</td>
</tr>
<?php }else{}?>
<?php }else{?>
<tr>
<td align="left" colspan="2"><font size="2">請輸入驗證碼：</font><img src="imagebuilder.php" border="1">
<input maxlength=8 size=8 name="userstring" type="text" value=""></td>
</tr>
<?php 
}
}else{}
?>
<tr>
<td><input type="submit" name="submit" value="送出"></td>
</tr>
</table>
</form>
<?php }else{echo"<p>很抱歉！".$row[1]."的評論功能已關閉！</p>";}?>
<script>
CKEDITOR.replace('basic'); 
</script>
<?php
/*嵌入式外掛(在內容下方)*/
$i=0;
$plugin_num_content_footer=mysql_num_rows($plugin_result_content_footer);
do{
$plugin_row_content_footer = mysql_fetch_row($plugin_result_content_footer);
	if($plugin_row_content_footer[7]=="contentfooter")
	{
	include("plugin/".$plugin_row_content_footer[5]."/index.php");
	}
$i++;
}while($i<$plugin_num_content_footer);
?>
<?php }else{header("Location:close.php");}?>
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
<?php }else{echo"<meta http-equiv=REFRESH CONTENT=1;url='index.php'>";}?>