<?php 
session_start();
include("cpb-db-conn.php");//引入MySQL資料庫配置檔
include("cpb-setting.php");
include("include/function.php");//引入changken-phpblog api函數
$username = mysql_real_escape_string($_POST['username']);//防範sql注入攻擊
$password = mysql_real_escape_string($_POST['password']);//防範sql注入攻擊

if(cpb_user_login($username,$password))
{
	echo "登入成功！";
	echo '<meta http-equiv=REFRESH CONTENT=1;url=admin>';	
}
else
{
	echo "登入失敗！";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}
?>