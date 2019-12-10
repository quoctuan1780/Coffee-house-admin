@extends('admin.master')
@section('content')
<!-- MAIN CONTENT -->
<div id="page-wrapper">
    <div class="row">
        <div>
            <div class="well form-horizontal">
                <h2>Thông tin khách hàng</h2>
                <hr>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tiêu đề</label>
                    <div class="col-md-8">
                        <input type="text" name="Title" class="form-control ">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Ngày gửi</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control " name="CreatedDate">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Tên khách hàng</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control " name="Name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Điện thoại</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control " name="Phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control " name="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Địa chỉ</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control " name="Address">
                    </div>
                </div>

                <h2>Nội dung liên hệ</h2>
                <hr>
                <div class="form-group">
                    <label class="col-md-3 control-label">Nội dung</label>
                    <div class="col-md-8">
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('thong-tin-phan-hoi') }}" class="btn btn-default">Trở về</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT -->
@endsection