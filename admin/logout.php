<?php 
session_start();
include("../include/function.php");
if(cpb_user_logout())
{
	echo '登出中......';
	echo '<meta http-equiv=REFRESH CONTENT=1;url=../index.php>';
}
else
{
	echo '登出失敗！';
	echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}
?>