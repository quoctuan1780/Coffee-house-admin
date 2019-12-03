@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin tài khoản</h1>
            </div>
            <div class="widget-body no-padding" style="border: 1px">
                <div class="padding-10" style="background-image: url('adminImage/bg2.jpg'); margin-top: 90px; box-shadow: black">
                    <br>
                    <div class="pull-left">
                        <div class="row" style="padding-left: 48px;">
                            <div class="row" style="align-content: center; box-shadow: 0px 0px 3px 0px rgba(88, 88, 88, 0.3); padding: 5px 10px;color: #FF0000; text-shadow: darkgrey">
                                <img src="AdminImage/{{ Auth::user()->hinhanh }}" class="img-circle" alt="Cinque Terre" width="200px" height="220px"> 
                                <div style="text-align: center; padding-right: 10px">Ảnh đại diện</div><br>
                                <div>Tên tài khoản: {{ $taikhoan->tentk }}</div><br>
                                <div>Email: {{ $taikhoan->email }}</div><br>
                                <div>Quyền: {{ $quyen->tenquyen }}</div><br>
                                <div class="col-lg-12" style="display: inline-flex">
                                    <div class="col-lg-0">
                                            <a href="" style="color: #FF0000">Đổi mật khẩu</a>
                                    </div>
                                    <div class="col-lg-0" style="padding: 0px 0px 0px 10px">
                                        <a href="{{ route('dang-xuat') }}" style="color: #FF0000">Đăng xuất</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    {{-- <div class="pull-right">
                        <h1 class="font-400">Đơn hàng</h1>
                    </div> --}}
                    <div class="clearfix"></div>
                    <br>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection