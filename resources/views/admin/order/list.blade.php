@extends('admin.layouts.main')

@section('title','Danh sách đơn hàng')

@section('content')
    <section class="rounded-2 shadow-sm bg-white p-4 mb-4">
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Mã đơn hàng</th>
                <th>Email người nhận</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ nhận hàng</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            @foreach($list as $a)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$a->order_code}}</td>
                    <td>{{$a->email}}</td>
                    <td>{{$a->customer_name}}</td>
                    <td>{{$a->phone_number}}</td>
                    <td>{{$a->address}}</td>
                    <td>
                        @if($a->status == 0)
                            <span class="text-warning">Đơn hàng mới</span>
                        @else
                            <span class="text-success">Chờ thanh toán</span>
                        @endif

                    </td>
                    <td><a class="btn btn-info" href="{{url('/orders/'.$a->id)}}"><i class="fa-solid fa-eye"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$list->links()}}
    </section>
@endsection
