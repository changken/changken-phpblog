<?php 
session_start(); 
include("../cpb-db-conn.php");
include("../cpb-setting.php");
if($_SESSION['website']==$config['website'])
{
$NO = $_POST['NO'];

if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor")
{
        //刪除資料庫資料語法
        $sql = "delete from comment where NO='$NO'";
        if(mysql_query($sql))
        {
                echo '刪除成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=comment_list.php>';
        }
        else
        {
                echo '刪除失敗!';
                echo "<meta http-equiv=REFRESH CONTENT=2;url=comment_delete.php?=".$NO.">";
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