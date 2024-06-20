<?php
include './config.php';
require_once("./function.php");
header("Access-Control-Allow-Origin: http://10.1.1.203");
//header("Access-Control-Allow-Origin: http://10.1.1.204");

$k =$_GET['k'];
if (isset($k) ||is_string($k)){
	switch($k){
		case 'getSubject':
			getSubject($_POST["subject"],$_GET['token']);
		    break;
		//获取登录状态
		case 'checkLogin':
			checkLogin();
			break;
		case 'login':
		    userLogin($_POST["username"],$_POST["password"],$_POST["yzm"]);
		//用户登出
		case 'logout':
			logout();
			break;
		default:
			echo "未知参数";
			break;
	}
}else{
	echo '参数错误';
}
?>