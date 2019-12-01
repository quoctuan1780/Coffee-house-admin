@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách tài khoản</h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên tài khoản</th>
                        <th>Quyền</th>
                        <th>Email</th>
                        <th>Trạng thái</th>
                        <th>Xóa</th>
                        <th>Sưa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($taikhoan as $tk)
                    <tr class="odd gradeX" style="text-align: center">
                        <td>{{ $tk->id }}</td>
                        <td>{{ $tk->tentk }}</td>
                        @foreach($quyen as $q)
                            @if($q->maquyen == $tk->maquyen)
                                <td>{{ $q->tenquyen }}</td>
                                @break
                            @endif
                        @endforeach
                        <td>{{ $tk->email }}</td>
                        @if($tk->ttdn == 0)
                            <td class="alert alert-danger">Không hoạt động</td>
                        @else
                        <td class="alert alert-success">Đang hoạt động</td>
                        @endif
                        <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#" onclick="return ConfirmDelete()"> Xóa</a></td>
                        <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="#"> Sửa</a></td>
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
            var x = confirm("Bạn có chắc chắn muốn xóa tài khoản này ?");
            if (x)
                return true;
            return false;
        }
    </script>
@endsection 