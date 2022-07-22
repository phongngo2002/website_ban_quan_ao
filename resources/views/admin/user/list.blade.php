@extends('admin.layouts.main')

@section('title','Danh sách người dùng')

@section('content')
    <section class="rounded-3 shadow-sm bg-white p-4 mb-4">
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Email</th>
                <th>Họ tên</th>
                <th>Địa chỉ</th>
                <th>Ảnh đại diện</th>
                <th>Chức vụ</th>
                <th><button class="btn btn-primary"><a href="{{url('users/create')}}" class="text-white">Thêm mới</a></button></th>
            </tr>
            </thead>

            <tbody>
            @foreach($list as $a)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$a->email}}</td>
                    <td>{{$a->name}}</td>
                    <td>{{$a->address}}</td>
                    <td><span class="avatar avatar-xl"><img  src="{{asset('templates/admin/images/faces/'.$a->avatar)}}"></span></td>
                    <td>
                        @if($a->role_id == 1)
                            <span class="font-bold text-danger">Quản trị viên</span>
                        @else
                            <span class="font-bold text-success">Nhân viên</span>
                        @endif
                    </td>
                    <td><button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                        <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
