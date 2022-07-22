@extends('admin.layouts.main')

@section('title','Danh sách voucher')

@section('content')
    <section class="rounded-2 shadow-sm bg-white p-4 mb-4">
        <table class="table text-center">
            <thead>
            <tr>
                <th>#</th>
                <th>Tiêu đề</th>
                <th>Giảm giá(%)</th>
                <th>Mã code</th>
                <th>Thời gian bắt đầu</th>
                <th>Thời gian kết thúc</th>
                <th>Trang thái</th>
                <th><button class="btn btn-primary"><a href="{{url('vouchers/create')}}" class="text-white">Thêm mới</a></button></th>
            </tr>
            </thead>

            <tbody>
            @foreach($list as $a)
                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td>{{$a->title}}</td>
                    <td>{{$a->discount}}</td>
                    <td>{{$a->code}}</td>
                    <td>{{\Carbon\Carbon::parse($a->start_time)->format('d/m/Y H:i:s')}}</td>
                    <td>{{\Carbon\Carbon::parse($a->end_time)->format('d/m/Y H:i:s')}}</td>
                    <td>
                        @if($a->end_time > \Carbon\Carbon::now())
                            <span class="text-success">Còn hiệu lực</span>
                        @else
                            <span class="text-danger">Hết hạn</span>
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

