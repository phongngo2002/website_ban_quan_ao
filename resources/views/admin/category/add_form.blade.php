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
    <section class="bg-light rounded-2 p-4" >
        <form action="{{url('create')}}" method="post" enctype="multipart/form-data">
          <div class="row" style="padding-bottom: 440px">
              <div class="col-9">
                  <div class="shadow-sm bg-white p-4 rounded-2">
                      <div class="form-group">
                          <label>Tiêu đề</label>
                          <input class="form-control" name="title" id="title">
                      </div>
                      <div class="form-group">
                          <label class="mb-2 font-bold my-2">Ảnh sản phẩm</label>
                          <input type="file" class="form-control" id="img" name="img">
                      </div>
                  </div>
                  <button class="btn btn-primary mt-2">Đăng</button>
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

        </form>
    </section>
    <script !src="">
        const title = document.getElementById('title');
        const img = document.getElementById('img');
        const previewTitle = document.getElementById('previewTitle');
        const previewImg = document.getElementById('previewImg');
        title.addEventListener('change',() => {
                previewTitle.innerText = title.value;
        });

        img.addEventListener('change',(e)=>{
            const file = e.target.files[0];

            const src = URL.createObjectURL(file);

            previewImg.src = src;
        });
    </script>
@endsection
