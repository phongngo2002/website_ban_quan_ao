<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request){
        $model = new Banner();
        $this->v['list'] = $model->loadListWithPagers($request->all());
        return view('admin.banner.list',$this->v);
    }

    public function create(){
        return view('admin.banner.add_form',[]);
    }


}
