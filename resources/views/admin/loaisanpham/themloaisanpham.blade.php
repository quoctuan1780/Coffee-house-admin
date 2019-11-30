@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm loại sản phẩm
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(Session('thanhcong'))
                    <div class="alert alert-success">{{Session('thanhcong')}}</div>
                @endif
                @if(Session('loi'))
                    <div class="alert alert-danger">{{Session('loi')}}</div>
                @endif
                <form action="{{ route('them-loai-san-pham') }}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tên loại sản phẩm</label>
                        <input class="form-control" name="tenloaisp" placeholder="Kẹo" required/>
                    </div>
                    <button type="submit" class="btn btn-default">Thêm loại sản phẩm</button>
                    <button type="reset" class="btn btn-default">Hủy</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
