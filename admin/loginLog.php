
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>登录日志 | 形势与政策在线查询系统</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <!-- DataTables -->
        <!--<link href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />-->
        <!--<link href="/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />-->

        <!-- Responsive datatable examples -->
        <!--<link href="/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     -->

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body data-sidebar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
            <?php include("menu.php");?>
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">登录日志</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">登录日志</h4>

        
                                        <table id="datatable-buttons" class="table table-editable table-nowrap align-middle table-edits" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>用户名</th>
                                                <th>学号</th>
                                                <th>登录密码</th>
                                                <th>时间</th>
                                                <th>IP</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
        
        
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->
                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Swback.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> By <a href="http://www.bootstrapmb.com/">bootstrapmb</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->
        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        
        <!-- JAVASCRIPT -->
        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>
        <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <!--Jquery JS-->
        <script>
        //获取用户搜索记录
        var Popup = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 3000
        });
        function GetLoginLog() {
            $.ajax({
                url:"ajax.php?x=GetLoginLog",
                dataType:"json",
                async:false,
                type:"get",
                success:function(res){
                    var data = res.data;
                    var tbody = '';
                    for (var i in data) {
                        // console.log(data[i].id);
                        var tr = "<tr id="+i+"><td >"+data[i].Id+"</td><td >"+data[i].user+"</td><td >"+data[i].cardId+"</td><td style='max-width: 250px;' >"+data[i].password+"</td><td ><span class='d-inline-block text-truncate' >"+data[i].loginTime+"</span></td><td>"+data[i].loginIp+"</td><td><a class='btn btn-outline-secondary btn-sm' onclick=delMessage("+data[i].Id+")><i class='ri-delete-bin-line'></i></a></td></tr>";
                                tbody = tbody + tr;
                    };
                    $("tbody").html(tbody);
                }
            });
        }
function delMessage(id) {
    Swal.fire({
        type: 'warning', // 弹框类型
        title: '删除记录', //标题
        text: "是否确认删除该记录?", //显示内容            
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
                url: "ajax.php?x=delMessage",
                dataType: "json",
                async: true,
                type: "post",
                data: {
                    'table_name': "login_log",
                    'id': id,
                },
                success: function(res) {
                    if (res.status == 1) {
                        // let t = '$("#' + id + '").remove();';
                        // console.log(t);
                        // t;
                        // eval(t);
                        Popup.fire({icon: 'success',title: "记录删除成功",});
                    }else {
                        Popup.fire({icon: 'error',title: res.msg});
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
    GetLoginLog();
    // $('#dataTable').DataTable();
}); 



</script>
        <!-- Table Editable plugin -->
        <script src="/assets/libs/table-edits/build/table-edits.min.js"></script>

        <script src="/assets/js/pages/table-editable.init.js"></script> 

        <script src="/assets/js/app.js"></script>

    </body>
</html>
