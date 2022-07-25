@extends('admin.layouts.main')

@section('title','Danh sách banner')

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success" id="alert"><i class="bi bi-check-circle" ></i> Thêm mới thành công</div>
    @endif
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
                    <td><img src="{{asset('storage/images/banners/'.$a->img)}}" style="width:192px;height: 93px "></td>
                    <td><a class="btn btn-warning" href="{{url('banners/edit/'.$a->id)}}"><i class="fa-solid fa-file-pen"></i></a>
                        <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>

                    </td>
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
