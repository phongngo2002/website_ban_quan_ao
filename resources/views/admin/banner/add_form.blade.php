@extends('admin.layouts.main')

@section('title','Thêm mới banner')

@section('content')
    <section class="bg-light rounded-2 p-4" style="position: relative;">
        <form action="{{url('create')}}" method="post" enctype="multipart/form-data">
            <div class="row " style="padding-bottom: 280px">
                <div class="col-7 shadow-sm bg-white rounded-2 p-4">
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" name="desc" id="desc">

                        </textarea>
                    </div>
                    <div class="form-group">
                        <label class="mb-2 font-bold my-2">Ảnh nền</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>
                    <div class="form-group">
                        <label class="mb-2 font-bold my-2">Ảnh đại diện</label>
                        <input type="file" class="form-control" id="thumb_img" name="thumb_img">
                    </div>
                    <button class="btn btn-primary">Thêm mới</button>
                </div>
                <div class="col-5">
                    <div class="shadow-sm bg-white rounded-2 p-2" id="previewElement" style="position: relative ;display: none">
                        <img src="" style="width: 100%;filter: brightness(85%)" id="previewImg">
                        <div style="position: absolute;top: 30%;left: 50%;transform: translateY(-50%);transform: translateX(-50%);text-align: center">
                            <span class="text-white font-bold" style="font-size: 16px" id="previewDesc">

                            </span>

                            <h2 class="text-white font-bold" style="font-size: 35px" id="previewTitle">

                            </h2>

                            <button class="btn btn-primary rounded-pill font-bold text-sm">SHOP NOW</button>
                            <div>
                                <img src="" class="mt-4" style="width: 95px;height: 50px" id="previewThumb" >
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </form>

    </section>

    <script !src="">
        const img = document.getElementById('img');
        const btn = document.getElementById('btnPreview');
        const title = document.getElementById('title');
        const desc = document.getElementById('desc');
        const thumbImg = document.getElementById('thumb_img');
        const previewTitle = document.getElementById('previewTitle');
        const previewDesc = document.getElementById('previewDesc');
        const previewThumb = document.getElementById('previewThumb');
        img.addEventListener('change', (e) => {
            fileName = e.target.files[0].name;

            document.getElementById('previewImg').src = URL.createObjectURL(e.target.files[0]);
            document.getElementById('previewElement').style.display = 'block';
        });
        title.addEventListener('change',()=>{
            previewTitle.innerText = title.value;
        });
        desc.addEventListener('change',()=>{
            previewDesc.innerText = desc.value;
        });
        thumbImg.addEventListener('change',(e)=>{
            previewThumb.src = URL.createObjectURL(e.target.files[0]);
        });

    </script>
@endsection
