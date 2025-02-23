@extends('client.layouts.main')
@section('name_page','Giỏ hàng')
@section('header')
@include('client.layouts.header_v4')
@endsection
@section('content')
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @if(!empty($carts) && isset($carts))
                @foreach($carts->products as $cart)
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="{{asset('/storage/images/products/'.$cart->img)}}" alt="IMG">
                    </div>

                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            {{$cart->product_name}}
                        </a>

                        <span class="header-cart-item-info">
                            {{$cart->totalQuantity}} x {{number_format($cart->price, 0, ',', '.')}} VNĐ
                        </span>
                    </div>
                </li>
                @endforeach
                @endif
            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    @if(isset($carts))
                    Tổng: @if( isset($carts->voucher) && isset($carts))
                    <del class="totalPrice1" style="font-weight: bold;">{{number_format($carts->totalPrice, 0, ',', '.')}}</del>
                    <sup class="text-danger">-{{$carts->voucher->discount}}%</sup>
                    <br>
                    <span class="delPrice">{{number_format($carts->totalPrice - ($carts->totalPrice * ($carts->voucher->discount / 100)), 0, ',', '.')}} VNĐ</span>

                    @elseif($carts && empty($carts->voucher))
                    <span class="delPrice">{{number_format($carts->totalPrice, 0, ',', '.')}} VNĐ</span>
                    @else
                    <span class="delPrice">0 VNĐ</span>
                    @endif
                    @endif
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="{{url('/cart')}}"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Xem giỏ hàng
                    </a>

                    <a href="shoping-cart.html"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Trang chủ
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Đặt hàng
        </span>
    </div>
</div>

<!-- Shoping Cart -->
@if(!empty($carts) && isset($carts))
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <form action="{{url('/check-out')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label id="email">Email</label>
                        <input class="form-control @error('email') one1 @enderror" type="text" id="email"
                            name="email">
                        @error('email')
                        <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label id="customer_name">Họ tên</label>
                        <input class="form-control @error('customer_name') one1 @enderror" type="name"
                            name="customer_name" id="customer_name">
                        @error('customer_name')
                        <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label id="phone_number">Số điện thoại</label>
                        <input class="form-control @error('phone_number') one1 @enderror" type="text"
                            name="phone_number" id="phone_number">
                        @error('phone_number')
                        <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label id="address">Địa chỉ nhận hàng</label>
                        <input class="form-control @error('address') one1 @enderror" type="text" name="address"
                            id="address">
                        @error('address')
                        <p class="text-danger mt-1">{{$message}}</p>
                        @enderror
                    </div>
                    {{-- <div id="paypal-button-container"></div>--}}
                    <button type="submit"
                        class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Đặt hàng
                    </button>
                </form>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Hóa đơn
                    </h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Tổng tiền:
                            </span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110">
                                @if($carts->voucher)
                                <del class="totalPrice1" style="font-weight: bold;">{{$carts->voucher ? number_format($carts->totalPrice, 0, ',', '.') : '' }}</del>
                                <sup class="text-danger">-{{$carts->voucher->discount}}%</sup>
                                <br>
                                <span class="delPrice">{{number_format($carts->totalPrice - ($carts->totalPrice * ($carts->voucher->discount / 100)), 0, ',', '.')}} VNĐ</span>

                                @else
                                <span
                                    class="totalPrice1">{{number_format($carts->totalPrice, 0, ',', '.')}} VNĐ</span>
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                        <div class="size-208 w-full-ssm">
                            <span class="stext-110 cl2">
                                Phí vận chuyển:
                            </span>
                        </div>

                        <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                            <p class="stext-110 cl2 p-t-2">
                                13.000 VNĐ
                            </p>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Tổng:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            @if($carts->voucher)
                            <span class="delPrice1"
                                data-price="{{$carts->totalPrice - ($carts->totalPrice * ($carts->voucher->discount / 100)) + 13000}}">{{number_format($carts->totalPrice - ($carts->totalPrice * ($carts->voucher->discount / 100)) + 13000, 0, ',', '.')}} VNĐ</span>
                            @else
                            <span class="delPrice1"
                                data-price="{{$carts->totalPrice + 13000}}"
                                class="totalPrice1 one">{{number_format($carts->totalPrice + 13000, 0, ',', '.')}} VNĐ</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@else
<div class="m-4 text-center">
    <h4 class="" style="margin-bottom: 250px">Bạn chưa có sản phẩm nào trong giỏ hàng</h4>
</div>
@endif
{{-- <script--}}
{{-- src="https://www.paypal.com/sdk/js?client-id=AZ4QU8IdSW4G2P2IESYMyZ6PLeqh-aQ69lJtv9-9PnvYcXUiqgsLJelySdgRcpIbDEPz01-HtkB7jcJC&currency=USD"></script>--}}

{{-- <script>--}}
{{-- const {price} = document.querySelector('.delPrice1').dataset;--}}
{{-- console.log(price);--}}
{{-- paypal.Buttons({--}}
{{-- // Sets up the transaction when a payment button is clicked--}}
{{-- createOrder: (data, actions) => {--}}
{{-- return actions.order.create({--}}
{{-- "purchase_units": [{--}}
{{-- "amount": {--}}
{{-- "currency_code": "USD",--}}
{{-- "value": "100",--}}
{{-- "breakdown": {--}}
{{-- "item_total": {  /* Required when including the items array */--}}
{{-- "currency_code": "USD",--}}
{{-- "value": Number(price) * 0.000043--}}
{{-- }--}}
{{-- }--}}
{{-- },--}}
{{-- "items": [--}}
{{-- {--}}
{{-- "name": "First Product Name", /* Shows within upper-right dropdown during payment approval */--}}
{{-- "description": "Optional descriptive text..", /* Item details will also be in the completed paypal.com transaction view */--}}
{{-- "unit_amount": {--}}
{{-- "currency_code": "USD",--}}
{{-- "value": Number(price) * 0.000043--}}
{{-- },--}}
{{-- "quantity": "1"--}}
{{-- },--}}
{{-- ]--}}
{{-- }]--}}
{{-- });--}}
{{-- },--}}
{{-- // Finalize the transaction after payer approval--}}
{{-- onApprove: (data, actions) => {--}}
{{-- return actions.order.capture().then(function (orderData) {--}}
{{-- // Successful capture! For dev/demo purposes:--}}
{{-- console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));--}}
{{-- const transaction = orderData.purchase_units[0].payments.captures[0];--}}
{{-- alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);--}}
{{-- });--}}
{{-- }--}}
{{-- }).render('#paypal-button-container');--}}
{{-- </script>--}}
@endsection