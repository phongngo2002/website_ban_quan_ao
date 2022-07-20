<div class="sidebar-wrapper active">
    <div class="sidebar-header">
        <div class="d-flex justify-content-between">
            <div class="logo">
                <a href="index.html"><img src="{{asset('templates/admin/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item active ">
                <a href="{{url('admin/dashboard')}}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item has-sub">
                <a href="index.html" class='sidebar-link'>
                    <i class="fa-solid fa-list"></i>
                    <span>Danh mục sản phẩm</span>
                </a>
                <ul class="submenu">
                    <li class="submenu-item">
                        <a href="{{url('categories')}}">Tất cả danh mục</a>
                    </li>
                    <li class="submenu-item">
                        <a href="{{url('categories/create')}}">Thêm mới danh mục</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="fa-solid fa-box-open"></i>
                    <span>Sản phẩm</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="component-alert.html">Tất cả sản phẩm</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{url('products/create')}}">Thêm mới sản phẩm</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="component-badge.html">Sản phẩm đã xóa</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item ">
                <a href="index.html" class='sidebar-link'>
                    <i class="fa-solid fa-book"></i>
                    <span>Đơn hàng</span>
                </a>
            </li>
            <li class="sidebar-item has-sub">
                <a href="index.html" class='sidebar-link'>
                    <i class="fa-solid fa-user"></i>
                    <span>Người dùng</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="component-alert.html">Tất cả người dùng</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{url('users/create')}}">Thêm người dùng</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item has-sub">
                <a href="index.html" class='sidebar-link'>
                    <i class="fa-solid fa-images"></i>
                    <span>Banner</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="component-alert.html">Tất cả banner</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{url('banners/create')}}">Thêm mới banner</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item  has-sub">
                <a href="#" class='sidebar-link'>
                    <i class="fa-solid fa-gift"></i>
                    <span>Ưu đãi</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item ">
                        <a href="component-alert.html">Tất cả ưu đãi</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{url('vouchers/create')}}">Thêm mới ưu đãi</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item ">
                <a href="{{url('/')}}" class='sidebar-link'>
                    <i class="fa-solid fa-earth-africa"></i>
                    <span>Website</span>
                </a>
            </li>
        </ul>
    </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
