@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách hóa đơn</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div id="Hienthi">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th style="width: 30px">ID</th>
                        <th>Khách hàng</th>
                        <th>Ngày thanh toán</th>
                        <th>Tổng tiền</th>
                        <th>Hình thức thanh toán</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($hoadon as $hd)
                            <tr class="odd gradeX" style="text-align: center">
                                <td><a href="javascrip:void(0)" id="{{ $hd->mahd }}" class="{{ $hd->mahd }}" onclick="showContent(document.getElementById({{ $hd->mahd }}))">{{ $hd->mahd }}</a></td>
                                @foreach($khachhang as $kh)
                                    @if($hd->makh == $kh->makh)
                                        <td>{{ $kh->hoten }}</td>
                                        @break
                                    @endif
                                @endforeach
                                <td>{{ $hd->ngaythanhtoan }}</td>
                                <td>{{ $hd->tongtien }} VND</td>
                                <td>{{ $hd->httt }}</td>
     
                            </tr>
                        @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <!-- /.row -->  
    </div>
    <!-- /.container-fluid -->
</div>
<div id="hienthi_cthd"></div>
@endsection

@section('script')
    <script>
        function showContent(id){
            var mahd = id.className;
                $.ajax({
                    url:"{{ route('chitiethoadonAjax') }}",
                    method:"GET",
                    data:{mahd:mahd},
                    success:function(data){
                        $("#hienthi_cthd").fadeOut();
                        $("#hienthi_cthd").fadeIn();
                        $("#hienthi_cthd").html(data);
                    }
                });
        }
    </script>
@endsection 
