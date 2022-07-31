@extends('admin.layouts.main')

@section('title','Cập nhật voucher')

@section('content')
    <section class="bg-light rounded-3 p-4" style="position: relative;">
        <div class="row">
            <div class="col-8 shadow-sm bg-white rounded-2 p-4 col-lg-7">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Mã giảm giá</label>
                        <input class="form-control input" name="code" id="code" value="{{$voucher->code}}">
                    </div>
                    <div class="form-group">
                        <label>Giảm giá(%)</label>
                        <input class="form-control input" name="discount" id="discount" value="{{$voucher->discount}}">
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control input" name="title" id="title" value="{{$voucher->title}}">
                    </div>
                    <div class="form-group">
                        <label>Thời gian bắt đầu</label>
                        <input class="form-control input" type="datetime-local" id="start_time" name="start_time" value="{{$voucher->start_time}}">
                    </div>
                    <div class="form-group">
                        <label>Thời gian kết thúc</label>
                        <input class="form-control input" type="datetime-local" id="end_time" name="end_time"  value="{{$voucher->end_time}}">
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




    </section>
    <script src="{{asset('js/admin/voucher/add_form.js')}}"></script>
    <script !src="">
        const oldCode = inputs[0].value;
        const oldDiscount = inputs[1].value;
        const oldTitle = inputs[2].value;
        const oldStartTime = inputs[3].value;
        const oldEndTime = inputs[4].value;

        function get(){
            const start_time = new Date(oldStartTime);
            const end_time = new Date(oldEndTime);
            previews[0].innerText = oldTitle;
            previews[1].innerText = `Thẻ giảm giá ${oldDiscount}% cho mọi sản phẩm`;
            previews[2].innerText = 'Mã code: '+oldCode;
            previews[3].innerText = `${start_time.getDate()}/${start_time.getMonth()+1}/${start_time.getFullYear()} - ${end_time.getDate()}/${end_time.getMonth()+1}/${end_time.getFullYear()}`;
        }
    get();
        document.getElementById('btnReset').addEventListener('click',()=>{
           get();
            inputs[0].value = oldCode;
            inputs[1].value = oldDiscount;
            inputs[2].value = oldTitle;
            inputs[3].value = oldStartTime;
            inputs[4].value = oldEndTime;
        });
    </script>
@endsection
