<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    private $v;
    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request){
        $model = new User();
        $this->v['list'] = $model->loadListWithPagers($request->all());
        return view('admin.user.list',$this->v);
    }

    public function create(){
        return view('admin.user.add_form',[]);
    }
}
