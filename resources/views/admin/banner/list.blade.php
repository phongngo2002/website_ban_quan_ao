@extends('admin.layouts.main')

@section('title','Danh sách banner')

@section('content')
    <section class="rounded-3 shadow-sm bg-white p-4 mb-4">
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Mô tả</th>
                <th>Ảnh nền</th>
                <th><button class="btn btn-primary"><a href="{{url('banners/create')}}" class="text-white">Thêm mới</a></button></th>
            </tr>
            </thead>

            <tbody>
            @foreach($list as $a)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$a->title}}</td>
                    <td>{{$a->desc}}</td>
                    <td><img src="{{asset('client/images/'.$a->img)}}" style="width:192px;height: 93px "></td>
                    <td><button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                        <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel1">Basic Modal</h5>
                    <button type="button" class="close rounded-pill"
                            data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Bonbon caramels muffin. Chocolate bar oat cake cookie pastry
                        dragée pastry.
                        Carrot cake
                        chocolate tootsie roll chocolate bar candy canes biscuit.

                        Gummies bonbon apple pie fruitcake icing biscuit apple pie
                        jelly-o sweet
                        roll. Toffee sugar
                        plum sugar plum jelly-o jujubes bonbon dessert carrot cake.
                        Cookie dessert
                        tart muffin topping
                        donut icing fruitcake. Sweet roll cotton candy dragée danish
                        Candy canes
                        chocolate bar cookie.
                        Gingerbread apple pie oat cake. Carrot cake fruitcake bear claw.
                        Pastry
                        gummi bears
                        marshmallow jelly-o.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" class="btn btn-primary ml-1"
                            data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
