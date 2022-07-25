@extends('admin.layouts.main')

@section('title','Danh sách sản phẩm')

@section('content')
    <section class="rounded-3 shadow-sm bg-white p-4 mb-4">
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá(VNĐ)</th>
                <th>Ảnh sản phẩm</th>
                <th>Số hàng trong kho</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th><button class="btn btn-primary"><a href="{{url('products/create')}}" class="text-white">Thêm mới</a></button></th>
            </tr>
            </thead>

            <tbody>
            @foreach($list as $a)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$a->SKU}}</td>
                    <td>{{$a->product_name}}</td>
                    <td>{{number_format($a->price, 0, ',', '.')}}</td>
                    <td><img src="{{asset('storage/images/products/'.$a->img)}}" style="width: 120px;height: 148px"></td>
                    <td>{{$a->in_stock}}</td>
                    <td>
                          <span class="font-bold">  {{$a->category->title}}</span>
                    </td>
                    <td>
                        @if($a->in_stock == 0)
                            <span class="text-danger font-bold">Hết hàng</span>
                        @else
                            <span class="text-success font-bold">Còn hàng</span>
                        @endif
                    </td>
                    <td><a class="btn btn-warning" href="{{url('products/edit/'.$a->id)}}"><i class="fa-solid fa-file-pen"></i></a>
                        <button class="btn btn-info " data-bs-toggle="modal"
                                data-bs-target="#default{{$loop->iteration }}"><i class="fa-solid fa-eye"></i></button>
                        <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                        <div class="modal fade text-left" style="width: 100%" id="default{{$loop->iteration }}" tabindex="-1" role="dialog{{$loop->iteration }}"
                             aria-labelledby="myModalLabel1{{$loop->iteration }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document{{$loop->iteration }}">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h5 class="modal-title text-white" id="myModalLabel1{{$loop->iteration }}">Thông tin chi tiết - {{$a->product_name}}</h5>
                                        <button type="button" class="close rounded-pill"
                                                data-bs-dismiss="modal{{$loop->iteration }}" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="text-align: left">
                                        <p>Mã sản phẩm: {{$a->SKU}}</p>
                                        <p>Tên sản phẩm: {{$a->product_name}}</p>
                                        <p>Giá sản phẩm: {{number_format($a->price, 0, ',', '.')}} VNĐ</p>
                                        <p>Danh mục: {{$a->category->title}}</p>
                                        <p>Từ khóa: {{implode(", ",json_decode($a->tag))}}</p>
                                        <p>Số hàng trong kho: {{$a->in_stock}}</p>
                                        <div>
                                            <p>Màu sắc: {{implode(", ",json_decode($a->colors))}}<p/>
                                        </div>
                                        <div>
                                            <p>Size: {{implode(", ",json_decode($a->sizes))}}<p/>
                                        </div>
                                        <p>Trạng thái:
                                            @if($a->in_stock == 0)
                                                <span class="text-danger font-bold">Hết hàng</span>
                                            @else
                                                <span class="text-success font-bold">Còn hàng</span>
                                            @endif
                                        </p>
                                        <div>
                                            <ul class="nav nav-tabs mb-2" id="myTab{{$loop->iteration }}" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="home-tab{{$loop->iteration }}" data-bs-toggle="tab" href="#home{{$loop->iteration }}" role="tab" aria-controls="home" aria-selected="true">Thông tin giao hàng</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="profile-tab{{$loop->iteration }}" data-bs-toggle="tab" href="#profile{{$loop->iteration }}" role="tab" aria-controls="profile" aria-selected="false">Mô tả ngắn</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="contact-tab{{$loop->iteration }}" data-bs-toggle="tab" href="#contact{{$loop->iteration }}" role="tab" aria-controls="contact" aria-selected="false">Mô tả chi tiết</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content " id="myTabContent">
                                                <div class="tab-pane fade active show" id="home{{$loop->iteration }}" role="tabpanel" aria-labelledby="home-tab">
                                                    <table class="table table-bordered text-left">
                                                        <tr>
                                                            <td>Cân nặng</td>
                                                            <td>{{$a->weight}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kích thước</td>
                                                            <td>{{$a->dimensions}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Chất liệu</td>
                                                            <td>{{$a->materials}}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="profile{{$loop->iteration }}" role="tabpanel" aria-labelledby="profile-tab">
                                                    <p class="mt-2">
                                                        {{$a->short_desc}}</p>
                                                </div>
                                                <div class="tab-pane fade" id="contact{{$loop->iteration }}" role="tabpanel" aria-labelledby="contact-tab">
                                                    <p class="mt-2">
                                                        {{$a->desc}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="">
            {{$list->links()}}
        </div>
    </section>
@endsection
