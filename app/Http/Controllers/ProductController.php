<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $model = new Product();
        $this->v['list'] = $model->loadListWithPagers($request->all());
        return view('admin.product.list', $this->v);
    }

    public function create()
    {
        $model = new Category();
        $this->v['categories'] = $model->getAll();
        return view('admin.product.add_form', $this->v);
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
        $photo_gallery = [];
        $pathImg = $request->file('img')->store('public/images/products');
        $pathImg = str_replace('public/images/products', "", $pathImg);
        if ($request->has('photo_gallery')) {
            foreach ($request->file('photo_gallery') as $image) {
                $path = $image->store('public/images/products');
                $path = str_replace('public/images/products', "", $path);
                $photo_gallery[] = $path;
            }
        }
        $model = new Product();

        $res = $model->saveCreate($prams,[$pathImg,json_encode($photo_gallery)]);

        if($res == null){
            Session::flash('error','Thêm voucher thất bại');
            redirect('products/create');
        }
        else if($res > 0){
            Session::flash('success','Thêm voucher thành công');
            return redirect('products');
        }else{
            Session::flash('warning','Có lỗi xảy ra.Vui lòng thử lại.');
            redirect('products/create');
        }
    }

    public function update($id){
        $cateModel = new Category();
        $this->v['categories'] = $cateModel->getAll();
        $productModel = new Product();
        $this->v['product'] = $productModel->getProduct($id);
       return view('admin.product.edit_form',$this->v);
    }
}
