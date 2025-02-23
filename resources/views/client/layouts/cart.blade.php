<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Giỏ hàng của bạn
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                @if(!empty($carts))
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
                    Tổng: @if(isset($carts->voucher ) && isset($carts))
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

                    <a href="{{url('/check-out')}}"
                        class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>