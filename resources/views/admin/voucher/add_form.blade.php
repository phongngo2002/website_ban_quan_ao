@extends('admin.layouts.main')

@section('title','Thêm mới voucher')

@section('content')
    <section class="bg-light rounded-3 p-4" style="position: relative;">
            <div class="row">
                <div class="col-8 shadow-sm bg-white rounded-2 p-4 col-lg-7">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label>Mã giảm giá</label>
                        <input class="form-control input" name="code" id="code">
                        @error('code')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Giảm giá(%)</label>
                        <input class="form-control input" name="discount" id="discount">
                        @error('discount')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control input" name="title" id="title">
                        @error('title')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Thời gian bắt đầu</label>
                        <input class="form-control input" type="datetime-local" id="start_time" name="start_time">
                        @error('start_time')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Thời gian kết thúc</label>
                        <input class="form-control input" type="datetime-local" id="end_time" name="end_time">
                        @error('end_time')
                        <p class="text-danger mt-2">{{$message}}</p>
                        @enderror
                    </div>
                    <button class="btn btn-primary">Lưu</button>
                    <button class="btn btn-success" type="button" id="btnReset">Reset</button>
                </form>
                </div>
                <div class="col-4 p-4 col-lg-5">
                    <div class="row shadow-sm bg-white rounded-2 p-1" style="background-image: url(https://images.unsplash.com/photo-1579546929518-9e396f3cc809?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwyMzQ5MjZ8MHwxfHNlYXJjaHwxOXx8R3JhZGllbnR8ZW58MHx8fHwxNjU2MTQyNjk3&ixlib=rb-1.2.1&q=80&w=1080)">
                        <div class="col-7">
                            <h4 class="m-2 text-light preview">Tiêu đề</h4>
                            <p class="ms-2 preview text-light">Mô tả</p>
                            <p class="ms-2 text-sm preview text-light">Mã code</p>
                            <span class="text-sm ms-2 preview text-light"></span>
                        </div>
                        <div class="col-5 pt-5">
                            <img src="{{asset('client/images/voucher_img.png')}}" style="width: 100%;">
                        </div>
                    </div>

                </div>
            </div>



{{--        <div id="editor"></div>--}}
    </section>
    <script src="{{asset('js/admin/voucher/add_form.js')}}"></script>
{{--    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>--}}
{{--    <script src="https://cdn.ckbox.io/CKBox/1.1.0/ckbox.js"></script>--}}
{{--    <script>--}}
{{--        ClassicEditor--}}
{{--            .create( document.querySelector( '#editor' ), {--}}
{{--                ckbox: {--}}
{{--                    tokenUrl: 'https://90989.cke-cs.com/token/dev/QCd4rJVdBKZbGfPnWeqajbRSUQaFnRlFbFaN?limit=10',--}}
{{--                },--}}
{{--                toolbar: [--}}
{{--                    'ckbox', 'imageUpload', '|', 'heading', '|', 'undo', 'redo', '|', 'bold', 'italic', '|',--}}
{{--                    'blockQuote', 'indent', 'link', '|', 'bulletedList', 'numberedList'--}}
{{--                ],--}}
{{--            } )--}}
{{--            .catch( error => {--}}
{{--                console.error( error );--}}
{{--            } );--}}
{{--    </script>--}}
@endsection
