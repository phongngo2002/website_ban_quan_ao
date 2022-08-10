@extends('admin.layouts.main');

@section('title','Thêm mới danh mục');

@section('content')

    <style>
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btnUpload {
            border: none;
            background: white;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
    </style>
    <section class="bg-light rounded-2 p-4">

        <div class="row" style="padding-bottom: 440px">

            @csrf
            <div class="col-9">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow-sm bg-white p-4 rounded-2">
                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input class="form-control" name="title" id="title">
                            @error('title')
                            <p class="text-danger mt-2">{{$message}}</p>
                            @enderror
                            <p></p>
                        </div>
                        <div class="form-group">
                            <label class="mb-2 font-bold my-2">Ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="img" name="img">

                            @error('img')
                            <p class="text-danger mt-2">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Đăng</button>
                </form>
            </div>
            <div class="col-3">
                <div class="shadow-sm bg-white p-4 rounded-2">
                    <div class="row">
                        <div class="col-4">
                            <h4 class="font-bold" id="previewTitle">Tiêu đề</h4>
                            <span style="font-size: 10px">Spring 2022</span>
                        </div>
                        <div class="col-8">
                            <img src="" style="width: 100%" alt="Ảnh sản phẩm" id="previewImg">
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
    <script !src="">
        const inputElement = document.querySelector('#test');

        // Create a FilePond instance
        const title = document.getElementById('title');
        const img = document.getElementById('img');
        const previewTitle = document.getElementById('previewTitle');
        const previewImg = document.getElementById('previewImg');
        title.addEventListener('change', () => {
            previewTitle.innerText = title.value;
        });

        img.addEventListener('change', (e) => {
            const file = e.target.files[0];

            const src = URL.createObjectURL(file);

            previewImg.src = src;
        });
    </script>
@endsection
