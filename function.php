<?php
require_once './config.php';
header("Access-Control-Allow-Origin: http://10.1.1.203");

function getSubject($body,$token) {
    session_start();
    //如果不存在token,则登录 存在token,跳过登录验证
   
    // 检测是否登录
    if(!isset($token)){
        checkLogining();
    }
    if(!getToken($token)){
        die(show(400,"token验证错误"));
    }
    
    // 检测是否为空
    if ($body == "") {
        die(show(400, "Error: 题目不能为空"));
    }
    
    $body = addslashes($body);
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $ip = getRealIp();
    $device = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];
    if(isset($token)){
        $user = getTokenUser($token);
    }else{
        $user = $_SESSION['username'];
    }
    saveLog($userAgent, $device, $user, $ip, $body);

    global $link;

    // 执行SQL查询（不使用预编译）
    $query = "SELECT * FROM `analyze` WHERE subject LIKE '%$body%'";
    $result = mysqli_query($link, $query);

    if (!$result) {
        die(show(500, "数据库查询错误: " . mysqli_error($link)));
    }

    $list = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = array(
            'subject' => $row['subject'],
            'type' => $row['type'],
            "parent" => "swback",
        );
    }

    if (empty($list)) {
        die(show(404, "未找到匹配的题目"));
    } else {
        die(show(200, "题目查询成功", $list));
    }
}
// getToken($token);
function getTokenUser($token){
    global $link;
    $token = mysqli_real_escape_string($link,trim($token));

    $sql = "select * from user where token = '{$token}'";
    // echo $sql;
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        $row=mysqli_fetch_array($result);
        $username = $row['nickname'];
        return $username;
    }
}
function getToken($token){
    global $link;
    $token = mysqli_real_escape_string($link,trim($token));

    $sql = "select * from user where token = '{$token}'";
    // echo $sql;
    $result = $link->query($sql);
    if ($result->num_rows > 0) {
        // echo '1';
        return true;
    }
    // echo '2';
    return false;
}

// function getSubject($body){
//     // 在这个位置判断$body是否为空.是否存在sql注入
//     //检测是否登录
//     checkLogining();
//     session_start();
//     $body = addslashes($body);
//     $userAgent = $_SERVER['HTTP_USER_AGENT'];
//     $ip = getRealIp();
//     $device = $_SERVER['HTTP_SEC_CH_UA_PLATFORM'];
//     $user = $_SESSION['username'];
//     saveLog($userAgent,$device,$user,$ip,$body);
//     global $link;
//     $sql = "SELECT * FROM analyze WHERE subject like '%$body%';"; 

//     $result = mysqli_query($link,$sql); 
//     while($row=mysqli_fetch_array($result)){ 
//         $list[] = array( 
//               'subject' => $row['subject'], 
//               'type' => $row['type'], 
//               "parent" => "swback",
//           );
//       }
//       die(show(200,"题目查询成功",$list));
//     }



function saveLog($userAgent,$device,$user,$ip,$body){
    $time = date("Y-m-d H:i:s",time());
    
    $userAgent = addslashes($userAgent);
    global $link;
    $sql = "INSERT into analyze_log(`user-agent`,`device`,`user`,`ip`,`key`,`time`) values('{$userAgent}','{$device}','{$user}','{$ip}','{$body}','{$time}')";
    $result = $link->query($sql);
}
/**
 * 获取客户端IP
 * @return [type] 返回IP地址信息
 */


function getRealIp(){
    static $realip;

    if (isset($_SERVER)) {
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $realip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            $realip = $_SERVER["REMOTE_ADDR"];
        }
    } else {
        if (getenv("HTTP_X_FORWARDED_FOR")) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("HTTP_CLIENT_IP")) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else {
            $realip = getenv("REMOTE_ADDR");
        }
    }

    if (strpos($realip, ',') === false) {
        $sUserIp = $realip;
    } else {
        $arrUserIp = explode(',', $realip);
        $sUserIp = $arrUserIp[0];
    }
    return $sUserIp;
}
//用户登录状态
function checkLogin(){
    
    session_start();
    if(($_SESSION['username']) == TRUE){
        $list[] = array( 
            'username' => $_SESSION['username'], 
            "images" => $_SESSION['images'],
            "token" => $_SESSION['token']
        );
        die(show(1,"登录成功",$list));
    }
    die(show(0,"请登录后再进行操作！"));
}
function checkLogining(bool $ret = false){
    session_start();
    if(isset($_SESSION['username']) && $_SESSION['username'] == true){
        return true;
    }else{
        die(show(0,'请登录后再进行操作!'));
    }
}
/**
 * 保存用户登录日志
 * @return [type] 返回空
 */


function saveLoginLog($username,$password){
    $time = date("Y-m-d H:i:s",time());
    $password = base64_encode($password);
    $ip = getRealIp();
    global $link;
    $sql = "INSERT INTO `login_log`(`username`, `password`, `loginTime`, `loginIP`) VALUES ('{$username}', '{$password}', '{$time}', '{$ip}');";
    // echo $sql;
    $result = $link->query($sql);
}


function userLogin($user,$password,$yzm){
    
    global $link;
    $username = mysqli_real_escape_string($link,trim($user));
    session_start();
    if($username == 'admin'){
        $password = md5($_POST['password']);
        $yzm = strtolower($yzm);
        // die(show(2,"禁止管理员登录"));
    }else{
        verifyPassword($password);
        $password = md5("swback");
    }
    $_SESSION['captcha'] = "1234";
    if ($yzm == $_SESSION['captcha']) {
        unset($_SESSION['captcha']);
        $sql ="select * from user where username='{$username}' and password='{$password}'";
        // echo $sql;
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            $row=mysqli_fetch_array($result);
            $_SESSION['username'] = $row['nickname'];
            $_SESSION['token'] = $row['token'];
            saveLoginLog($row['nickname'],$_POST['password']);
            die(show(1,"登录成功",$_SESSION['token']));
        }die(show(0,"用户名或密码错误"));
    }
    die(show(2,"验证码错误"));
}
function verifyPassword($password){
	//$password = (int)$password;
    if(strlen($password) != 6){
		die(show(0,'密码长度校验失败!'));
    }
	$day = substr($password,0,2);
	$num = substr($password,2);
	
	
    if ( 31 < $day or $day <= 0){
        // echo $day;
		die(show(0,'密码格式失败!'));
	}
	if ( 9999 <= $num or $num <= 0000){
		die(show(0,'密码格式失败!'));
	}
	return true;
}

//注销用户
function logout(){
    session_start();
    $_SESSION= array();
    die(show(1,"退出成功"));
}
?>