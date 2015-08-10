<?php
session_start();
include("cpb-db-conn.php");
include("cpb-setting.php");
/*獲取外掛資訊(在內容上方)*/
$plugin_sql_content_header = "SELECT * FROM plugin where p_where = 'contentheader' ORDER BY NO DESC";
$plugin_result_content_header = mysql_query($plugin_sql_content_header);
/*獲取外掛資訊(在內容下方)*/
$plugin_sql_content_footer = "SELECT * FROM plugin where p_where = 'contentfooter' ORDER BY NO DESC";
$plugin_result_content_footer = mysql_query($plugin_sql_content_footer);
/*獲取外掛資訊(在頁尾下方)*/
$plugin_sql_footer = "SELECT * FROM plugin where p_where = 'footer' ORDER BY NO DESC";
$plugin_result_footer = mysql_query($plugin_sql_footer);
?>
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a></h1>
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
$sql="SELECT * FROM article ORDER BY NO DESC";
$result=mysql_query($sql);
  if(mysql_num_rows($result)>0)
  {
        $num=mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
                $row=mysql_fetch_array($result);
				if($row['type']=="posts"){
echo"<div class='article'>";
echo"<blockquote><b><span style='color: blue;'>";
?>
<h1><a href="<?php echo $config['url'];?>/posts.php?NO=<?php echo $row['NO'];?>"><?php echo $row['title'];?></a></h1>
<?php
echo"</span></b>";
echo $row['content'];
echo"<br>";
echo $row['writer'];
echo"<br>";
echo $row['time'];
echo"</blockquote>";
echo"</div>";
      }
	  else
	  {}
    }
}
?>
<?php
/*嵌入式外掛(在內容下方)*/
$i=0;
$plugin_num_content_footer=mysql_num_rows($plugin_result_content_footer);
do{
$plugin_row_content_footer = mysql_fetch_row($plugin_result_content_footer);
	include("plugin/".$plugin_row_content_footer[5]."/index.php");
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