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
                    <td><button class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                       </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
