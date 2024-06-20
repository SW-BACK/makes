
<!DOCTYPE html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>首页 | 形势与政策在线查询系统后台管理</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
         App favicon 
        <link rel="shortcut icon" href="/assets/images/favicon.ico">
        
        <!-- jvectormap -->
        <link href="/assets/libs/jqvmap/jqvmap.min.css" rel="stylesheet" />

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
                                    <h4 class="mb-sm-0">仪表盘</h4>
                                    <a href="./userList.php">用户列表</A>
                                    <a href="./subList.php">答题记录</A>
                                    <a href="./loginLog.php">登录记录</A>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Upzet</a></li>
                                            <li class="breadcrumb-item active">仪表盘</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex text-muted">
                                            <div class="flex-shrink-0 me-3 align-self-center">
                                                <div id="radialchart-1" class="apex-charts" dir="ltr"></div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">系统时间</p>
                                                <h5 class="mb-3"><?php echo date('Y-m-d h:i', time());?></h5>
                                               
                                            </div>
                                        </div>
                                    </div>
                                     <!--end card-body -->
                                </div>
                                 <!--end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3 align-self-center">
                                                <div id="radialchart-2" class="apex-charts" dir="ltr"></div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">答题率</p>
                                                <h5 class="mb-3">50</h5>
                                                <!--<p class="text-truncate mb-0"><span class="text-success me-2"> 1.7% <i class="ri-arrow-right-up-line align-bottom ms-1"></i></span> From previous</p>-->
                                            </div>
                                        </div>
                                    </div>
                                     <!--end card-body -->
                                </div>
                                 <!--end card -->
                            </div>
                            <!-- end col -->

                   
                             
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex text-muted">
                                            <div class="flex-shrink-0  me-3 align-self-center">
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                        <i class="ri-group-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">用户数量</p>
                                                <h5 class="mb-3">83</h5>
                                                <!--<p class="text-truncate mb-0"><span class="text-success me-2"> 0.01% <i class="ri-arrow-right-up-line align-bottom ms-1"></i></span> From previous</p>-->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex text-muted">
                                            <div class="flex-shrink-0  me-3 align-self-center">
                                                <div class="avatar-sm">
                                                    <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                        <i class="ri-group-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">在线用户</p>
                                                <h5 class="mb-3">23</h5>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title">Overview</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        ALL
                                                    </button>
                                                    <button type="button" class="btn btn-soft-primary btn-sm">
                                                        1M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm">
                                                        6M
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm active">
                                                        1Y
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div id="mixed-chart" class="apex-charts" dir="ltr"></div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->

                                    <div class="card-body border-top">
                                        <div class="text-muted text-center">
                                            <div class="row">
                                                <div class="col-4 border-end">
                                                    <div>
                                                        <p class="mb-2"><i class="mdi mdi-circle font-size-12 text-primary me-1"></i> Expenses</p>
                                                        <h5 class="font-size-16 mb-0">$ 8,524 <span class="text-success font-size-12"><i class="mdi mdi-menu-up font-size-14 me-1"></i>1.2 %</span></h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 border-end">
                                                    <div>
                                                        <p class="mb-2"><i class="mdi mdi-circle font-size-12 text-light me-1"></i> Maintenance</p>
                                                        <h5 class="font-size-16 mb-0">$ 8,524 <span class="text-success font-size-12"><i class="mdi mdi-menu-up font-size-14 me-1"></i>2.0 %</span></h5>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div>
                                                        <p class="mb-2"><i class="mdi mdi-circle font-size-12 text-danger me-1"></i> Profit</p>
                                                        <h5 class="font-size-16 mb-0">$ 8,524 <span class="text-success font-size-12"><i class="mdi mdi-menu-up font-size-14 me-1"></i>0.4 %</span></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex  align-items-center">
                                            <div class="flex-grow-1">
                                                <h5 class="card-title">得分数据</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <select class="form-select form-select-sm mb-0 my-n1">
                                                    <option value="MAY" selected="">May</option>
                                                    <option value="AP">April</option>
                                                    <option value="MA">March</option>
                                                    <option value="FE">February</option>
                                                    <option value="JA">January</option>
                                                    <option value="DE">December</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div>
                                            <div id="radialBar-chart" class="apex-charts" dir="ltr"></div>
                                        </div>

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="social-source text-center mt-3">
                                                    <div class="avatar-xs mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle bg-primary font-size-18">
                                                            <i class="ri  ri-facebook-circle-fill text-white"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-15">Facebook</h5>
                                                    <p class="text-muted mb-0">125 sales</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="social-source text-center mt-3">
                                                    <div class="avatar-xs mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle bg-info font-size-18">
                                                            <i class="ri  ri-twitter-fill text-white"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-15">Twitter</h5>
                                                    <p class="text-muted mb-0">112 sales</p>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="social-source text-center mt-3">
                                                    <div class="avatar-xs mx-auto mb-3">
                                                        <span class="avatar-title rounded-circle bg-danger font-size-18">
                                                            <i class="ri ri-instagram-line text-white"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="font-size-15">Instagram</h5>
                                                    <p class="text-muted mb-0">104 sales</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">登录日志</h4>

                                        <div class="table-responsive">
                                            <table class="table table-centered table-nowrap mb-0">
                                                <thead>
                                                    <tr>
                                                         <th>Id</th>
                                                        <th>用户名</th>
                                                        <th>学号</th>
                                                        <th>登录密码</th>
                                                        <th>搜索内容</th>
                                                        <th>时间</th>
                                                        <th>IP</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- end card-body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->
                        
                    </div>
                    <!-- container-fluid -->
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
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> By <a href="http://www.swback.cn/">Swback</a>
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

        <!-- apexcharts js -->
        <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>

        <!-- jquery.vectormap map -->
        <script src="/assets/libs/jqvmap/jquery.vmap.min.js"></script>
        <script src="/assets/libs/jqvmap/maps/jquery.vmap.usa.js"></script>

        <script src="/assets/js/pages/dashboard.init.js"></script>
        <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script src="/assets/js/app.js"></script>
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
    </body>
</html>
