@extends('admin.master')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin phản hồi mới</h1>
                @if(Session('thanhcong'))
                    <div class="alert alert-success">{{ Session('thanhcong') }}</div>
                @endif
            </div>
            <!-- /.col-lg-12 -->
            <div>
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>Vấn đề</th>
                        <th>Email</th>
                        <th>Khách hàng</th>
                        <th>Ngày phản hồi</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($phanhoi as $ph)
                        <tr class="odd gradeX" style="text-align: center">
                            <td><a href="javascript:void(0)" id="{{ $ph->maph }}" class="{{ $ph->maph }}" onclick="showContent(document.getElementById({{ $ph->maph }}))">{{ $ph->vande }}</a></td>
                            <td>{{ $ph->email }}</td>
                            <td>{{ $ph->hoten }}</td>
                            <td>{{ $ph->ngayph }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="javascript:void(0)" onclick="ConfirmDelete({{ $ph->maph }})">Xóa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
        <div id="Hienthi"></div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('script')
    <script>
        function ConfirmDelete(maph)
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
                            document.location.href = 'phanhoi/xoaphanhoi/' + maph;
                        }
                    }); 
                }
            }); 
        }
        function showContent(id){
            var maph = id.className;
                $.ajax({
                    url:"{{ route('laynoidungAjax') }}",
                    method:"GET",
                    data:{maph:maph},
                    success:function(data){
                        $("#Hienthi").fadeOut();
                        $("#Hienthi").fadeIn();
                        $("#Hienthi").html(data);
                    }
                });
        }
    </script>
@endsection 
