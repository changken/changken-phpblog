<?php
session_start();
include("../cpb-db-conn.php");
include("../cpb-setting.php");
include("../include/function.php");
if($_SESSION['website']==$config['website'])
{
$username = mysql_real_escape_string($_POST['username']);//防範sql注入攻擊
$email = mysql_real_escape_string($_POST['email']);
$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);
$level = $_POST['level'];

	if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin")
	{
        if(cpb_user_reg($username,$email,$password,$password2,$level))
        {
                echo '新增成功!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=user_list.php>';
        }
        else
        {
                echo '新增失敗!';
                echo '<meta http-equiv=REFRESH CONTENT=2;url=add_user.php>';
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
	echo '您無權限觀看此頁面!!';
    echo '<meta http-equiv=REFRESH CONTENT=2;url=../index.php>';
}
?>