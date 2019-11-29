@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thêm sản phẩm
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(Session('Thanhcong'))
                    <div class="alert alert-success">{{Session('Thanhcong')}}</div>
                @endif
                <form action="{{ route('them-san-pham') }}" method="POST">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input class="form-control" name="tensp" placeholder="Trà matcha" required/>
                    </div>
                    <div class="form-group">
                        <label>Loại sản phẩm</label>
                        <select name="loaisp" class="form-control">
                            @foreach($loaisp as $loai)
                                <option value="{{ $loai->maloaisp }}">{{ $loai->tenloaisp }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" rows="3" name="mota"></textarea>
                    </div>
                    <div class="form-group">
                        <label>giá</label>
                        <input class="form-control" name="gia" placeholder="39000" required />
                    </div>
                    <div class="form-group">
                        <label>giá khuyến mãi</label>
                        <input class="form-control" name="giakm" placeholder="35000" required />
                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" name="hinhanh">
                    </div>

                    <div class="form-group">
                        <label>Đơn vị tính</label>
                        <input class="form-control" name="dvt" placeholder="Ly" required />
                    </div>

                    {{-- <div class="form-group">
                        <label>Product Status</label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="1" checked="" type="radio">Visible
                        </label>
                        <label class="radio-inline">
                            <input name="rdoStatus" value="2" type="radio">Invisible
                        </label>
                    </div> --}}
                    <button type="submit" class="btn btn-default">Thêm sản phẩm</button>
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
        $(document).ready(function(){
            $('#lsp').change(function(){
                var maloai = $(this).val(); 
                alert(maloai);
            });
        });
    </script>
@endsection 