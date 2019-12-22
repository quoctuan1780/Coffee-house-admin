@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Đơn hàng mới</h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th style="width: 30px">ID</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Hình thức thanh toán</th>
                        <th>Trạng thái thanh toán</th>
                        <th>Lời nhắn</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($donhangmoi as $dh)
                            <tr class="odd gradeX" style="text-align: center">
                                <td><a href="{{ route('chi-tiet-don-hang', $dh->madh) }}" >{{ $dh->madh }}</a></td>
                                <td>{{ $dh->hoten }}</td>
                                <td>{{ $dh->ngaydat }}</td>
                                <td>{{ $dh->tongtien }} VND</td>
                                <td>{{ $dh->httt }}</td>
                                @if($dh->tttt == 0)
                                    <td class="alert alert-danger">Chưa thanh toán</td>
                                @else
                                    <td class="alert alert-success">Đã thanh toán</td>
                                @endif
                                @if($dh->ghichu == null)
                                    <td>Không có</td>
                                @else 
                                    <td>{{ $dh->ghichu }}</td>
                                @endif
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="javascript:void(0)" onclick="ConfirmDelete({{ $dh->madh }}, {{ $dh->tttt }})">Xóa</a></td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
            </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('script')
    <script>
        function ConfirmDelete(madh, tttt)
        {
            var x;
            Swal.fire({
            title: 'Thông báo',
            text: "Bạn có chắc chắn muốn xóa ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý'
            }).then((result) => {
            if (result.value) {
                    let timerInterval
                    Swal.fire({
                    title: 'Xin chờ',
                    html: 'Xóa trong <b></b> milliseconds.',
                    timer: 2000,
                    timerProgressBar: true,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {
                        Swal.getContent().querySelector('b')
                            .textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                        onClose: () => {
                            
                            clearInterval(timerInterval)
                        }
                        }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            document.location.href = 'donhang/xoadonhang/' + madh + '/' + tttt;
                        }
                    }); 
                }
            }); 
        }
    </script>
@endsection 
