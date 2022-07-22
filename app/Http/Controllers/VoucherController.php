<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    //

    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request){
        $model = new Voucher();
        $list = $model->loadListWithPagers($request->all());
        $this->v['list'] = $list;
        return view('admin.voucher.list',$this->v);
    }

    public function create(){
        return view('admin.voucher.add_form',[]);
    }

}
