@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm tài khoản</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(Session('thanhcong'))
                    <div class="alert alert-success">{{ Session('thanhcong') }}</div>
                @endif
                <form action="{{ route('them-tai-khoan') }}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email" required/>
                    </div>
                    <div class="form-group">
                        <label>Tên tài khoản</label>
                        <input class="form-control" name="tentk" placeholder="Tên tài khoản" required/>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required/>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" class="form-control" name="re_password" placeholder="Nhập lại mật khẩu" required/>
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="hinhanh">
                    </div>
                    
                    <div class="form-group">
                        <label>Quyền</label>
                        <select name="maquyen" class="form-control">
                            <option value="1">Quản trị viên</option>
                            <option value="3">Thành viên</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm tài khoản</button>
                    <button type="reset" class="btn btn-default">Hủy</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection