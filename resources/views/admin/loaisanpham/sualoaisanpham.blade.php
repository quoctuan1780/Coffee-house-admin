@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sửa loại sản phẩm
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(Session('thanhcong'))
                    <div class="alert alert-success">{{Session('thanhcong')}}</div>
                @endif
                <form action="{{ route('sua-loai-sp') }}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="maloaisp" placeholder="Kẹo" value="{{ $loaisanpham->maloaisp }}"/>
                    </div>
                    <div class="form-group">
                        <label>Tên loại sản phẩm</label>
                        <input class="form-control" name="tenloaisp" placeholder="Kẹo" value="{{ $loaisanpham->tenloaisp }}" required/>
                    </div>
                    <button type="submit" class="btn btn-default" onclick="return ConfirmDelete()">Sửa loại sản phẩm</button>
                    <button type="reset" class="btn btn-default">Hủy</button>
                <form>
            </div>
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
