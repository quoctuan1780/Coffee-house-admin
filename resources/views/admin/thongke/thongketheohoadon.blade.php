@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thống kê doanh thu theo hóa đơn</h1>
            </div>
        </div>
        <div class="form-group">
            <select class="form-control" id="sel1">
              <option value="0" selected>Chọn loại thống kê</option>
              <option value="1">Theo ngày</option>
              <option value="2">Theo tháng</option>
              <option value="3">Theo năm</option>
            </select>
        </div>
        <div id="hienthichonngay">
        </div>
        <br>
        <div id="hienthithongke">
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#sel1").change(function(){
                var value = $(this).val();
                if(value == 1){
                    var text = 'Chọn ngày: <input type="date" id="batdau" style="border-radius: 10px; height: 30px" required><input type="button" class="btn btn-primary" onclick="getData()" id="tk" value="Thống Kê">';
                    $("#hienthichonngay").fadeOut();
                    $("#hienthichonngay").fadeIn();
                    $("#hienthichonngay").html(text);
                }
                else if (value != 0){
                    var text = 'Bắt đầu: <input type="date" id="batdau" style="border-radius: 10px; height: 30px" required>Kết thúc: <input type="date" id="ketthuc" style="border-radius: 10px; height: 30px" required><input type="button" class="btn btn-primary" id="tk" onclick="getData()" value="Thống Kê">';
                    $("#hienthichonngay").fadeOut();
                    $("#hienthichonngay").fadeIn();
                    $("#hienthichonngay").html(text);
                }
                else {
                    $("#hienthichonngay").fadeOut();
                    $("#hienthithongke").fadeOut();
                }
            });
        });
        function getData(){
            value = document.getElementById('sel1').value;
            var data;
            if(value == 1) data = document.getElementById('batdau').value;
            else data = {
                batdau: document.getElementById('batdau').value,
                ketthuc: document.getElementById('ketthuc').value
            };
            $.ajax({
                url: "{{ route('doanhthutheohoadonAjax') }}",
                method: "GET",
                data:{date:data,value:value},
                success:function(data, hoadon){
                    $('#hienthithongke').fadeOut();
                    $('#hienthithongke').fadeIn();
                    $('#hienthithongke').html(data);
                }
            })
        }
    </script>
@endsection