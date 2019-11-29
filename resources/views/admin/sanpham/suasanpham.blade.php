@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Sửa sản phẩm</h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
            @if(Session('Thanhcong'))
                <div class="alert alert-success">{{Session('Thanhcong')}}</div>
            @endif
                <form action="{{ route('sua-san-pham') }}" method="POST">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                        <input type="hidden" name="masp" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Tên sản phẩm</label>
                        <input type="text" name="tensp" id="tensp" class="form-control" placeholder="Tên sản phẩm" required/>
                        <div id="listsp" style="position: fixed"><br></div>
                    </div>
                    <div id="show">
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
                    </div>
                    <button type="submit" class="btn btn-default">Sửa sản phẩm</button>
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
      
            $('#tensp').keyup(function(){ 
            var query = $(this).val(); 
            if(query != '') 
                {
                var _token = $('input[name="_token"]').val(); // token để mã hóa dữ liệu
                    $.ajax({
                        url:"{{ route('timkiemAjax') }}", // đường dẫn khi gửi dữ liệu đi 
                        method:"GET", 
                        data:{query:query, _token:_token},
                        success:function(data){ //dữ liệu nhận về
                            $('#listsp').fadeIn();  
                            $('#listsp').html(data); //nhận dữ liệu dạng html
                        }
                    });
                }
            else $("#listsp").fadeOut();
            }); 
        });
        $(document).on('click', 'li', function(){  
            $('#tensp').val($(this).text());  
                $('#listsp').fadeOut();  
                var query = $(this).text();
                var _token = $('input[name="_token"]').val(); 
                $.ajax({
                    url:"{{ route('hienthiAjax') }}",
                    method:"GET", 
                    data:{query:query, _token:_token},
                    success:function(data){ 
                        $('#show').fadeOut();
                        $('#show').fadeIn();
                        $('#show').html(data); 
                    }
                });    
        }); 
      </script>
@endsection