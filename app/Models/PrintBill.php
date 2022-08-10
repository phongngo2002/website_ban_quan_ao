<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintBill extends Model
{
    use HasFactory;


    public function print_order_convert($order_id)
    {
        $model = new Order();

        $orders = $model->getDetailInOrder($order_id);
        $order = $model->getOrderById($order_id);
        $output = '
<style>
 body{
 font-family: "DejaVu Sans";
 }
</style>
      <div style="border: 1px solid black">
        <div style="text-align: center">
        <h1 style="color: red">HÓA ĐƠN THANH TOÁN</h1>
</div>
<div style="padding: 2%">
<p>Đơn vị bán hàng: Poly Shop</p>
<p>Mã đơn hàng: '.$order->order_code.'</p>
<p>Địa chỉ: Tốt Động, Chương Mỹ, Hà Nội</p>
<p>Số điện thoại: 0325500080</p>
<p>Họ tên người nhận hàng: ' . $order->customer_name . '</p>
<p>Địa chỉ: ' . $order->address . '</p>
<p>Số điện thoại: ' . $order->phone_number . '</p>
<p>Hình thức thanh toán: Chuyển khoản</p>
<p>Ngày mua hàng: '.\Carbon\Carbon::parse($order->created_at)->format('d/m/Y').'</p>
<p>Hóa đơn có hiệu lực đến: '.\Carbon\Carbon::parse($order->created_at)->addDays(15)->format('d/m/Y').'</p>
</div>
<div>
<table border="1" style="margin: auto">
<tr>
<th style="width: 100px">STT</th>
<th style="width: 150px">Tên sản phẩm</th>
<th style="width: 100px">Số lượng</th>
<th style="width: 100px">Đơn giá</th>
<th style="width: 100px">Thành tiền</th>
</tr>';
        $i = 1;
        foreach ($orders as $a) {
            $output .= '
            <tr>
            <td style="width: 100px;text-align: center">' . $i . '</td>
            <td style="width: 150px;text-align: center">' . $a->product_name . '</td>
            <td style="width: 100px;text-align: center">' . $a->quantity . '</td>
            <td style="width: 100px;text-align: center">' . number_format($a->price, 0, ',', '.') . '</td>
            <td style="width: 100px;text-align: center">' . number_format($a->sum, 0, ',', '.') . '</td>
            </tr>
            ';
            $i++;
        }
        $output .= '
</table>
</div>
<h4 style="margin: 2%;">Phí vận chuyển: ' . number_format(13000, 0, ',', '.') . ' VNĐ</h4>
<h3 style="margin: 2%;color: red">Số tiền cần thanh toán: ' . number_format($order->total, 0, ',', '.') . ' VNĐ</h3>
<div style="margin-left: 5%" >
<h6 style="float: left">Chữ ký người nhận hàng</h6>
<div style="margin-left: 45%">
<h6>Chữ ký người làm hóa đơn</h6>
<h6 style="margin-left: 50%">Ngô Văn Phong</h6>
</div>
<div  >
<h6 style="text-align: right;margin-right: 8%">Ngày 22, tháng 8, năm 2022</h6>
</div>
</div>
        ';

        return $output;
    }
}
