<div class="navbar-default sidebar style_menu" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{ route('trang-chu') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-windows fa-fw"></i> Khách hàng<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('danh-sach-khach-hang') }}">Danh sách khách hàng</a>
                    </li>
                    <li>
                        <a href="{{ route('dang-ki-nhan-tin') }}">Danh sách email đăng kí nhận tin</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-file fa-fw"></i> Đơn hàng<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('danh-sach-don-hang') }}">Danh sách đơn hàng</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-list fa-fw"></i> Loại sản phẩm<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('danh-sach-loai-san-pham') }}">Danh sách loại sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{ route('them-loai-san-pham') }}">Thêm loại sản phẩm</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-cube fa-fw"></i> Sản phẩm<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('danh-sach-san-pham')}}">Danh sách sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{route('them-san-pham')}}">Thêm sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{route('sua-san-pham')}}">Sửa sản phẩm</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-table fa-fw"></i> Thống kê<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ route('thong-ke-doanh-thu') }}">Thống kê doanh thu</a>
                    </li>
                    {{-- <li>
                        <a href="#">Thêm tài khoản</a>
                    </li> --}}
                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                    <a href="#"><i class="fa fa-bell-o fa-fw"></i> Phản hồi<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('thong-tin-phan-hoi') }}">Thông tin phản hồi</a>
                        </li>
                        {{-- <li>
                            <a href="#">Thêm tài khoản</a>
                        </li> --}}
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            @if(Auth::user()->maquyen == 1)
                <li>
                    <a href="#"><i class="fa fa-users fa-fw"></i> Tài khoản<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{ route('danh-sach-tai-khoan') }}">Danh sách tài khoản</a>
                        </li>
                        <li>
                            <a href="{{ route('them-tai-khoan') }}">Thêm tài khoản</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            @endif
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>


