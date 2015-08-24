<?php 
session_start();
include('../cpb-db-conn.php'); 
include('../cpb-setting.php'); 
if($_SESSION['website']==$config['website'])
{
//設定時區為台北
date_default_timezone_set('Asia/Taipei');

if($_GET['a']=="1")
{
//要寫入的檔案位址
$files="../cpb-setting.php";
//寫入文件內容
   $config_str="<?php";
   $config_str.="\n";//這是換行符
   $config_str.='$config["sitetitle"] = "'.$_POST["sitetitle"].'";//網站標題，純文字';
   $config_str.="\n";
   $config_str.='$config["sitename"] = "'.$_POST["sitename"].'";//網站名稱，可使用<img>tag';
   $config_str.="\n";
   $config_str.='$config["url"] = "'.$_POST["url"].'";//網站網址，http(s)://你的網站網址，後面不用加/';
   $config_str.="\n";
   $config_str.='$config["aside"] = "'.$_POST["aside"].'";//網站側邊欄設定，可使用html tag';
   $config_str.="\n";
   $config_str.='$config["nav"] = "'.$_POST["nav"].'";//網站前台導航欄設定，可使用html tag';
   $config_str.="\n";
   $config_str.='$config["rss_description"] = "'.$_POST["rss_description"].'";//rss種子碼站台簡介，可使用html tag';
   $config_str.="\n";
   $config_str.='$config["rss_state"] = "'.$_POST["rss_state"].'";//rss種子碼訂閱開啟true/關閉false';
   $config_str.="\n";
   $config_str.='$config["verification_code"] = "'.$_POST["verification_code"].'";//文章/頁面評論驗證碼開啟true/關閉false';
   $config_str.="\n";
   $config_str.='$config["site_state"] = "'.$_POST["site_state"].'";//網站開啟true/關閉false';
   $config_str.="\n";
   $config_str.='$config["site_close_description"] = "'.$_POST["site_close_description"].'";//網站關閉顯示訊息，可使用html tag';
   $config_str.="\n";
   $config_str.='$config["theme"] = "'.$_POST["theme"].'";//網站佈景主題設定';
   $config_str.="\n";
   $config_str.='$config["website"] = "'.$_POST["website"].'";//網站辨識碼，若要架設多站台的話';
   $config_str.="\n";
   $config_str.="?>";
   $f_open=fopen($files,"w+");
	if(fwrite($f_open ,$config_str))
	{
		echo "設定成功！";
	}
	else
	{
		echo "設定失敗！";
	}
//判斷rss設定是否更變
   if($_POST["rss_state"]=="false")
   {	
		include('../cpb-setting.php'); 
		//關閉rss模組
		$file = "../rss.xml";
        $content = "<?xml version='1.0' encoding='UTF-8'?>\n"; 
		$content .= "<rss version='2.0'>\n
		<channel>\n
		<title>".$config['sitename']."</title>\n";
		if($_POST["rss_description"]!=$config["rss_description"]){
		$content .= "<description><![CDATA[".$_POST['rss_description']."]]></description>\n";
		}else{
		$content .= "<description><![CDATA[".$config['rss_description']."]]></description>\n";
		}
		$content .= "<link>".$config['url']."</link>\n";
		$content .= "<item>\n
		<title>很抱歉！".$config['sitename']."的rss訂閱功能已關閉了！</title>\n
		<description><![CDATA[<p>很抱歉！".$config['sitename']."的rss訂閱功能已關閉了！</p>]]></description>\n
		<link>".$config['url']."</link>\n
		<pubDate>".date("Y-m-d g:i:s")."</pubDate>\n
		</item>\n";
		$content .= "</channel>\n
		</rss>\n";
		$fp = fopen($file,'w');
		if(fwrite($fp,$content))
		{
		echo "關閉rss種子成功！";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=setting.php>";
		}
		else
		{
		echo "關閉rss種子失敗！";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=setting.php>";
		}
		fclose($fp);
   }
   elseif($_POST["rss_description"]!=$config["rss_description"] or $_POST["rss_state"]=="true")
   {
		include('../cpb-setting.php'); 
        //rss更新模組
		$file = "../rss.xml";
        $sql = "SELECT * FROM article ORDER BY NO DESC";
        $result = mysql_query($sql);
		$num=mysql_num_rows($result);
        $content = "<?xml version='1.0' encoding='UTF-8'?>\n"; 
		$content .= "<rss version='2.0'>\n
		<channel>\n
		<title>".$config['sitename']."</title>\n
		<description><![CDATA[".$_POST['rss_description']."]]></description>\n
		<link>".$config['url']."</link>\n";
		for($i=0;$i<$num;$i++)
		{
		$row = mysql_fetch_row($result);
		if($row[5]=="posts"){
		$content .= "<item>\n
		<title>".$row[1]."</title>\n
		<description ><![CDATA[".$row[2]."<br>作者:".$row[3]."<br>發表日期:".$row[4]."<br>文章網址:<a href='".$config['url']."/posts.php?NO=".$row[0]."'>".$config['url']."/posts.php?NO=".$row[0]."</a><br>網站:<a href='".$config['url']."'>".$config['sitename']."</a>]]></description>\n
		<link>".$config['url']."/posts.php?NO=".$row[0]."</link>\n
		<pubDate>".$row[4]."</pubDate>\n
		</item>\n";
		}
		}
		$content .= "</channel>\n
		</rss>\n";
		$fp = fopen($file,'w');
		if(fwrite($fp,$content))
		{
		echo "更新rss種子成功！";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=setting.php>";
		}
		else
		{
		echo "更新rss種子失敗！";
		echo "<meta http-equiv=REFRESH CONTENT=2;url=setting.php>";
		}
		fclose($fp);
   }
   else{}
}
else{}
	$sql = "SELECT * FROM theme ORDER BY NO DESC;";
	$result = mysql_query($sql);
?> 
<!DOCTYPE html>
<html lang="zh-TW">

<head>
<title><?php echo $config['sitetitle'];?>--設定--Powered by changken-phpblog</title>
<meta charset="utf8">
<link rel="stylesheet" href="../theme/<?php echo $config['theme']?>/style.css">
</head>

<body>
<div class="header">
<h1><a href="<?php echo $config['url'];?>"><?php echo $config['sitename'];?></a>--設定</h1>
<div class="nav">
<ul>
<li><a href="index.php">管理中心</a>     <a href="article_list.php">文章管理</a>     <a href="comment_list.php">評論管理</a>     <a href="add.php">發表文章</a>     <span class="selected"><a href="setting.php">設定</a></span>     <a href="update.php">帳號設定</a>     <a href="user_list.php">會員管理</a>     <a href="add_user.php">新增會員</a>     <a href="plugin.php">外掛管理</a>     <a href="theme.php">佈景主題管理</a>     <a href="logout.php">登出</a></li>
</ul>
</div>
</div>
<div class="aside">
<?php echo $config['aside'];?>
</div>
<div class="content">
<?php if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin"){?>
<form action="setting.php?a=1" method="post">
<table>
<tr>
<td>網站標題(限純文字):<input type="text" name="sitetitle" value="<?php echo $config['sitetitle'];?>"></td>
</tr>
<tr>
<td>網站名稱(可使用&ltimg&gt tag，tag值請使用'單引號):<input type="text" name="sitename" value="<?php echo $config['sitename'];?>"></td>
</tr>
<tr>
<td>網站網址(http(s)://你的網站網址，後面不用加/):<input type="text" name="url" value="<?php echo $config['url'];?>"></td>
</tr>
<tr>
<td>網站側邊欄設定(可使用html tag，tag值請使用'單引號):<textarea rows="5" cols="50" name="aside"><?php echo $config['aside'];?></textarea></td>
</tr>
<tr>
<td>網站前台導航欄設定(可使用html tag，tag值請使用'單引號):<textarea rows="5" cols="50" name="nav"><?php echo $config['nav'];?></textarea></td>
</tr>
<tr>
<td>rss種子碼站台簡介(可使用html tag，tag值請使用'單引號):<textarea rows="5" cols="50" name="rss_description"><?php echo $config['rss_description'];?></textarea></td>
</tr>
<tr>
<td>rss種子碼訂閱開啟/關閉:
<select name="rss_state">
<?php if($config['rss_state']=="true"){?>
 <option selected="true" value="<?php echo $config['rss_state'];?>">開啟(目前設定)</option>
 <option value="false">關閉</option>
 <?php }elseif($config['rss_state']=="false"){?>
 <option value="true">開啟</option>
 <option selected="true" value="<?php echo $config['rss_state'];?>">關閉(目前設定)</option>
<?php }else{?>
 <option value="true">開啟</option>
 <option value="false">關閉</option>
<?php }?>
 </select>
</td>
</tr>
<tr>
<td>文章/頁面評論驗證碼開啟/關閉:
<select name="verification_code">
<?php if($config['verification_code']=="true"){?>
 <option selected="true" value="<?php echo $config['verification_code'];?>">開啟(目前設定)</option>
 <option value="false">關閉</option>
 <?php }elseif($config['verification_code']=="false"){?>
 <option value="true">開啟</option>
 <option selected="true" value="<?php echo $config['verification_code'];?>">關閉(目前設定)</option>
<?php }else{?>
 <option value="true">開啟</option>
 <option value="false">關閉</option>
<?php }?>
 </select>
</td>
</tr>
<tr>
<td>網站開啟/關閉:
<select name="site_state">
<?php if($config['site_state']=="true"){?>
 <option selected="true" value="<?php echo $config['site_state'];?>">開啟(目前設定)</option>
 <option value="false">關閉</option>
 <?php }elseif($config['site_state']=="false"){?>
 <option value="true">開啟</option>
 <option selected="true" value="<?php echo $config['site_state'];?>">關閉(目前設定)</option>
<?php }else{?>
 <option value="true">開啟</option>
 <option value="false">關閉</option>
<?php }?>
 </select>
</td>
</tr>
<tr>
<td>網站關閉顯示訊息(可使用html tag，tag值請使用'單引號):<textarea rows="5" cols="50" name="site_close_description"><?php echo $config['site_close_description'];?></textarea></td>
</tr>
<tr>
<td>網站佈景主題設定:
<select name="theme">
<?php 
	$i=0;
	do
	{
	$row = mysql_fetch_row($result);
?>
 <option 
 <?php if($row[3]==$config['theme']){
 ?> selected="true" <?php }else{}?> value="<?php echo $row[3];?>"><?php echo $row[1];?></option>
<?php 
    $i++;
	}while($i<mysql_num_rows($result));
?>
 </select>
</td>
</tr>
<tr>
<td>網站辨識碼，若要架設多站台的話:<input type="text" name="website" value="<?php echo $config['website'];?>"></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="送出"></td>
</tr>
</table>
</form>
<?php 
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