@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đổi mật khẩu</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7">
                <div style="box-shadow: 0px 0px 3px 0px rgba(88, 88, 88, 0.3);">
                    <div class="panel-body">
                        @if(Session('loi'))
                            <div class="alert alert-danger">{{Session('loi')}}</div>
                        @endif
                        @if(Session('thanhcong'))
                            <div class="alert alert-success">{{Session('thanhcong')}}</div>
                        @endif
                        <form role="form" action="{{ route('doi-mat-khau') }}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <fieldset>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" value="{{ Auth::user()->email }}" name="email" type="email" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu cũ</label>
                                    <input class="form-control" placeholder="Nhập mật khẩu cũ" name="old_password" type="password" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label>Mật khẩu mới</label>
                                    <input class="form-control" placeholder="Nhập mật khẩu mới" name="password" type="password" required>
                                </div>
                                <div class="form-group">
                                    <label>Xác nhận mật khẩu</label>
                                    <input class="form-control" placeholder="Nhập lại mật khẩu" name="re_password" type="password" required>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Đổi mật khẩu</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection