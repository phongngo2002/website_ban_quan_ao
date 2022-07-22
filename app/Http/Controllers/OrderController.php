<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request){
        $model = new Order();
        $this->v['list'] = $model->loadListWithPagers($request->all());
        return view('admin.order.list',$this->v);
    }

}
