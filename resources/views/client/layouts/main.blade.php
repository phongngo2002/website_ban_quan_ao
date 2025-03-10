
<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('name_page')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	@include('client.layouts._style')
<!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="animsition">

	<!-- Header -->
	@yield('header')

	<!-- Sidebar -->
	@include('client.layouts.sidebar')

	<!-- Cart -->
	@include('client.layouts.cart')

    @yield('content')


	<!-- Footer -->
	@include('client.layouts.footer')

	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->


<!--===============================================================================================-->
	@include('client.layouts._script')

</body>
</html>
