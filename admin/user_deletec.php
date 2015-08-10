<?php 
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
include("../include/function.php");
if($_SESSION['website']==$config['website'])
{
$NO = $_POST['NO'];
cpb_get_user_info($NO);

	if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin")
	{
		if(cpb_user_delete($NO))
		{
			echo '刪除成功!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=user_list.php>';
		}
		else
		{
			echo '刪除失敗!';
			echo "<meta http-equiv=REFRESH CONTENT=2;url=user_delete.php?=".$NO.">";
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