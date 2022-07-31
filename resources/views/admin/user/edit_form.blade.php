@extends('admin.layouts.main')

@section('title','Cập nhật người dùng')

@section('content')
    <section class="bg-light rounded-2 p-4" >
        <div class="row">

            <div class="col-8 shadow-sm bg-white rounded-2 p-4">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{asset('storage/images/users/'.$user->avatar)}}" id="oldImg">
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" id="email" value="{{$user->email}}">
                        @error('email')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input class="form-control" type="password" name="password" id="password" value="{{$user->password}}" autocomplete>
                        @error('password')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Xác nhận mật khẩu</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="name" id="name" value="{{$user->name}}">
                        @error('name')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input class="form-control" name="address" id="address" value="{{$user->address}}">
                        @error('address')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Chức vụ</label>
                        <select class="form-control" name="role_id" id="role_id">
                            <option value="1" selected="{{$user->role_id == 1}}">Quản trị viên</option>
                            <option value="0" selected="{{$user->role_id == 0}}">Nhân viên</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="mb-2 font-bold my-2">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                    <button class="btn btn-success" type="button" id="btnReset">Reset</button>
                </form>
            </div>
            <div class="col-4">
                <div class="shadow-sm bg-white pb-4">
                    <div style="position: relative">
                        <div style="display: grid;grid-template-rows: repeat(2,1fr)">
                            <div style="background-image: url(https://images.unsplash.com/photo-1579546929518-9e396f3cc809?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MXx8fGVufDB8fHx8&w=1000&q=80);padding: 50px" ></div>
                            <div></div>
                        </div>
                        <div class="avatar" style="position: absolute;top: 50%;left: 50%;transform: translateX(-50%);transform: translateY(-50%);">
                            <img src="" style="margin-left: -50%;width: 150px;height: 125px" id="previewImg" alt="Ảnh đại diện">

                        </div>
                        <h6 class="text-center" id="previewRole">Quản trị viên</h6>
                    </div>
                    <div>
                        <ul>
                            <li style="list-style: none" class="text-lg"><i class="fa-solid fa-envelope mx-2" ></i><span id="previewEmail">Email</span></li>
                            <li style="list-style: none"  class="text-lg"><i class="fa-solid fa-user mx-2 my-2"></i><span id="previewName">Họ tên</span></li>
                            <li style="list-style: none"  class="text-lg"><i class="fa-solid fa-location-dot mx-2"></i><span id="previewAddress">Địa chỉ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <script>
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const address = document.getElementById('address');
        const name = document.getElementById('name');
        const role = document.getElementById('role_id');
        const img = document.getElementById('img');
        const previewImg = document.getElementById('previewImg');
        const previewName = document.getElementById('previewName');
        const previewAddress = document.getElementById('previewAddress');
        const previewEmail = document.getElementById('previewEmail');
        const previewRole = document.getElementById('previewRole');
        const oldData = [];
        email.addEventListener('change',()=>{
            previewEmail.innerText = email.value;
        });
        name.addEventListener('change',()=>{
            previewName.innerText = name.value;
        });
        address.addEventListener('change',()=>{
            previewAddress.innerText = address.value;
        });
        role.addEventListener('change',()=>{
            previewRole.innerText = role.value == 1 ? 'Quản trị viên' : 'Nhân viên';
        });
        img.addEventListener('change',(e)=>{
            const file = e.target.files[0];

            const src = URL.createObjectURL(file);

            previewImg.src = src;
        });
        oldData.push(email.value);
        oldData.push(password.value);
        oldData.push(name.value);
        oldData.push(address.value);
        oldData.push(role.value);
        oldData.push(document.getElementById('oldImg').value);
        function get(){
            previewName.innerText = oldData[2];
            previewEmail.innerText = oldData[0];
            previewRole.innerText = oldData[4] == 1 ? 'Quản trị viên' : 'Nhân viên';
            previewAddress.innerText = oldData[3];
            previewImg.src = oldData[5];
        }
        get();
        document.getElementById('btnReset').addEventListener('click',()=>{
            get();
            email.value = oldData[0];
            password.value = oldData[1];
            name.value = oldData[2];
            address.value = oldData[3];
            role.value = oldData[4];
            previewImg.src = oldData[5];
            const dt = new DataTransfer();
            img.files = dt.files;
        });
        </script>
@endsection
