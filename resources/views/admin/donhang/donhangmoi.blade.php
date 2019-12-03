@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đơn hàng mới</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div>Trạng thái thanh toán
            <select name="trangthaithanhtoan" id="trangthaithanhtoan" class="input-sm">
                <option value="0">Chưa thanh toán</option>
                <option value="1">Đã thanh toán</option>
            </select>
            <div>
                <br>
            </div>
            </div>
            <div id="Hienthi">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th style="width: 30px">ID</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Hình thức thanh toán</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Lời nhắn</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($donhangmoi as $dh)
                            <tr class="odd gradeX" style="text-align: center">
                                <td><a href="{{ route('chi-tiet-don-hang', $dh->madh) }}" >{{ $dh->madh }}</a></td>
                                <td>{{ $dh->hoten }}</td>
                                <td>{{ $dh->ngaydat }}</td>
                                <td>{{ $dh->tongtien }} VND</td>
                                <td>{{ $dh->httt }}</td>
                                @if($dh->tttt == 0)
                                    <td class="alert alert-danger">Chưa thanh toán</td>
                                @else
                                    <td class="alert alert-success">Đã thanh toán</td>
                                @endif
                                @if($dh->ghichu == null)
                                    <td>Không có</td>
                                @else 
                                    <td>{{ $dh->ghichu }}</td>
                                @endif
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#" onclick="return ConfirmDelete()">Xóa</a></td>
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
@endsection

@section('script')
    <script>
        function ConfirmDelete()
        {
            var x = confirm("Bạn có chắc chắn muốn xóa đơn hàng này ?");
            if (x)
                return true;
            return false;
        }
        $(document).ready(function(){
            $("#trangthaithanhtoan").change(function(){
                var value = $(this).val();
                $.ajax({
                    url:"{{ route('timkiemtrangthaiAjax') }}",
                    method:"GET",
                    data:{value:value},
                    success:function(data){
                        $("#dataTables-example").fadeOut();
                        $("#dataTables-example").fadeIn();
                        $("#dataTables-example").html(data);
                    }
                });
            });
        });
    </script>
@endsection 
