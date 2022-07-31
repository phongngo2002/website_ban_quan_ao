<div class="sec-banner bg0 p-t-95 p-b-55">
    <div class="container">
        <div class="row">

            @foreach($categories as $a)
                @if($loop->iteration == 1 || $loop->iteration == 2)
                    <div class="col-md-6 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="{{asset('storage/images/categories/'.$a->img)}}" alt="IMG-BANNER">

                            <a href="{{url('shop')}}"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                               {{$a->title}}
                            </span>

                                    <span class="block1-info stext-102 trans-04">
                                  Summer 2022
                            </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @elseif($loop->iteration != 1 && $loop->iteration != 2 && $loop->iteration < 6)
                    <div class="col-md-6 col-lg-4 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w">
                            <img src="{{asset('storage/images/categories/'.$a->img)}}" alt="IMG-BANNER">

                            <a href="{{url('shop')}}"
                               class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                            <span class="block1-name ltext-102 trans-04 p-b-8">
                                      {{$a->title}}
                            </span>

                                    <span class="block1-info stext-102 trans-04">
                             Summer 2022
                            </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
