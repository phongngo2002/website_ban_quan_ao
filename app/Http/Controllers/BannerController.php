<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        $pathImg = $request->file('img')->store('public/images/banners');
        $pathImg = str_replace('public/images/banners', "", $pathImg);
        $pathThumbImg = $request->file('thumb_img')->store('public/images/banners');
        $pathThumbImg = str_replace('public/images/banners', "", $pathThumbImg);
        $model = new Banner();

        $res = $model->saveCreate($prams,[$pathImg,$pathThumbImg]);

        if($res == null){
            Session::flash('error','Thêm banner thất bại');
            redirect('banners/create');
        }
        else if($res > 0){
            Session::flash('success','Thêm banner thành công');
            return redirect('banners');
        }else{
            Session::flash('warning','Có lỗi xảy ra.Vui lòng thử lại.');
            redirect('banners/create');
        }
    }
    public function update($id){
        $model = new Banner();

        $this->v['banner'] = $model->getBanner($id);
        return view('admin.banner.edit_form',$this->v);
    }
}
