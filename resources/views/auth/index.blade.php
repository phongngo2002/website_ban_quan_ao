
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('templates/admin/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('templates/admin/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('templates/admin/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('templates/admin/css/pages/auth.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
<div id="auth">

    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="index.html"><img src="{{asset('templates/admin/images/logo/logo.png')}}" alt="Logo"></a>
                </div>
                <h1 class="auth-title">Đăng nhập hệ thống</h1>
                <p class="auth-subtitle mb-5">Chào mừng bạn trở lại.</p>

                <form action="{{url('/login')}}" method="post">
                    @if(\Illuminate\Support\Facades\Session::has('error'))
                        <p class="text-danger">{{\Illuminate\Support\Facades\Session::get('error')}}</p>
                    @endif
                    <div class="form-group position-relative has-icon-left mb-2">
                        <input type="text" class="form-control form-control-xl" name="email" id="email" placeholder="Email">
                        <div class="form-control-icon">
                            <i class="fa-solid fa-envelope mb-2"></i>
                        </div>

                    </div>
                    @error('email')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="form-group position-relative has-icon-left mb-2">
                        <input type="password" class="form-control form-control-xl" name="password" id="password" placeholder="Mật khẩu">

                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>

                    </div>
                    @error('password')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="form-check form-check-lg d-flex align-items-end">
                        <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label text-gray-600" for="flexCheckDefault">
                           Lưu đăng nhập
                        </label>
                    </div>
                    <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Đăng nhập</button>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                </form>
                <div class="text-center mt-5 text-lg fs-4">
                   <p class="text-primary"><a href="{{url('/')}}">Trở về trang chủ</a></p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">

            </div>
        </div>
    </div>
</div>
</body>

</html>
