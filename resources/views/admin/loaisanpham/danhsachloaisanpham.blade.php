@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách loại sản phẩm
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
                    <tr >
                        <th style="width: 30px; text-align: center">ID</th>
                        <th style="text-align: center">Tên loại sản phẩm</th>
                        <th style="text-align: center">Xóa</th>
                        <th style="text-align: center">Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loaisanpham as $lsp)
                        <tr class="odd gradeX" style="text-align: center">
                            <td>{{ $lsp->maloaisp }}</td>
                            <td>{{ $lsp->tenloaisp }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('xoa-loai-san-pham', $lsp->maloaisp) }}" onclick="return ConfirmDelete()">Xóa</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('sua-loai-san-pham', $lsp->maloaisp) }}">Sửa</a></td>
                        </tr>
                    @endforeach
            
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
