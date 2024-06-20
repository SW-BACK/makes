//是否开启DEBUG
var DEBUG = true;
var token;

//DEBUG信息返回
function debugLog(data) {
    if (DEBUG) {
        console.log(data);
    }
    return false;
}
var Popup = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timerProgressBar: true,
    timer: 3000
});
// Popup.fire({icon: 'success',title: "系统运行正常,功能由SwBack提供技术支持",});

function getCookie(name) {
        var cookieName = name + "=";
        var cookieArray = document.cookie.split(';');

        for (var i = 0; i < cookieArray.length; i++) {
            var cookie = cookieArray[i].trim();
            if (cookie.indexOf(cookieName) === 0) {
                return cookie.substring(cookieName.length, cookie.length);
            }
        }

        return null; // 如果找不到指定名称的cookie
    }
function clearCookie(name) {
    setCookie(name, "",-1);
}
//获取答案
function getSubject(){
    
    let subject = $("#subject").val();
    let token = getCookie('token');
    $.ajax({
        url: "ajax.php?k=getSubject&token=" + token,
        dataType: "json",
        async: true,
        type: "post",
        data: {
            'subject': subject,
        },
        success: function(res) {
            if (res.status == 200) {
                var data = res.data;
                
                var main = '';
                for (var i in data) {
                    // debugLog(data[i].subject);
                    var main2 = "<div class='card-header'>"+data[i].type+"</div>"+
                    "<div class='card-body'>"+
                      "<h5 class='card-title'>来自"+data[i].parent+"</h5>"+
                      "<p class='card-text'>"+data[i].subject+"</p>"+
                      "</div>";
                    main += main2;
                }
                $(".subjectNotice").html(main);
                Popup.fire({icon: 'success',title: res.msg});
            }else {
                Popup.fire({icon: 'error',title: res.msg});
            }
        }

    });
}
//检查用户登录情况
function checkLogin() {
    $.ajax({
        url: "/ajax.php?k=checkLogin",
        dataType: "json",
        async: true,
        type: "get",
        success: function(res) {
            // debugLog(res);
            // Popup.fire({icon: 'error',title: res.msg});
            if (res.status == 1) {
                $("#Login").html("<button type='button' class='btn btn-outline-info'  id='page-header-user-dropdown' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>欢迎<strong style='color:red'>"+res.data[0].username+"</strong>,祝你取得一个好成绩<i class='mdi mdi-chevron-down d-none d-xl-inline-block'></i></button><div class='dropdown-menu dropdown-menu-end'>"+
                // "<a class='dropdown-item' href='/personal/personal.php'><i class='ri-user-line align-middle me-1'></i> 个人信息</a>"+
                // "<a class='dropdown-item' href='#'><i class='ri-user-line align-middle me-1'></i> 切换用户</a>"+
                "<div class='dropdown-divider'></div><a class='dropdown-item text-danger' onclick='logout();'><i class='ri-shut-down-line align-middle me-1 text-danger'></i> 退出登录</a></div>");
                $(".username").html();
            } else {
                $("#Login").html("<button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#notice'><font style='vertical-align: inherit;'>登录</font></button>");
            }
        }
    });
}
//退出登录

function logout() {
    Swal.fire({
        type: 'warning', // 弹框类型
        title: '登出账号', //标题
        text: "是否确认登出该账号?", //显示内容            
        confirmButtonColor: '#3085d6',// 确定按钮的 颜色
        confirmButtonText: '确定',// 确定按钮的 文字
        showCancelButton: true, // 是否显示取消按钮
        cancelButtonColor: '#d33', // 取消按钮的 颜色
        cancelButtonText: "取消", // 取消按钮的 文字
        focusCancel: true, // 是否聚焦 取消按钮
        reverseButtons: true  // 是否 反转 两个按钮的位置 默认是  左边 确定  右边 取消
    }).then((isConfirm) => {
        try {
            //判断 是否 点击的 确定按钮
            if (isConfirm.value) {
               $.ajax({
                url: "ajax.php?k=logout",
                dataType: "json",
                async: true,
                type: "get",
                success: function(res) {
                    debugLog(res);
                    if (res.status == 1) {
                        clearCookie("token");
                        $("#Login").html("<button type='button' class='btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#notice'><font style='vertical-align: inherit;'>登录</font></button>");
                    } else {
                        $("#LoginFalse").hide();
                        $("#page-header-user-dropdown").show();
                    }
                }
            });
            }
            else {
                
            }
        } catch (e) {
            alert(e);
        }
    });
    

}
$(document).ready(function() {
    checkLogin();
});

