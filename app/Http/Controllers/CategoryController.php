<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $model = new Category();
        $list = $model->loadListWithPager($request->all());

        $this->v['list'] = $list;

        return view('admin.category.list', $this->v);
    }

    public function create()
    {
        return view('admin.category.add_form', []);
    }

    public function save_create(Request $request)
    {
        $prams = [];
        $prams['cols'] = array_map(function ($item) {
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }

            return $item;
        }, $request->post());
        unset($prams['cols']['_token']);
        $pathImg = $request->file('img')->store('public/images/categories');
        $pathImg = str_replace('public/images/categories', "", $pathImg);
        $model = new Category();
        $res = $model->saveCreate($prams, $pathImg);
        if($res == null){
            Session::flash('error','Thêm danh mục thất bại');
            redirect('categories/create');
        }
        else if($res > 0){
            Session::flash('success','Thêm danh mục thành công');
           return redirect('categories');
        }else{
            Session::flash('warning','Có lỗi xảy ra.Vui lòng thử lại sau !');
            redirect('categories/create');
        }
    }

    public function update($id){
        $model = new Category();
        $this->v['category'] = $model->getCategory($id);
        return view('admin.category.edit_form',$this->v);
    }
}
