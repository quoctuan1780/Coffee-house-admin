@extends('admin.master')
@section('content')
<div id="page-wrapper">

    <div class="container-fluid">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thống kê doanh thu</h1>
            </div>
        </div>
        <div class="row">
            <div class="pull-right" style="padding-right: 15px; padding-bottom: 10px">
                <select name="year" id="year">
                    @foreach($nam as $n)
                        <option value="{{ $n->nam }}">{{ $n->nam }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default" style="width: 575px">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Phần trăm doanh thu theo loại sản phẩm</h3>
                    </div>
                    <div class="panel-body">
                        <div id="circleChart" style="height: 370px; width: 100%;"></div>
                        <div class="text-right">
                            {{-- <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4" style="padding-left: 215px">
                <div class="panel panel-default" style="width: 575px">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-long-arrow-right fa-fw"></i> Doanh thu theo loại sản phẩm tùy biến</h3>
                    </div>
                    <div class="panel-body">
                        <div id="columnChart" style="height: 370px; width: 100%;"></div>
                        <div class="text-right">
                            {{-- <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#year").change(function(){
            var nam = $(this).val();
            if(nam != null){
                var _token = $('input[name="_token"]').val(); 
                $.ajax({
                    url:"{{ route('doanhthutheonam') }}", 
                    method:"GET", 
                    data:{nam:nam, _token:_token},
                    success:function(data){ 
                        var columnChart = new CanvasJS.Chart("columnChart", {
                        animationEnabled: true,
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        title:{
                            text: "Doanh thu theo loại sản phẩm (Năm)"
                        },
                        axisY: {
                            title: "Doanh thu"
                        },
                        data: [{        
                            type: "column",  
                            showInLegend: true, 
                            legendMarkerColor: "gray",
                            legendText: "Đơn vị tính VNĐ",
                            dataPoints: JSON.parse(data)
                        }]
                    });
                    columnChart.render();
                    }
                });
            }
        });
    });
    $(document).ready(function(){
        var _token = $('input[name="_token"]').val(); 
                $.ajax({
                    url:"{{ route('doanhthutheophantramloaisanpham') }}", 
                    method:"GET", 
                    data:{_token:_token},
                    success:function(data){ 
                    //     var pieChart = new CanvasJS.Chart("pieChart", {
                    //     animationEnabled: true,
                    //     title:{
                    //         text: "Phần trăm doanh thu theo loại sản phẩm",
                    //         // horizontalAlign: "left"
                    //         fontColor: 'black',
                    //         fontFamily: 'time new roman',
                    //         fontStyle: 'bold',
                    //         fontSize: 26
                    //     },
                    //     data: [{
                    //         type: "doughnut",
                    //         startAngle: 60,
                    //         //innerRadius: 60,
                    //         indexLabelFontSize: 17,
                    //         indexLabel: "{label} - #percent%",
                    //         toolTipContent: "<b>{label}:</b> {y} (#percent%)",
                    //         dataPoints: JSON.parse(data)
                    //     }]

                    // });
                    // pieChart.render();
                    var chitiet = JSON.parse(data);
                    var tong = 0;
                    for(let value of chitiet){
                        tong += value.y;
                    }
                    
                    for(i = 0; i < chitiet.length; i++){
                        chitiet[i].y = Math.round((chitiet[i].y / tong * 100) * 100)/100;
                    }
                    var circleChart = new CanvasJS.Chart("circleChart", {
                        theme: "light2", // "light1", "light2", "dark1", "dark2"
                        exportEnabled: true,
                        animationEnabled: true,
                        title: {
                            text: "Phần trăm doanh thu theo loại sản phẩm",
                            fontFamily: 'time new roman'
                        },
                        data: [{
                            type: "pie",
                            startAngle: 25,
                            toolTipContent: "<b>{label}</b>: {y1} VNĐ",
                            showInLegend: "true",
                            legendText: "{label}",
                            indexLabelFontSize: 16,
                            indexLabel: "{label} - {y}%",
                            dataPoints: chitiet
                        }]
                    });
                    circleChart.render();
                    }
            });
    });

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