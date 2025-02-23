<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Js;

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
        $this->v['list'] = $model->loadListWithPagers($request->all(), 6);
        return view('admin.product.list', $this->v);
    }

    public function create()
    {
        $model = new Category();
        $this->v['categories'] = $model->getAll();
        return view('admin.product.add_form', $this->v);
    }

    public function save_create(ProductRequest $request)
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

        $res = $model->saveCreate($prams, [$pathImg, json_encode($photo_gallery)]);

        if ($res == null) {
            Session::flash('error', 'Thêm voucher thất bại');
            redirect('products/create');
        } else if ($res > 0) {
            Session::flash('success', 'Thêm voucher thành công');
            return redirect('products');
        } else {
            Session::flash('warning', 'Có lỗi xảy ra.Vui lòng thử lại.');
            redirect('products/create');
        }
    }

    public function update($id)
    {
        $cateModel = new Category();
        $this->v['categories'] = $cateModel->getAll();
        $productModel = new Product();
        $this->v['product'] = $productModel->getProduct($id);
        return view('admin.product.edit_form', $this->v);
    }

    public function save_update($id, ProductRequest $request)
    {
        $params = [];
        $photo_gallery = [];
        $params['cols'] = array_map(function ($item) {
            if ($item == '') {
                $item = null;
            }
            if (is_string($item)) {
                $item = trim($item);
            }

            return $item;
        }, $request->post());
        unset($params['cols']['_token']);
        $params['cols']['id'] = $id;
        if (!empty($request->file('img'))) {
            $pathImg = $request->file('img')->store('public/images/products');
            $pathImg = str_replace('public/images/products', "", $pathImg);
            $params['cols']['img'] = $pathImg;
        }
        if ($request->has('photo_gallery')) {
            foreach ($request->file('photo_gallery') as $image) {
                $path = $image->store('public/images/products');
                $path = str_replace('public/images/products', "", $path);
                $photo_gallery[] = $path;
            }
            $params['cols']['photo_gallery'] = json_encode($photo_gallery);
        }
        $model = new Product();

        $res = $model->saveUpdate($params);
        if ($res == null) {
            return redirect('products/edit/' . $id);
        } else if ($res == 1) {
            Session::flash('success', 'Cập nhật sản phẩm thành công');
            return redirect('products');
        } else {
            Session::flash('error', 'Cập nhật sản phẩm thất bại');
            return redirect('products/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $model = new Product();

        $res = $model->remove($id);

        if ($res == null) {
            Session::flash('warning', 'Không tìm thấy sản phẩm cần xóa');
        } else if ($res == 1) {
            Session::flash('success', 'Xóa sản phẩm thành công');
        } else {
            Session::flash('error', 'Xóa sản phẩm thất bại');
        }
        return redirect('products');
    }
}
