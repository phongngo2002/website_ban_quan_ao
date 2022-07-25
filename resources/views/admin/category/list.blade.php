@extends('admin.layouts.main')

@section('title','Danh sách danh mục')

@section('content')
   @if(\Illuminate\Support\Facades\Session::has('success'))
       <div class="alert alert-success" id="alert"><i class="bi bi-check-circle" ></i> Thêm mới thành công</div>
   @endif

    <section class="rounded-2 shadow-sm bg-white p-4 mb-4">
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Tên danh mục</th>
                <th>
                    <button class="btn btn-primary"><a href="{{url('categories/create')}}" class="text-white">Thêm
                            mới</a></button>
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($list as $a)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$a->title}}</td>
                    <td>
                        <a class="btn btn-warning" href="{{url('categories/edit/'.$a->id)}}"><i class="fa-solid fa-file-pen"></i></a>
                        <a class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
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
