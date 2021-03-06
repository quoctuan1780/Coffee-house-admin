@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chi tiết đơn hàng</h1>
                <div id="thongbao" >
                </div>  
            </div>
            <div class="widget-body no-padding" style="border: 1px">
                <div class="widget-body-toolbar">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="btn-group ng-scope" ng-if="TransportId<=0">
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Giao hàng </a>
                            </div>
                            @if($khachhang->tttt == 0)
                                <div class="btn-group ng-scope" ng-if="PaymentStateId==1">
                                    <button id="btnThanhtoan" class="btn btn-sm btn-success" value="Thanhtoan"> <i class="fa fa-plus"></i> Xác nhận đã thanh toán </button>
                                </div>
                            @else
                                <div class="btn-group ng-scope" ng-if="PaymentStateId==1">
                                    <button href="#" class="btn btn-sm btn-default disabled"> <i class="fa fa-plus"></i> Xác nhận đã thanh toán </button>
                                </div>
                            @endif
                            <div class="btn-group hidden">
                                <a href="javascript:void(0)" class="btn btn-sm btn-success"> <i class="fa fa-share-square"></i> Hoàn trả </a>
                            </div>
                        </div>
                        <div class="col-sm-4 text-align-right">
                        </div>
                    </div>

                </div>

                <div class="padding-10">
                    <br>
                    <div class="pull-left">
                        <h4 class="semi-bold">
                            Thông tin khách hàng
                        </h4>
                        <address class="ng-binding">
                            <strong class="ng-binding">{{ $khachhang->hoten }}</strong>
                            <br>
                                {{ $khachhang->diachi }}
                            <br>
                                {{ $khachhang->email }}
                            <br>
                            <label>Phone:</label> {{ $khachhang->sodt }}
                            <br>
                        </address>
                    </div>
                    <div class="pull-right">
                        <h1 class="font-400">Đơn hàng</h1>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="row">
                        <div class="col-sm-8">
                            <h4 class="semi-bold">Thông tin giao hàng</h4>
                            <address class="ng-binding">
                                <strong class="ng-binding">{{ $khachhang->hoten }}</strong>
                                <br>
                                    {{ $khachhang->diachi }}
                                <br>
                                    {{ $khachhang->email }}
                                <br>
                                <label>Phone:</label> {{ $khachhang->sodt }}
                                <br>
                            </address>
                        </div>
                        <div class="col-sm-4">
                            <div>
                                <div>
                                    <input type="hidden" id="madonhang" value="{{ $khachhang->madh }}">
                                    <strong>Mã đơn hàng :</strong>
                                    <span class="pull-right ng-binding">{{ $khachhang->madh }}</span>
                                </div>

                            </div>
                            <div>
                                <div class="font-md">
                                    <strong>Ngày tạo :</strong>
                                    <span class="pull-right ng-binding"> <i class="fa fa-calendar"></i> {{ $khachhang->ngaydat }}</span>
                                </div>

                            </div>
                            <br>
                            <div class="well well-sm  bg-color-darken txt-color-white no-border">
                                <div class="fa-lg">Thanh toán :
                                    <span class="pull-right ng-binding">{{ $khachhang->tongtien }}</span>
                                </div>

                            </div>
                            <br>
                            <br>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th class="text-center">Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ctdh as $ct)
                            <tr ng-repeat="item in OrderDetails" class="ng-scope">
                                <td>
                                    @foreach($sanpham as $sp)
                                    @if($sp->masp == $ct->masp)
                                    <a href="javascript:void(0)" target="_blank" class="ng-binding">{{ $sp->tensp }}</a>
                                        
                                </td>
                                <td><img src="product/{{ $sp->hinhanh }}" class="img-responsive" style="height:40px;" ></td>
                                    @break
                                @endif
                                @endforeach
                                <td class="text-center"><strong class="ng-binding">{{ $ct->soluong }}</strong></td>
                                <td class="ng-binding">{{ $ct->gia }} VND</td>
                                <td class="text-right ng-binding">{{ $ct->soluong * $ct->gia }} VND</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tbody class="order-totals-summary">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="text-right">Tổng giá trị sản phẩm:</td>
                                <td class="text-right">
                                    <span class="ng-binding">{{ $khachhang->tongtien }} VND</span>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td class="text-right" colspan="4">
                                    Mã khuyến mãi<strong class="ng-binding">()</strong>:
                                </td>
                                <td class="text-right">
                                    <span class="ng-binding">0 ₫</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-right" colspan="4">
                                    Phí vận chuyển
                                    <strong class="ng-binding">()</strong>
                                </td>
                                <td class="text-right p-sm-r">
                                    <span class="ng-binding">0</span>
                                    <span>₫</span>
                                </td>
                            </tr> --}}
                            <tr>
                                <td class="text-right" colspan="4">Số tiền phải thanh toán:</td>
                                <td class="text-right">
                                    <span class="ng-binding">{{ $khachhang->tongtien }}</span>
                                    <span>VND</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="invoice-footer">

                        <div class="row">

                            <div class="col-sm-7">
                                <div class="payment-methods">
                                    <h5>Phương thức thanh toán</h5>
                                    <h3><strong><span class="text-success ng-binding">{{ $khachhang->httt }}</span></strong></h3>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="invoice-sum-total pull-right">
                                    <h3><strong>Thanh toán: <span class="text-success ng-binding">{{ $khachhang->tongtien }} VND</span></strong></h3>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <p class="note ng-binding"></p>
                            </div>
                        </div>
                    </div>
                </div>

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
            $('#btnThanhtoan').click(function(){ 
                Swal.fire({
                title: 'Thông báo',
                text: "Bạn có chắc chắn muốn xác nhận thanh toán ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Đồng ý'
                }).then((result) => {
                if (result.value) {
                    var madh = $("#madonhang").val();
                    if(madh != '') 
                    {
                        $.ajax({
                            url:"{{ route('thanhtoan') }}", 
                            method:"GET", 
                            data:{madh:madh},
                            success:function(data){ 
                                Swal.fire(
                                    'Thông báo',
                                    'Xác nhận thanh toán thành công',
                                    'success'
                                    )
                                document.getElementById('btnThanhtoan').disabled = true;    
                            }
                        });
                    }  
                }
            });	 
        }); 	
    });
    </script>
@endsection 
