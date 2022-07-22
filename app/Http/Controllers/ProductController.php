<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request){
        $model = new Product();
        $this->v['list'] = $model->loadListWithPagers($request->all());
        return view('admin.product.list',$this->v);
    }

    public function create(){
        return view('admin.product.add_form',[]);
    }
}
