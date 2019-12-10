@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách email đăng kí nhận tin</h1>
                @if(Session('thanhcong'))
                    <div class="alert alert-success">{{ Session('thanhcong') }}</div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <div id="Hienthi">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th style="width: 30px">ID</th>
                            <th>Email</th>
                            <th>Ngày đăng kí</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dknt as $dk)
                            <tr class="odd gradeX" style="text-align: center">
                                <td>{{ $dk->id }}</td>
                                <td>{{ $dk->email }}</td>
                                <td>{{ $dk->ngaydk }}</td>
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

