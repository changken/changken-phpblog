<?php
session_start();
include("cpb-setting.php");
if($config['verification_code']=="true"){ 
/*======驗證碼開始======*/
	if($_SESSION['website']==$config['website'])
	{
		if($_SESSION['username']!=null)
		{
		}
	}
	else
	{
	include("settings.php") ; 
	$string = strtoupper($_SESSION['string']);
	$userstring = strtoupper($_POST['userstring']); 
	unset($_SESSION['string']);
		
		if (($string != $userstring) || (strlen($string) <= 4)) 
		{
			echo "<center><br><br><br><br><br><br><br><font color=red size=2>驗証碼錯誤！請輸入正確的驗證碼</font><br><a href=javascript:history.back(1)><font size=2><center>回上一頁</font></a>";
			exit();
		}
	}
/*======驗證碼結束======*/
}else{}
include("cpb-db-conn.php");

//設定時區為台北
date_default_timezone_set('Asia/Taipei');

$posts_id = $_POST['posts_id'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$website = $_POST['website'];
$content = $_POST['content'];
$time = date("Y-m-d H:i:s");
$posts_type = $_POST['posts_type'];

$sql = "SELECT * FROM user where username='$nickname'";
$result = mysql_query($sql);
$row = mysql_fetch_row($result);

//檢查使用者是否已登入
if($_SESSION['website']==$config['website'])
{
	if($_SESSION['username']!=null and $_SESSION['username']==$nickname)
	{
		$sql="INSERT INTO comment (posts_id, nickname, email, website, content, time) VALUES ('$posts_id', '$nickname', '$email', '$website', '$content', '$time');";
		if(mysql_query($sql))
		{
			echo"送出成功！";
			echo"<meta http-equiv=REFRESH CONTENT=1;url=".$posts_type.".php?NO=".$posts_id.">";
		}
		else
		{
			echo"送出失敗！";
			echo"<meta http-equiv=REFRESH CONTENT=1;url=".$posts_type.".php?NO=".$posts_id.">";
		}
	}
}
else //若是訪客，檢查是否有以下狀況發生
{
	if($nickname==null){
	header("Location:".$posts_type.".php?NO=".$posts_id."&a=err1");
	}
	elseif($email==null){
	header("Location:".$posts_type.".php?NO=".$posts_id."&a=err2");
	}
	elseif($nickname==$row[1]){ //檢查訪客是否使用已註冊的使用者名稱
	header("Location:".$posts_type.".php?NO=".$posts_id."&a=err3");
	}
	else
	{
		$sql="INSERT INTO comment (posts_id, nickname, email, website, content, time) VALUES ('$posts_id', '$nickname', '$email', '$website', '$content', '$time');";
		if(mysql_query($sql))
		{	
			echo"送出成功！";
			echo"<meta http-equiv=REFRESH CONTENT=1;url=".$posts_type.".php?NO=".$posts_id.">";
		}
		else
		{
			echo"送出失敗！";
			echo"<meta http-equiv=REFRESH CONTENT=1;url=".$posts_type.".php?NO=".$posts_id.">";
		}
	}
}
?>