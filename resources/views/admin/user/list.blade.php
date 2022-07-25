@extends('admin.layouts.main')

@section('title','Danh sách người dùng')

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success" id="alert"><i class="bi bi-check-circle" ></i> Thêm mới thành công</div>
    @endif
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
                <th><a class="btn btn-primary text-white" href="{{url('users/create')}}">Thêm mới</a></th>
            </tr>
            </thead>

            <tbody>
            @foreach($list as $a)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$a->email}}</td>
                    <td>{{$a->name}}</td>
                    <td>{{$a->address}}</td>
                    <td><span class="avatar avatar-xl"><img  src="{{asset('storage/images/users/'.$a->avatar)}}"></span></td>
                    <td>
                        @if($a->role_id == 1)
                            <span class="font-bold text-danger">Quản trị viên</span>
                        @else
                            <span class="font-bold text-success">Nhân viên</span>
                        @endif
                    </td>
                    <td><a class="btn btn-warning" href="{{url('users/edit/'.$a->id)}}"><i class="fa-solid fa-file-pen"></i></a>
                        <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div>
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
