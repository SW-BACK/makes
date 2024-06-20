<?php
require_once '../config.php';
//用户数据获取(json返回)
function GetUserList(){
    global $link;
    $sql = "select * from user where status != 2"; 
    $result = mysqli_query($link,$sql); 
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
       $list[] = array( 
            'Id' => $row['id'], 
            'username' => $row['username'], 
            'nickname' => $row['nickname'], 
            "email" => $row["email"],
            "phone" => $row["phone"],
            "teamId" => $row["teamId"],
            "status" => $row["status"],
            "is_admin" => $row["is_admin"],
        );
    }die(show(1,"信息获取成功",$list));
}
//获取答题记录列表
function GetSubList(){
    global $link;
    $sql = "select * from analyze_log order by time DESC"; 
    $result = mysqli_query($link,$sql); 
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
       $list[] = array( 
            'Id' => $row['id'], 
            'user' => $row['user'], 
            "ip" => $row["ip"],
            "key" => $row["key"],
            "time" => $row["time"],
        );
    }die(show(1,"信息获取成功",$list));
}
//获取用户登录记录
function GetLoginLog(){
    global $link;
    $sql = "SELECT login_log.*,user.username AS cardId FROM `user`,`login_log` WHERE login_log.username = user.nickname ORDER BY loginTime DESC"; 
    $result = mysqli_query($link,$sql); 
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
       $list[] = array( 
            'Id' => $row['id'], 
            'cardId' => $row['cardId'],
            'user' => $row['username'], 
            "password" => base64_decode($row["password"]),
            "loginTime" => $row["loginTime"],
            "loginIp" => $row["loginIP"],
        );
    }die(show(1,"信息获取成功",$list));
}
function delMessage($table,$id){
    global $link;
    $sql = "DELETE FROM $table where id = $id"; 
    $result = $link->query($sql);
    die(show(1,"删除成功"));
}
// 
// 
// 
// 
// 
// 
// 
//检测当前登录用户是否为管理员
function checkLogining(bool $ret = false){
    //获取管理员列表
    //和当前登录session比较
    // session_start();
    // if(isset($_SESSION['username']) && $_SESSION['username'] == true){
    //     return true;
    // }else{
    //     return false;
    // }
}
//检测传入参数是否符合要求
function msg_Check($name,$info=''){
    if (isset($name) and !is_array($info)){
    	switch($name){
    		//标题检测
    		case 'title':
    		    empty($info) and die(show(9,'标题不能为空'));
    		    (strlen($info) > 32) and die(show(9,'标题过长'));
    			(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$info)) and die(show(9,'标题中不允许出现特殊字符'));
    			break;
    		case 'number':
    		  //  !is_numeric($info) and die(show(9,'非法操作,已被记录!'));
    		    (preg_match("/[\',:;*?~`!#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$info)) and die(show(9,'非法操作,已被记录!'));
    		    break;
    		default:
    			die(show(9,'未知参数!'));
    			break;
    	}
    }else{
    	die(show(9,'此处无数组绕过,换个地方测吧！'));
    }
}
?> 