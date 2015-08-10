<?php 
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
if($_SESSION['website']==$config['website'])
{
$comment_id = $_POST['comment_id'];//獲取評論辨識值，若修改失敗可回上一頁。
$NO = $_POST['NO'];
$posts_id = $_POST['posts_id'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$website = $_POST['website'];
$content = $_POST['content'];
$time = $_POST['time'];
 
if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor")
{   
        //更新資料庫資料語法
        $sql = "UPDATE comment SET posts_id='$posts_id', nickname='$nickname', email='$email', website='$website', content='$content', time='$time' where NO='$NO'";
        if(mysql_query($sql))
        {
                echo '修改成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=comment_list.php>';
        }
        else
        {
                echo '修改失敗!';
                echo "<meta http-equiv=REFRESH CONTENT=2;url=comment_edit.php?=".$comment_id.">";
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