<?php
/**
 file name:changken-phpblog api
 author:changken
 version:v1.1
 last update:2015-2-1
 */
/***************************************************/
define("CPB_API_VERSION","v1.1");
define("CPB_API_LAST_UPDATE","2015-2-1");
define("CPB_API_VERSION_VALUE","11");
/***************************************************/
function cpb_user_login($username,$password)
{
global $config;

$password_md5 = md5($password);

$sql="SELECT * FROM user WHERE username = '$username'";
$result  = mysql_query($sql);
$row = @mysql_fetch_row($result);

if($username==null)//check it if username is null
{
$code = false;
}
elseif($password==null)//check it if password is null
{
$code = false;
}
elseif($row[1] != $username)//check it if username is wrong
{
$code = false;
}
elseif($row[3] != $password_md5)//check it if password is wrong
{
$code = false;
}
else
{
	$_SESSION['website'] = $config['website'];
	if($row[4] == "superadmin"){ //if member level is superadmin
        //write into session
		$_SESSION['level'] = "superadmin";
        $_SESSION['username'] = $username;
		$code = true;
	}
	elseif($row[4] == "admin"){ //if member level is admin
        //write into session
        $_SESSION['level'] = "admin";
        $_SESSION['username'] = $username;
		$code = true;
	}
	elseif($row[4] == "editor"){ //if member level is editor
        //write into session
        $_SESSION['level'] = "editor";
        $_SESSION['username'] = $username;
		$code = true;
	}
	elseif($row[4] == "user"){ //if member level is user
        //write into session
        $_SESSION['level'] = "user";
        $_SESSION['username'] = $username;
		$code = true;
	}
	else
	{
		$code = false; 
	}
}
return $code;
}
/***************************************************/
function cpb_user_reg($username,$email,$password,$password2,$level)
{
$password_md5 = md5($password);
$sql = "SELECT * FROM user where username = '$username'";
$result = mysql_query($sql);
$row = @mysql_fetch_row($result);
if($username==null)
{
$code = false;
}
elseif($password==null)
{
$code = false;
}
elseif($password2==null)
{
$code = false;
}
elseif($password!=$password2)
{
$code = false;
}
elseif($row[1]==$username)
{
$code = false;
}
else
{
$sql="INSERT INTO user (username,email,password,level) VALUES ('$username','$email','$password_md5','$level')";
        if(mysql_query($sql))
        {
				$code = true;
        }
        else
        {
				$code = false;
        }
}
return $code;
}
/***************************************************/
function cpb_user_update($NO,$username,$email,$password,$password2,$level)
{
	if($password==null and $password2==null)
	{
		global $user_password;
		cpb_get_user_info($NO); //using cpb_get_user_info() function to get user infomation for replace null password.
		$password=$user_password; //replace password
		$password2=$user_password; //replace password2
		$password_md5 = $password;
	}
	else
	{
		$password_md5 = md5($password);
	}
	
if($password==null)
{
$code = false;
}
elseif($password2==null)
{
$code = false;
}
elseif($password!=$password2)
{
$code = false;
}
else
{
        //update user infomation in MySQL database 
        $sql = "UPDATE user SET username='$username', email='$email', password='$password_md5', level='$level' where NO='$NO'";
        if(mysql_query($sql))
        {
				$code = true;
        }
        else
        {
				$code = false;
        }
}
return $code;
}
/***************************************************/
function cpb_user_delete($NO)
{
        //delete user in MySQL database
        $sql = "delete from user where NO='$NO'";
        if(mysql_query($sql))
        {
				$code = true;
        }
        else
        {
				$code = false;
        }
return $code;
}
/***************************************************/
function cpb_user_logout()
{
	if(isset($_SESSION))
	{
		unset($_SESSION['website']);
		unset($_SESSION['level']);
		unset($_SESSION['username']);
		$code = true;
	}
	else
	{
		$code = false;	
	}
return $code;
}
/***************************************************/
function cpb_get_user_info($NO)
{
		global $user_no,$user_name,$user_email,$user_password,$user_level;
        $sql = "SELECT * FROM user where NO='$NO'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
		$user_no = $row[0]; 
		$user_name = $row[1]; 
		$user_email = $row[2]; 
		$user_password = $row[3]; 
		$user_level = $row[4];
}
/***************************************************/
function cpb_get_user_info_2($username) //using username
{
		global $user_no_2,$user_name_2,$user_email_2,$user_password_2,$user_level_2;
        $sql = "SELECT * FROM user where username='$username'";
        $result = mysql_query($sql);
        $row = mysql_fetch_row($result);
		$user_no_2 = $row[0]; 
		$user_name_2 = $row[1]; 
		$user_email_2 = $row[2]; 
		$user_password_2 = $row[3]; 
		$user_level_2 = $row[4];
}
/***************************************************/
function cpb_user_delete_2($username) //using username
{
        //delete user in MySQL database
        $sql = "delete from user where username='$username'";
        if(mysql_query($sql))
        {
				$code = true;
        }
        else
        {
				$code = false;
        }
return $code;
}
?>