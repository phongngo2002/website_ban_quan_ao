@extends('admin.layouts.main')

@section('title','Danh sách danh mục')

@section('content')
 <section class="rounded-2 shadow-sm bg-white p-4 mb-4">
    <table class="table text-center">
        <thead>
                <tr>
                    <th>#</th>
                    <th>Tên danh mục</th>
                    <th><button class="btn btn-primary"><a href="{{url('create')}}" class="text-white">Thêm mới</a></button></th>
                </tr>
        </thead>

        <tbody>
       @foreach($list as $a)
           <tr>
               <td>{{$loop->iteration }}</td>
               <td>{{$a->title}}</td>
               <td><button class="btn btn-warning"><i class="fa-solid fa-file-pen"></i></button>
                   <button class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button></td>
           </tr>
       @endforeach
        </tbody>
    </table>
 </section>
@endsection
