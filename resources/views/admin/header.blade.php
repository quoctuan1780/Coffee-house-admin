<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('trang-chu') }}">Coffee House Admin</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                @if(Auth::check())
                    <img src="AdminImage/{{ Auth::user()->hinhanh }}" class="img-circle" alt="Cinque Terre" width="40px" height="40px">     
                    {{ Auth::user()->tentk }} <i class="fa fa-caret-down"></i>
                @else
                    <i class="fa fa-user fa-fw"></i><i class="fa fa-caret-down"></i>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-user">
                @if(Auth::check())
                    <li>
                        <a href="{{ route('thong-tin-tai-khoan', Auth::user()->id) }}"><i class="fa fa-user fa-fw"></i>Thông tin tài khoản</a>
                    </li>
                @else
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                    </li>
                @endif
                <li><a href="{{ route('doi-mat-khau') }}"><i class="fa fa-gear fa-fw"></i>Đổi mật khẩu</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ route('dang-xuat') }}"><i class="fa fa-sign-out fa-fw"></i>Đăng xuất</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    @include('admin.menu')
    <!-- /.navbar-static-side -->
</nav>