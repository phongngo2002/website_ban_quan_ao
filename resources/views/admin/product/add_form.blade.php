@extends('admin.layouts.main')

@section('title','Thêm sản phẩm mới')



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

    .upload-btn-wrapper .file {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }

    .removeColor:hover {
        color: red;
        cursor: pointer;
    }
</style>
<section class="bg-light  rounded-2 p-4">
    @if($errors->all())
    <div class="alert alert-danger alert-dismissible show fade">
        Thêm sản phẩm thất bại.Vui lòng kiểm tra lại các trường dữ liệu
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">

            <div class="col-9">
                <div class="form-group mb-4 shadow-sm">
                    <input class="form-control" placeholder="Tên sản phẩm" name="product_name" id="product_name">

                </div>
                @error('product_name')
                <p class="text-danger mt-2">{{$message}}</p>
                @enderror
                <div class="form-group shadow-sm">
                    <section class="section">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Mô tả chi tiết</h4>
                            </div>
                            <div class="card-body">
                                <textarea class="form-control" rows="8" cols="15" name="desc" id="desc"></textarea>
                            </div>
                        </div>
                    </section>
                </div>
                @error('desc')
                <p class="text-danger mt-2">{{$message}}</p>
                @enderror
                <div class="row">
                    <div class="form-group ">
                        <label>Dữ liệu sản phẩm</label>
                        <div class="card shadow-sm" style="min-height: 400px">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                            aria-orientation="vertical">
                                            <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                                href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                                aria-selected="true">Chung</a>
                                            <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                                                href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                                aria-selected="false">Kiểm kê kho hàng</a>
                                            <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill"
                                                href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                                aria-selected="false">Giao hàng</a>
                                            <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill"
                                                href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                                aria-selected="false">Thuộc tính</a>
                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                                                aria-labelledby="v-pills-home-tab">
                                                <div class="form-group row">
                                                    <label class="col-2">Giá bán</label>
                                                    <div class="col-10">
                                                        <input class="form-control " name="price" id="price">
                                                    </div>
                                                </div>
                                                @error('price')
                                                <p class="text-danger mt-2">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                aria-labelledby="v-pills-profile-tab">
                                                <div class="form-group row">
                                                    <label class="col-2">Mã sản phẩm</label>
                                                    <div class="col-10">
                                                        <input class="form-control " name="SKU" id="SKU">
                                                    </div>
                                                </div>
                                                @error('SKU')
                                                <p class="text-danger mt-2">{{$message}}</p>
                                                @enderror
                                                <div class="form-group row">
                                                    <label class="col-2">Số hàng trong kho</label>
                                                    <div class="col-10">
                                                        <input class="form-control " name="in_stock" id="in_stock">
                                                    </div>
                                                </div>
                                                @error('in_stock')
                                                <p class="text-danger mt-2">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                                aria-labelledby="v-pills-messages-tab">
                                                <div class="form-group row">
                                                    <label class="col-2" for="weight">Trọng lượng(kg)</label>
                                                    <div class="col-10">
                                                        <input class="form-control " id="weight" name="weight">
                                                    </div>
                                                </div>
                                                @error('weight')
                                                <p class="text-danger mt-2">{{$message}}</p>
                                                @enderror
                                                <div class="form-group row">
                                                    <label class="col-2">Kích thước</label>
                                                    <div class="col-10">
                                                        <input type="hidden" name="dimensions" id="dimensions">
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <input class="form-control" placeholder="Dài"
                                                                    id="long" onchange="getInformation()">
                                                            </div>
                                                            <div class="col-4">
                                                                <input class="form-control" placeholder="Rộng"
                                                                    id="width" onchange="getInformation()">
                                                            </div>
                                                            <div class="col-4">
                                                                <input class="form-control" placeholder="Cao"
                                                                    id="height" onchange="getInformation()">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                @error('dimensions')
                                                <p class="text-danger mt-2">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                                aria-labelledby="v-pills-settings-tab">
                                                <div class="form-group row">
                                                    <input type="hidden" name="colors" id="colors">
                                                    <label class="col-2">Màu sắc</label>
                                                    <div class="row">

                                                        <div class="col-10">
                                                            <input class="form-control" placeholder="Tên màu"
                                                                id="color_name">
                                                        </div>
                                                        <div class="col-2">
                                                            <button class="btn btn-primary" type="button"
                                                                id="btnAdd">Thêm màu
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>

                                                <h6 id="title-ul" class="mt-4"></h6>
                                                <div
                                                    style="display: grid;grid-template-columns: repeat(4,1fr);max-height: 150px;overflow-y: auto;overflow-x:hidden "
                                                    id="preview" class="mb-2">
                                                </div>
                                                @error('colors')
                                                <p class="text-danger mt-2">{{$message}}</p>
                                                @enderror
                                                <div class="form-group">
                                                    <input type="hidden" name="sizes" id="sizes">
                                                    <div class="row">

                                                        <label class="col-2">Size</label>
                                                        <div class="col-8">
                                                            <input class="form-control " id="valueSize">
                                                        </div>
                                                        <div class="col-2">
                                                            <button class=" btn btn-primary" id="btnAddSizes"
                                                                type="button">Thêm
                                                            </button>
                                                        </div>

                                                    </div>
                                                    <p class="my-1">Phân cách các thẻ bằng dấu phẩy</p>
                                                    <div
                                                        style="display: grid;grid-template-columns: repeat(4,1fr);max-height: 150px;overflow-y: auto;overflow-x:hidden "
                                                        id="previewSize" class="mb-2">
                                                    </div>
                                                    @error('sizes')
                                                    <p class="text-danger mt-2">{{$message}}</p>
                                                    @enderror
                                                    <div class="form-group row mt-4">
                                                        <label class="col-2">Chất liệu</label>
                                                        <div class="col-10">
                                                            <input class="form-control " name="materials"
                                                                id="materials">
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('materials')
                                                <p class="text-danger mt-2">{{$message}}</p>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-2" for="short_desc">Mô tả ngắn</label>
                        <textarea class="form-control" rows="5" cols="15" name="short_desc"
                            id="short_desc"></textarea>
                    </div>
                    @error('short_desc')
                    <p class="text-danger mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <section class="mb-4 ms-3 row">
                        <button class="btn btn-primary" type="submit">Đăng</button>
                    </section>
                    <section class="card ms-3 shadow-sm border-2 border-dark row">
                        <label class="mb-2 font-bold my-2" for="category_id">Danh mục sản phẩm</label>
                        <select class="form-control my-4" name="category_id" id="category_id">
                            @foreach($categories as $c)
                            <option value="{{$c->id}}">{{$c->title}}</option>
                            @endforeach
                        </select>
                    </section>
                    <section class="card ms-3 shadow-sm border-2 border-dark row">
                        <label class="mb-2 font-bold my-2">Từ khóa sản phẩm</label>
                        <div class="row me-3 p-2">
                            <div class="col-10">
                                <input type="hidden" name="tag" id="tag">
                                <input class="form-control" id="tag_z" placeholder="Nhập từ khóa vào đây">
                                <p class="text-sm mt-1 ms-2">Phân cách các thẻ bằng dấu phẩy</p>
                            </div>
                            <div class="col-2">
                                <button class="btn btn-primary" id="btnAddTag" type="button">Thêm</button>
                            </div>
                        </div>
                        <div
                            style="display: grid;grid-template-columns: repeat(2,1fr);max-height: 150px;overflow-y: auto;overflow-x:hidden "
                            id="previewTag" class="mb-2">
                        </div>
                    </section>
                    <section class="card ms-3 shadow-sm border-2 border-dark row py-2">
                        <label class="mb-2 font-bold my-2">Ảnh sản phẩm</label>
                        <div class="upload-btn-wrapper row">
                            <img src="" id="previewMainImg" style="display: none">

                            <button class="btnUpload btn btn-link" type="button" id="btnAddMainImg">Thiết lập ảnh
                                sản phẩm
                            </button>
                            <button class="btnUpload btn btn-link text-danger" type="button" id="btnRemoveMainImg"
                                style="display: none">Xóa ảnh sản phẩm
                            </button>
                            <input type="file" name="img" id="img" class="file" />

                        </div>

                    </section>
                    @error('img')
                    <p class="text-danger mt-2">{{$message}}</p>
                    @enderror
                    <section class="card ms-3 shadow-sm border-2 border-dark row py-2">
                        <div>
                            <label class="mb-2 font-bold my-2 " style="float: left">Album hình ảnh sản phẩm</label>
                            <button class="btn text-danger" style="float: right;display: none" id="btnNone"
                                type="button">Bỏ chọn
                            </button>
                        </div>
                        <div class="upload-btn-wrapper row">
                            <div id="previewImgs" class="row text-center">

                            </div>
                            <div class="text-center">
                                <button class="btnUploads btn btn-link" type="button" id="btnAddMainImgMore">Thêm
                                    ảnh
                                    thư viện sản phẩm
                                </button>
                                <p id="imgLength" class="text-center"></p>
                                <input type="file" name="photo_gallery[]" class="file" id="imgs" multiple max="" />
                            </div>
                        </div>
                    </section>
                    @error('photo_gallery')
                    <p class="text-danger mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

        </div>
    </form>
</section>
<script src="{{asset('js/add_form.js')}}"></script>
<script src="https://cdn.tiny.cloud/1/23l4tyr8qs5720ac7v7xlgtooqmbfd8on5mbf3qsf5w1m377/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#desc',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
@endsection