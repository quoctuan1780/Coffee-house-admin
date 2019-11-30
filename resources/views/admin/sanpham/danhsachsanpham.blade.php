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
                        <th>Tên sản phẩm</th>
                        <th>Loại sản phẩm</th>
                        <th>Giá</th>
                        <th>Giá khuyến mãi</th>
                        <th>Đơn vị tính</th>
                        <th>Trạng thái sản phẩm</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sanpham as $sp)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $sp->masp }}</td>
                            <td>{{ $sp->tensp }}</td>
                            @foreach($loaisp as $loai)
                            @if($loai->maloaisp == $sp->maloaisp)
                                <td>{{ $loai->tenloaisp }}</td>
                            @endif
                            @endforeach
                            <td>{{ $sp->gia }} VND</td>
                            <td>{{ $sp->giakm }} VND</td>
                            <td>{{ $sp->dvt }}</td>
                            @if($sp->moi == 1)
                                <td>Mới</td>
                            @else
                                <td>Cũ</td>
                            @endif
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('xoa-san-pham', $sp->masp) }}" onclick="return ConfirmDelete()">Xóa</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#">Sửa</a></td>
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
            var x = confirm("Bạn có chắc chắn muốn xóa loại sản phẩm này ?");
            if (x)
                return true;
            return false;
        }
    </script>
@endsection 
