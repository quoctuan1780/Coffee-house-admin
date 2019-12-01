@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách sản phẩm
                    {{-- <small>List</small> --}}
                </h1>
                @if(Session('thanhcong'))
                    <div class="alert alert-success">{{ Session('thanhcong') }}</div>
                @endif
                @if(Session('loi'))
                    <div class="alert alert-danger">{{ Session('loi') }}</div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
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
                    @foreach($donhang as $dh)
                        <tr class="odd gradeX" style="text-align: center">
                            <td><a href="{{ route('chi-tiet-don-hang', $dh->madh) }}" >{{ $dh->madh }}</a></td>
                            @foreach($khachhang as $kh)
                                @if($dh->makh == $kh->makh)
                                    <td>{{ $kh->hoten }}</td>
                                    @break
                                @endif
                            @endforeach
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
                    {{-- <tr class="even gradeC" align="center">
                        <td>2</td>
                        <td>BẠC SỈU</td>
                        <td>Cà phê</td>
                        <td>29000 VND</td>
                        <td>0 VND</td>
                        <td>Ly</td>
                        <td>Cũ</td>
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#"> Delete</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Edit</a></td>
                    </tr> --}}
                </tbody>
            </table>
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
    </script>
@endsection 
