
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>答题记录 | 形势与政策在线查询系统</title>
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
                                    <h4 class="mb-sm-0">答题记录</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">答题记录</h4>

        
                                        <table id="datatable-buttons" class="table table-editable table-nowrap align-middle table-edits" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>用户名</th>
                                                <th>ip</th>
                                                <th>搜索内容</th>
                                                <th>时间</th>
                                                <th>编辑</th>
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

        <!--Jquery JS-->
        <script>
        //获取用户搜索记录
        function getSubList() {
            $.ajax({
                url:"ajax.php?x=GetSubList",
                dataType:"json",
                async:false,
                type:"get",
                success:function(res){
                    var data = res.data;
                    var tbody = '';
                    for (var i in data) {
                        // console.log(data[i].id);
                        var tr = "<tr id="+i+"><td >"+data[i].Id+"</td><td >"+data[i].user+"</td><td >"+data[i].ip+"</td><td ><span class='d-inline-block text-truncate' style='max-width: 250px;'>"+data[i].key+"</span></td><td>"+data[i].time+"</td><td><a class='btn btn-outline-secondary btn-sm edit' title='Edit'><i class='fas fa-pencil-alt'></i></a></td></tr>";
                                tbody = tbody + tr;
                    };
                    $("tbody").html(tbody);
                }
            });
        }
        $(document).ready(function() {
            getSubList();
            // $('#dataTable').DataTable();
        }); 
        </script>
        <!-- Table Editable plugin -->
        <script src="/assets/libs/table-edits/build/table-edits.min.js"></script>

        <script src="/assets/js/pages/table-editable.init.js"></script> 

        <script src="/assets/js/app.js"></script>

    </body>
</html>
