﻿<?php 
session_start();
include('../cpb-db-conn.php'); 
include("../cpb-setting.php");
include("../include/function.php");
if($_SESSION['website']==$config['website'])
{
$NO = $_POST['NO'];
$username = $_POST['username'];
$email = mysql_real_escape_string($_POST['email']);//防範sql注入攻擊
$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);
$level = $_POST['level'];

	if($_SESSION['level'] == "superadmin" or $_SESSION['level'] == "admin" or $_SESSION['level'] == "editor" or $_SESSION['level'] == "user")
	{
		if(cpb_user_update($NO,$username,$email,$password,$password2,$level))
		{
			echo '修改成功!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=update.php>';
		}
		else
		{
			echo '修改失敗!';
			echo '<meta http-equiv=REFRESH CONTENT=2;url=update.php>';	
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