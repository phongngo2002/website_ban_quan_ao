@extends('admin.layouts.main')

@section('title','Danh sách sản phẩm')

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success" id="alert"><i class="bi bi-check-circle me-3" ></i>{{\Illuminate\Support\Facades\Session::get('success')}}</div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('warning'))
        <div class="alert alert-warning" id="alert"><i class="bi bi-check-circle me-3" ></i>{{\Illuminate\Support\Facades\Session::get('warning')}}</div>
    @endif
    @if(\Illuminate\Support\Facades\Session::has('error'))
        <div class="alert alert-danger" id="alert"><i class="bi bi-check-circle me-3" ></i>{{\Illuminate\Support\Facades\Session::get('error')}}</div>
    @endif
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
                <td>
                    <div style="display: flex;justify-content: center;">
                        <div>
                            <a class="btn btn-warning" href="{{url('products/edit/'.$a->id)}}"><i class="fa-solid fa-file-pen"></i></a>
                        </div>
                        <div class="ms-1 me-1">
                            <button class="btn btn-info " data-bs-toggle="modal"
                                    data-bs-target="#default{{$loop->iteration }}"><i class="fa-solid fa-eye"></i></button>
                            <div class="modal fade text-left" style="width: 100%" id="default{{$loop->iteration }}" tabindex="-1" role="dialog{{$loop->iteration }}"
                                 aria-labelledby="myModalLabel1{{$loop->iteration }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable" role="document{{$loop->iteration }}">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title text-white" id="myModalLabel1{{$loop->iteration }}">Thông tin chi tiết - {{$a->product_name}}</h5>
                                            <button type="button" style="border: none;outline: none;background-color: transparent;"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa-solid fa-xmark" style="font-size: 22px;color: white"></i>
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
                        </div>
                        <form action="{{url('products/delete/'.$a->id)}}" method="post">
                            @csrf
                            <div class="modal-warning me-1 mb-1 d-inline-block">
                                <!-- Button trigger for warning theme modal -->
                                <button class="btn btn-danger" type="button"
                                        data-bs-toggle="modal" data-bs-target="#warning{{$a->id}}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>

                                <!--warning theme Modal -->
                                <div class="modal fade text-left" id="warning{{$a->id}}" tabindex="-1"
                                     role="dialog" aria-labelledby="myModalLabel140"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title white" id="myModalLabel140">
                                                    Lưu ý
                                                </h5>
                                                <button type="button" class="close"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có chắc muốn xóa sản phẩm <span
                                                    class="font-bold">{{$a->product_name}}</span>
                                                này không ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button"
                                                        class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Hủy</span>
                                                </button>

                                                <button type="submit" class="btn btn-warning ml-1"></i><span
                                                        class="d-none d-sm-block">Đồng ý</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script !src="">
        const alertEle = document.getElementById('alert');
        if (alertEle) {
            setTimeout(function () {
                alertEle.style.display = 'none';
            }, 2000)
        }

    </script>
@endsection
