@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách khách hàng</h1>
                @if(Session('thanhcong'))
                    <div class="alert alert-success">{{ Session('thanhcong') }}</div>
                @endif
                @if(Session('loi'))
                    <div class="alert alert-danger">{{ Session('loi') }}</div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <div>Thông tin khách hàng
                <select name="thongtinkhachhang" id="thongtinkhachhang" class="input-sm">
                    <option value="0">Tất cả khách hàng</option>
                    <option value="1">Khách hàng thành viên</option>
                    <option value="2">Khách hàng vãng lai</option>
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
                        <th>Tên khách hàng</th>
                        <th>Giới tính</th>
                        <th>Dịa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Tên tài khoản</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($khachhang as $kh)
                            <tr class="odd gradeX" style="text-align: center">
                                <td>{{ $kh->makh }}</td>
                                <td>{{ $kh->hoten }}</td>
                                <td>{{ $kh->gioitinh }}</td>
                                <td>{{ $kh->diachi }}</td>
                                <td>{{ $kh->sodt }}</td>
                                <td>{{ $kh->email }}</td>
                                @if($kh->tentk == null)
                                    <td>Không có</td>
                                @else
                                    <td>{{ $kh->tentk }}</td>
                                @endif
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
            var x = confirm("Bạn có chắc chắn muốn xóa khách hàng này ?");
            if (x)
                return true;
            return false;
        }
        $(document).ready(function(){
            $("#thongtinkhachhang").change(function(){
                var value = $(this).val();
                $.ajax({
                    url:"{{ route('timkiemkhachhangAjax') }}",
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
