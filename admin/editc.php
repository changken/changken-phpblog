<?php 
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
if($_SESSION['website']==$config['website'])
{
$NO = $_POST['NO'];
$title = $_POST['title'];
$content = $_POST['content'];
$writer = $_POST['writer'];
$time = $_POST['time'];
$type = $_POST['type'];
$comment_type = $_POST['comment_type'];
 
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor")
{   
        //更新資料庫資料語法
        $sql = "UPDATE article SET title='$title', content='$content',writer='$writer', time='$time', type='$type', comment_type='$comment_type' where NO='$NO'";
        if(mysql_query($sql))
        {
        echo '修改成功!';
			if($type=="posts"){
				if($config["rss_state"]=="true"){
		//rss更新模組
		$file = "../rss.xml";
        $sql = "SELECT * FROM article ORDER BY NO DESC";
        $result = mysql_query($sql);
		$num=mysql_num_rows($result);
        $content = "<?xml version='1.0' encoding='UTF-8'?>\n"; 
		$content .= "<rss version='2.0'>\n
		<channel>\n
		<title>".$config['sitename']."</title>\n
		<description><![CDATA[".$config['rss_description']."]]></description>\n
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
		}
		else
		{
		echo "更新rss種子失敗！";
		}
		fclose($fp);
				}else{}
			}else{}
        echo '<meta http-equiv=REFRESH CONTENT=2;url=article_list.php>';
		}
        else
        {
                echo '修改失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=article_list.php>';
        }
	}
	else
	{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
	}
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>