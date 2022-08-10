@extends('client.layouts.main')
@section('name_page','Giỏ hàng')
@section('header')
    @include('client.layouts.header_v4')
@endsection
@section('content')
<div class="text-center pt-5" style="margin-bottom: 250px">
    <h3 style="margin:100px 250px 0 ">Cảm ơn bạn đã mua hàng của chúng tôi.Chúng tôi đã gửi hóa đơn đến <span style="font-weight: bold">{{$email}}</span>. Kiểm tra và liên hệ với chúng tôi nếu có bất kỳ thắc mặc nào</h3>
</div>
@endsection
