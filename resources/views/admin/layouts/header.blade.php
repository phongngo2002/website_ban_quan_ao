<header class="mb-4" >
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
    <div class="avatar avatar-md has-sub" style="float: right">
        <div  class="dropdown-toggl"  id="dropdownMenuButton" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" style="cursor: pointer">
            <img src="{{asset('client/images/pexels-pixabay-2150.jpg')}}">
            <span>Ngo Van Phong</span>
        </div>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{url('/logout')}}">Đăng xuất</a>
        </div>
    </div>
</header>
