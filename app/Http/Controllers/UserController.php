<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function save_create(Request $request){
        $prams = [];
        $prams['cols'] = array_map(function ($item){
            if($item == ''){
                $item = null;
            }
            if(is_string($item)){
                $item = trim($item);
            }
            return $item;
        },$request->post());
        unset($prams['cols']['_token']);
        $path = $request->file('img')->store('public/images/users');
        $path = str_replace('public/images/users', "", $path);
        $model = new User();

        $res = $model->saveCreate($prams,$path);

        if($res == null){
            Session::flash('error','Thêm voucher thất bại');
            redirect('users/create');
        }
        else if($res > 0){
            Session::flash('success','Thêm voucher thành công');
            return redirect('users');
        }else{
            Session::flash('warning','Có lỗi xảy ra.Vui lòng thử lại.');
            redirect('users/create');
        }
    }
    public function update($id){
        $model = new User();

        $this->v['user'] = $model->getUser($id);
       return view('admin.user.edit_form',$this->v);
    }
}
