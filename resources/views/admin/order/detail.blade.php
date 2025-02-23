@extends('admin.layouts.main')

@section('title','Chi tiết đơn hàng '.$order->order_code.'')

@section('content')
<section class="rounded-2 shadow-sm bg-white p-4 mb-4">
    <h5 class="alert alert-success text-center">Thông tin chuyển hàng</h5>
    <table class="table text-center">
        <tr class="table-active">
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Hình thức thanh toán</th>
        </tr>
        <tr>
            <td>{{$order->customer_name}}</td>
            <td>{{$order->address}}</td>
            <td>{{$order->phone_number}}</td>
            <td>{{$order->email}}</td>
            <td>Chuyển khoản</td>
        </tr>
    </table>
</section>
<section class="rounded-2 shadow-sm bg-white p-4 mb-4">
    <h5 class="alert alert-success text-center">Liệt kê chi tiết đơn hàng</h5>
    <table class="table text-center">
        <tr class="table-active">
            <th></th>
            <th>Tên sản phẩm</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Giá sản phẩm</th>
            <th>Tổng tiền</th>
        </tr>
        @foreach($order_detail as $a)
        <tr class="">
            <td>{{$loop->iteration}}</td>
            <td>{{$a->product_name}}</td>
            <td>{{$a->code == 'giamgia1' ? 'Không có' : $a->code}}</td>
            <td>{{$a->quantity}}</td>
            <td>{{number_format($a->price, 0, ',', '.')}} VNĐ</td>
            <td>{{number_format($a->sum, 0, ',', '.')}} VNĐ</td>
        </tr>

        @endforeach
    </table>
    <div>
        <h6>Tổng giảm: {{($order->total - 13000) * $order->discount / 100}} VNĐ</h6>
        <h6>Phí vận chuyển: {{number_format(13000, 0, ',', '.')}} VNĐ</h6>
        <h5>Thanh toán: {{number_format($order->total - (($order->total - 13000) * $order->discount / 100), 0, ',', '.')}} VNĐ</h5>
    </div>
</section>
<form action="{{route('orders.update',['id' => $order->id])}}" method="post">
    @csrf
    <section class="rounded-2 shadow-sm bg-white p-4 mb-4">
        <div class="form-group">
            <label>Trạng thái đơn hàng</label>
            <select class="form-control mt-1" name="status">
                <option value="0" {{$order->status === 0 ? 'selected' : ''}}>Chờ xác nhận</option>
                <option value="1" {{$order->status === 1 ? 'selected' : ''}}>Đã giao hàng</option>
                <option value="2" {{$order->status === 2 ? 'selected' : ''}}>Đang giao hàng</option>
                <option value="3" {{$order->status === 3 ? 'selected' : ''}}>Hủy</option>
            </select>
        </div>
        <div>
            <button class="btn btn-primary">Lưu thay đổi</button>
            <a class="btn btn-success" target="_blank" href="{{url('/orders/printf-order/'.$order->id)}}">In hóa đơn</a>
        </div>
    </section>
</form>

@endsection