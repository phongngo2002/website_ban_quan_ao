@extends('admin.layouts.main')

@section('title','Danh sách người dùng')

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('success'))
        <div class="alert alert-success" id="alert"><i
                class="bi bi-check-circle me-3"></i>{{\Illuminate\Support\Facades\Session::get('success')}}</div>
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
                    <td><span class="avatar avatar-xl"><img src="{{asset('storage/images/users/'.$a->avatar)}}"></span>
                    </td>
                    <td>
                        @if($a->role_id == 1)
                            <span class="font-bold text-danger">Quản trị viên</span>
                        @else
                            <span class="font-bold text-success">Nhân viên</span>
                        @endif
                    </td>
                    <td>
                        <div style="display: flex;justify-content: center;">
                            <div>
                                <a class="btn btn-warning me-2" href="{{url('users/edit/'.$a->id)}}"><i
                                        class="fa-solid fa-file-pen"></i></a>
                            </div>
                            <form action="{{url('users/delete/'.$a->id)}}" method="post">
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
                                                    Bạn có chắc muốn xóa người dùng <span
                                                        class="font-bold">{{$a->name}}</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button"
                                                            class="btn btn-light-secondary"
                                                            data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Close</span>
                                                    </button>

                                                    <button type="submit" class="btn btn-warning ml-1"></i><span
                                                            class="d-none d-sm-block">Accept</span>
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
        <div>
            {{$list->links()}}
        </div>
    </section>
    <script !src="">
        const alertEle = document.querySelectorAll('.alert');

        alertEle.forEach(item => {
            setTimeout(function () {
                item.style.display = 'none';
            }, 2000)
        })
    </script>
@endsection
