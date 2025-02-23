<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PrintBill;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;

class OrderController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $model = new Order();
        $this->v['list'] = $model->loadListWithPagers($request->all());
        return view('admin.order.list', $this->v);
    }

    public function getDetail($id)
    {
        $model = new Order();

        $this->v['order'] = $model->getOrderById($id);
        $this->v['order_detail'] = $model->getDetailInOrder($id);
        return view('admin.order.detail', $this->v);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:0,1,2,3'
        ]);
        $model = new Order();

        $model->updatetStatusOrder($request->status, $id);
        return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
    }

    public function printfBill($order_id)
    {
        $model = new PrintBill();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($model->print_order_convert($order_id));
        return $pdf->stream();
    }
}
