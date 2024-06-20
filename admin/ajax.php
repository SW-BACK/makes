<?php
/*
 * @Author: SW-BACK
 * @Date: 2023-06-08 22:23:58
 * @LastEditors: SW-BACK 1760349255@qq.com
 * @LastEditTime: 2023-06-08 22:38:52
 * @Description: 
 * 
 * Copyright (c) 2023 by SwBack, All Rights Reserved. 
 */
include '../config.php';
require_once("./function.php");
 session_start();
 if(!isset($_SESSION['username']) or $_SESSION['username']!="超级管理员"){
    die("<script>
    location.href=\"../index.html\";
    </script>");
}   
// header("Content-type: text/html; charset=utf-8");


$x =$_GET['x'];
if (isset($x) ||is_string($x)){
	switch($x){
	    //获取用户列表
        case 'GetUserList':
            GetUserList();
            break;
        //获取题目列表
        case 'GetSubList':
            GetSubList();
            break;
        //获取用户登录记录
        case 'GetLoginLog':
            GetLoginLog();
            break;
        case 'delMessage':
            delMessage($_POST['table_name'],$_POST['id']);
        // //获取flag提交记录
        // case 'getSubmitRecord':
        //     getSubmitRecord();
        //     break;
        // //删除数据
        // case 'delAllSubmit':
        //     msg_Check('number',$_GET["id"]);
        //     delAllSubmit($_GET["table_name"],$_GET["id"]);
        //     break;
        // //获取公告列表
        // case 'getNoticeList':
        //     getNoticeList();
        //     break;
        // //添加公告
        // case 'AddNotice':
        //     msg_Check('title',$_POST["title"]);
        //     AddNotice($_POST["title"],$_POST["notice"]);
        //     break;
        // //获取题目开启记录
        // case 'getOpenRecord':
        //     getOpenRecord();
        //     break;
		default:
			echo "参数错误";
			break;
	}
}else{
	echo '未找到参数';
}
?>