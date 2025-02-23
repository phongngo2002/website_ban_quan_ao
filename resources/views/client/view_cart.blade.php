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
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Shoping Cart
        </span>
    </div>
</div>

<!-- Shoping Cart -->
@if(!empty($carts) && isset($carts))
<div class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">

            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <form action="{{url('/cart/update-cart')}}" method="post" id="form">
                    <input type="hidden" name="saveChange" id="saveChange" value="true">

                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            @if(\Illuminate\Support\Facades\Session::has('success'))
                            <p class="alert alert-success">{{\Illuminate\Support\Facades\Session::get('success')}}</p>
                            @endif
                            @if(\Illuminate\Support\Facades\Session::has('warning'))
                            <p class="alert alert-warning">{{\Illuminate\Support\Facades\Session::get('warning')}}</p>
                            @endif
                            <table class="table text-center">
                                <tr class="">
                                    <th class="text-center">Sản phẩm</th>
                                    <th class="text-center"></th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Tổng</th>
                                    <th></th>
                                </tr>
                                @php $a = 0; @endphp
                                @php $d = 1; @endphp
                                @csrf
                                @foreach($carts->products as $cart)
                                <input name="num-product{{$loop->iteration}}"
                                    class="num-product{{$loop->iteration}} halo" type="hidden">
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="how-itemcart1">
                                            <img src="{{asset('storage/images/products/'.$cart->img)}}"
                                                alt="IMG">
                                        </div>

                                    </td>
                                    <td class="column-2">{{$cart->product_name}}</td>
                                    <td class="column-3 price"
                                        data-price="{{$cart->price}}">{{number_format($cart->price, 0, ',', '.')}}
                                        VNĐ
                                    </td>
                                    <td class="column-4 cartQuantity">
                                        {{$cart->totalQuantity}}
                                    </td>

                                    <td class="column-5 total"
                                        data-total="{{$cart->totalQuantity * $cart->price}}">{{number_format($cart->totalQuantity * $cart->price, 0, ',', '.')}}
                                        VNĐ
                                    </td>
                                    <td class="column-6">
                                        <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này ?')"
                                            href="{{url('/cart/delete-item/'.$cart->id)}}"
                                            class="text-danger"><i
                                                class="fa-solid fa-trash-can"></i></a>
                                </tr>
                                @php $a+=$cart->totalQuantity; @endphp
                                <tr class="detailCart">
                                    <td colspan="6">
                                        <table class="table table-bordered text-center">
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Kích cỡ</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-center">Màu sắc</th>
                                                <th class="text-center"></th>
                                            </tr>
                                            @foreach($cart->detail as $c)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$c->size}}</td>
                                                <td>
                                                    <div class="wrap-num-product flex-w"
                                                        style="margin-left: 50%;transform: translateX(-50%)">
                                                        <div
                                                            class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m"
                                                            data-id="{{$d}}">
                                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                                        </div>

                                                        <input
                                                            class="mtext-104 cl3 txt-center num-product quantity{{$d}}"
                                                            type="number"
                                                            value="{{$c->quantity }}">

                                                        <div
                                                            class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m"
                                                            data-id="{{$d}}">
                                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{$c->color}}</td>
                                                <td><a class="btn-link"
                                                        onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này ?')"
                                                        href="{{url('/cart/delete-item-product/'.$cart->id.'/'.$c->color.'/'.$c->size)}}">Xóa
                                                        sản phẩm</a></td>
                                            </tr>

                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                                @php $d+= 1 @endphp

                                @endforeach
                                <input type="hidden"
                                    value="{{$carts->voucher ? $carts->voucher->discount : ''}}"
                                    id="discount">
                                <input name="totalPrice" id="totalPrice" type="hidden"
                                    value="{{$carts->totalPrice}}">
                                <input name="totalQuantity" id="totalQuantity" type="hidden" value="{{$a}}">

                            </table>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            <div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5"
                                    type="text"
                                    {{$carts->voucher ? 'disabled' : ''}} name="coupon"
                                    value="{{$carts->voucher ? 'Voucher đã áp dụng' : ''}}"
                                    placeholder="Mã giảm giá">


                                @if($carts->voucher)
                                <button type="button" id="btnCancel"
                                    class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Bỏ chọn
                                </button>
                                @else
                                <button type="button"
                                    class="btnSub flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    áp dụng
                                </button>
                                @endif
                            </div>

                            <button type="button"
                                class="btnSub flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                Lưu thay đổi
                            </button>
                        </div>
                    </div>

                </form>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Giỏ hàng
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
                            <span class="delPrice totalPrice3">{{number_format($carts->totalPrice - ($carts->totalPrice * ($carts->voucher->discount / 100)) + 13000, 0, ',', '.')}} VNĐ</span>
                            @else
                            <span
                                class="totalPrice1 one">{{number_format($carts->totalPrice + 13000, 0, ',', '.')}} VNĐ</span>
                            @endif
                        </div>
                    </div>

                    <form method="get" action="{{url('/check-out')}}" id="form-check-out">
                        @csrf
                        <button type="button" name="btnOnChange" id="btnOnChange"
                            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Đặt hàng
                        </button>
                    </form>
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
@endsection