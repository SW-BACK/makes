<?php
//定义数据库常量
define( 'DB_NAME', 'makes' );
define( 'DB_USER', 'makes' );
define('DB_PASSWD', 'A6ajYczAtJjeK2Sc'); // 5 
// define('DB_PASSWD', '123456'); 8
define( 'DB_HOST', 'localhost' );
define( 'DB_CHARSET', 'utf8mb4' );
date_default_timezone_set("Asia/Shanghai");
define('SQL_ERROR','语法错误');
define('DB_CONNECT_ERROR','数据库连接错误');
//信息锁 false 返回信息为return true则是die
 $lock = true; //不得修改,否则会引起代码冲突,返回信息混乱
//统一返回信息
function show($status,$msg='',$data=[]) {
    $result = [
        'status'=>intval($status),
        'msg'=>$msg
    ];
    if(!empty($data)|| $data == 0){
        $result['data'] = $data;
    }
    return json_encode($result) ;
}
//连接mysql
$link = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWD) or die(show(404,DB_CONNECT_ERROR)); 
// 选择数据库
mysqli_select_db($link,DB_NAME);
// 编码设置
mysqli_set_charset($link,'utf8');

?>