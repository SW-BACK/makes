// ==UserScript==
// @name         形势与政策-自动匹配答案
// @namespace    http://tampermonkey.net/
// @version      2.0
// @description  南京工业职业技术大学
// @author       swback
// @match        http://10.1.1.203/*
// @match        http://10.1.1.204/*
// @match        http://10.1.1.240/*
// @icon         https://www.google.com/s2/favicons?sz=64&domain=1.203
// @require      https://lib.baomitu.com/jquery/3.6.0/jquery.min.js
// @require      https://unpkg.com/sweetalert2@10.16.6/dist/sweetalert2.all.min.js
// @require       https://cdn.staticfile.org/jquery-cookie/1.4.1/jquery.cookie.min.js
// @license      MIT
// ==/UserScript==

(function() {
    'use strict';
        let toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

    const message = {
        success: (text) => {
            toast.fire({title: text, icon: 'success'});
        },
        error: (text) => {
            toast.fire({title: text, icon: 'error'});
        },
        warning: (text) => {
            toast.fire({title: text, icon: 'warning'});
        },
        info: (text) => {
            toast.fire({title: text, icon: 'info'});
        },
        question: (text) => {
            toast.fire({title: text, icon: 'question'});
        }
    };
    var apiUrl = "http://makes.swback.cn/ajax.php";
    let base = {

        isType(obj) {
            return Object.prototype.toString.call(obj).replace(/^\[object (.+)\]$/, '$1').toLowerCase();
        },

        getValue(name) {
            return GM_getValue(name);
        },

        setValue(name, value) {
            GM_setValue(name, value);
        },
    }
// 定义一个函数来创建可拖动的悬浮框
    function createDraggableFloatingBox() {
        // 创建悬浮框元素
        const floatingBox = document.createElement('div');
        floatingBox.style.position = 'fixed';
        floatingBox.style.top = '50px';
        floatingBox.style.left = '0px';
        floatingBox.style.width = '300px';
        floatingBox.style.height = '500px';
        floatingBox.style.backgroundColor = '#3498db';
        floatingBox.style.color = '#ffffff';
        floatingBox.style.cursor = 'pointer';
        floatingBox.style.userSelect = 'none';
        floatingBox.innerHTML  = '<div class="ui-datagrid-header ui-widget-header ui-corner-top" type="button" id="sendRequest" >获取答案</div><div id="Tip"></div></div><div id="PanDuan"></div>';

        document.body.appendChild(floatingBox);

        // 可拖动逻辑
        let isDragging = false;
        let offsetX, offsetY;

        floatingBox.addEventListener('mousedown', function (e) {
            isDragging = true;
            offsetX = e.clientX - floatingBox.getBoundingClientRect().left;
            offsetY = e.clientY - floatingBox.getBoundingClientRect().top;
        });

        document.addEventListener('mousemove', function (e) {
            if (!isDragging) return;

            const x = e.clientX - offsetX;
            const y = e.clientY - offsetY;

            floatingBox.style.left = x + 'px';
            floatingBox.style.top = y + 'px';
        });

        document.addEventListener('mouseup', function () {
            isDragging = false;
        });
    }

    // 调用函数来创建悬浮框
    createDraggableFloatingBox();


    // 首先，选择所有包含 'reply(' 的 `onclick` 属性的元素
    const elementsWithReply = document.querySelectorAll('[onclick^="reply("]');

    // 初始化一个空数组来存储题目id
    const replyValues = [];

    // 循环遍历选定的元素并从 `reply()` 调用中提取值
    elementsWithReply.forEach(element => {
        // 获取 `onclick` 属性的内容
        const onclickValue = element.getAttribute('onclick');

        // 使用正则表达式提取 `reply()` 函数中的值
        const match = /reply\(['"]#([^'"]+)['"]\)/.exec(onclickValue);

        if (match && match[1]) {
            replyValues.push(match[1]);
        }
    });

    // 创建一个空数组来存储匹配的内容
    const matchedContents = [];

    // 循环遍历`replyValues`数组中的值
    replyValues.forEach(value => {
        // 通过value查找匹配的a标签
        const matchingAnchor = document.querySelector(`a[id*="${value}"]`);

        if (matchingAnchor) {
            // 找到匹配的a标签后，获取它后面的第一个span的内容
            const spanContent = matchingAnchor.nextElementSibling.textContent.trim();
            matchedContents.push(spanContent);
        }
    });

    // 创建一个新数组来存储 处理过的题目
    var extractedCharacters = [];

    // 遍历 matchedContents 数组
    for (var i = 0; i < matchedContents.length; i++) {
        var str = matchedContents[i];

        // 提取第二个字符到第四个字符
        if (str.length >= 4) {
            var extracted = str.substring(2, 1000); // 1 是第二个字符的索引，4 是结束索引（不包含第四个字符）
            extractedCharacters.push(extracted);
        }
    }


    function getAns(subject,id,replyValues){
        var token = $.cookie('token');
    // 发送POST请求
        $.ajax({
            type: "POST",
            url: apiUrl+"?k=getSubject&token="+ token,  // 替换为你的API端点
            dataType: "json",
            async: false,
            type: "post",
            data: {
                'subject': subject,
            },
            success: function (res) {
                if (res.status == 200){
                    var data = res.data[0].subject;
                    var type = res.data[0].type;
                    // 使用正则表达式来提取 "正确答案: B" 部分
                    var match = data.match(/正确答案: ([A-G]+|true|false)/);
                    //输出 Array [ "正确答案: false", "false" ]
                    if (match) {
                        // 替换 "true" 为 "T"，"false" 为 "F"
                        var answer = match[1];
                        if (answer === "true") {
                                answer = "T";
                            } else if (answer === "false") {
                                answer = "F";
                            }

                        if((id -1 ) % 5 === 0 ){
                            $("#PanDuan").append("<br>");
                        }
                        //控制台输出内容
                        console.log("===题目"+id+"===");
                        console.log(type);
                        console.log(subject);
                        console.log(answer);

                        //格式化渲染到页面
                         $("#PanDuan").append('<td class="ui-datagrid-column"><a href="#'+replyValues[id]+'">'+
                                    '<span  class="dialB" style="width:50px;font-size: 12px;">'+answer+'</span></a></td>');

                        //if(type == "单选题" || type == "判断题"){
                        //    $("#PanDuan").append(answer);
                        //}else{
                        //    $("#PanDuan").append(answer + " | ");
                        //}
                    } else {
                        $("#Tip").append("未找到正确答案题号:" + id);
                        $("#PanDuan").append("*");
                        console.log("未找到正确答案题号:" + id);
                    }

                }else{
                    alert("<题目"+id+">" + res.msg);
                    $("#Tip").append("未找到正确答案题号:" + id);
                    $("#PanDuan").append('<td class="ui-datagrid-column"><a href="#'+replyValues[i]+'">'+
                                    '<span  class="dialB" style="width:60px">*</span></a></td>');
                    console.log("<题目"+id+">" + res.msg);
                }


            },
            error: function (xhr, status, error) {
                // 请求失败的处理
                console.log("失败：", status, error);
            }
        });
    }
    console.log(extractedCharacters);
    var token = $.cookie('token');
    message.success("TOKEN"+token);
    message.success("* 代表当前题目未匹配到,请手动选择");

    $(document).ready(function () {
            $("#sendRequest").click(function () {
                //console.log(token);
                if($.cookie('token') != null){
                    $("#PanDuan").append("<hr>");
                    for(var i = 0;i< extractedCharacters.length;i++){
                        getAns(extractedCharacters[i],i+1,replyValues);
                    }
                    $("#PanDuan").append("<hr>");
                }else{
                    //登录，获取token
                    Swal.fire({
                        title: '登录获取token',
                        html:
                        '<input id="username" class="swal2-input" autofocus placeholder="输入学号">' +
                        '<input id="password" class="swal2-input" type="password" placeholder="输入身份证后六位 X用9代替">',
                        preConfirm: function() {
                            return new Promise(function(resolve) {
                                $.ajax({
                                        url: apiUrl+"?k=login",
                                        dataType: "json",
                                        async: true,
                                        type: "post",
                                        data: {
                                            'username': $('#username').val(),
                                            'password': $('#password').val(),
                                            'yzm': '1234',
                                        },
                                        success: function(res) {
                                             if(res.status == 1){
                                                message.success(res.msg);
                                                $.cookie('token', res.data);
                                            }else{
                                                message.error(res.msg);
                                            }
                                        }
                                    });
                            });
                        }
                    })

                }
            });
        });


})();
