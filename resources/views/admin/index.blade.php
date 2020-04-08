@extends('admin.master')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
{{-- 
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
                </div>
            </div>
        </div>
        <!-- /.row --> --}}

        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ count($phanhoimoi) }}</div>
                                <div>Phản hồi mới</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('phan-hoi-moi') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ count($dkntmoi) }}</div>
                                <div>Đăng kí nhận tin mới</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dang-ki-nhan-tin-moi') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ count($donhangmoi) }}</div>
                                <div>Đơn hàng mới!</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('don-hang-moi') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Xem chi tiết</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">13</div>
                                <div>Support Tickets!</div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->

        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Area Chart</h3>
                    </div>
                    <div class="panel-body">
                        <div id="morris-area-chart"></div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- /.row -->

        {{-- <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default" style="width: 575px">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Phần trăm doanh thu theo loại sản phẩm</h3>
                    </div>
                    <div class="panel-body">
                        <div id="circleChart" style="height: 370px; width: 100%;"></div>
                        <div class="text-right">
                            <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default" style="width: 1180px;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Doanh thu theo sản phẩm</h3>
                        </div>
                        <div class="panel-body">
                            <div id="barChart" style="height: 380px; width: 100%;"></div>
                            <div class="text-right">
                                {{-- <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        {{-- <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Tasks Panel</h3>
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            <a href="#" class="list-group-item">
                                <span class="badge">just now</span>
                                <i class="fa fa-fw fa-calendar"></i> Calendar updated
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">4 minutes ago</span>
                                <i class="fa fa-fw fa-comment"></i> Commented on a post
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">23 minutes ago</span>
                                <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">46 minutes ago</span>
                                <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">1 hour ago</span>
                                <i class="fa fa-fw fa-user"></i> A new user has been added
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">2 hours ago</span>
                                <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">yesterday</span>
                                <i class="fa fa-fw fa-globe"></i> Saved the world
                            </a>
                            <a href="#" class="list-group-item">
                                <span class="badge">two days ago</span>
                                <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                            </a>
                        </div>
                        <div class="text-right">
                            <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Order Date</th>
                                        <th>Order Time</th>
                                        <th>Amount (USD)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>3326</td>
                                        <td>10/21/2013</td>
                                        <td>3:29 PM</td>
                                        <td>$321.33</td>
                                    </tr>
                                    <tr>
                                        <td>3325</td>
                                        <td>10/21/2013</td>
                                        <td>3:20 PM</td>
                                        <td>$234.34</td>
                                    </tr>
                                    <tr>
                                        <td>3324</td>
                                        <td>10/21/2013</td>
                                        <td>3:03 PM</td>
                                        <td>$724.17</td>
                                    </tr>
                                    <tr>
                                        <td>3323</td>
                                        <td>10/21/2013</td>
                                        <td>3:00 PM</td>
                                        <td>$23.71</td>
                                    </tr>
                                    <tr>
                                        <td>3322</td>
                                        <td>10/21/2013</td>
                                        <td>2:49 PM</td>
                                        <td>$8345.23</td>
                                    </tr>
                                    <tr>
                                        <td>3321</td>
                                        <td>10/21/2013</td>
                                        <td>2:23 PM</td>
                                        <td>$245.12</td>
                                    </tr>
                                    <tr>
                                        <td>3320</td>
                                        <td>10/21/2013</td>
                                        <td>2:15 PM</td>
                                        <td>$5663.54</td>
                                    </tr>
                                    <tr>
                                        <td>3319</td>
                                        <td>10/21/2013</td>
                                        <td>2:13 PM</td>
                                        <td>$943.45</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-right">
                            <a href="#">View All Transactions <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div> --}}

        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

@endsection

@section('script')
<script>

    // $(document).ready(function(){
    //     var _token = $('input[name="_token"]').val(); 
    //             $.ajax({
    //                 url:"{{ route('doanhthutheophantramloaisanpham') }}", 
    //                 method:"GET", 
    //                 data:{_token:_token},
    //                 success:function(data){ 
    //                 //     var pieChart = new CanvasJS.Chart("pieChart", {
    //                 //     animationEnabled: true,
    //                 //     title:{
    //                 //         text: "Phần trăm doanh thu theo loại sản phẩm",
    //                 //         // horizontalAlign: "left"
    //                 //         fontColor: 'black',
    //                 //         fontFamily: 'time new roman',
    //                 //         fontStyle: 'bold',
    //                 //         fontSize: 26
    //                 //     },
    //                 //     data: [{
    //                 //         type: "doughnut",
    //                 //         startAngle: 60,
    //                 //         //innerRadius: 60,
    //                 //         indexLabelFontSize: 17,
    //                 //         indexLabel: "{label} - #percent%",
    //                 //         toolTipContent: "<b>{label}:</b> {y} (#percent%)",
    //                 //         dataPoints: JSON.parse(data)
    //                 //     }]

    //                 // });
    //                 // pieChart.render();
    //                 var chitiet = JSON.parse(data);
    //                 var tong = 0;
    //                 for(let value of chitiet){
    //                     tong += value.y;
    //                 }
                    
    //                 for(i = 0; i < chitiet.length; i++){
    //                     chitiet[i].y = Math.round((chitiet[i].y / tong * 100) * 100)/100;
    //                 }
    //                 var circleChart = new CanvasJS.Chart("circleChart", {
    //                     theme: "light2", // "light1", "light2", "dark1", "dark2"
    //                     exportEnabled: true,
    //                     animationEnabled: true,
    //                     title: {
    //                         text: "Phần trăm doanh thu theo loại sản phẩm",
    //                         fontFamily: 'time new roman'
    //                     },
    //                     data: [{
    //                         type: "pie",
    //                         startAngle: 25,
    //                         toolTipContent: "<b>{label}</b>: {y1} VNĐ",
    //                         showInLegend: "true",
    //                         legendText: "{label}",
    //                         indexLabelFontSize: 16,
    //                         indexLabel: "{label} - {y}%",
    //                         dataPoints: chitiet
    //                     }]
    //                 });
    //                 circleChart.render();
    //                 }
    //         });
    // });

    $(document).ready(function(){
        var _token = $('input[name="_token"]').val(); 
            $.ajax({
                url:"{{ route('doanhthutheosanpham') }}", 
                method:"GET", 
                data:{_token:_token},
                success:function(data){ 
                    chitiet = data;
                    var barChart = new CanvasJS.Chart("barChart", {
                    animationEnabled: true,
                    
                    title:{
                        text:"Doanh thu theo sản phẩm",
                        fontColor: 'black',
                        fontFamily: 'time new roman',
                        fontStyle: 'bold',
                        fontSize: 26
                    },
                    axisX:{
                        interval: 1
                    },
                    axisY2:{
                        interlacedColor: "rgba(1,77,101,.2)",
                        gridColor: "rgba(1,77,101,.1)",
                        title: "Đơn vị tính: VNĐ"
                    },
                    data: [{
                        type: "bar",
                        name: "companies",
                        axisYType: "secondary",
                        color: "#014D65",
                        dataPoints: JSON.parse(data)
                    }]
                });
                barChart.render();
                }
            });
        });
    </script>
@endsection