<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
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

    public function save_create(CategoryRequest $request)
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
        if ($res == null) {
            Session::flash('error', 'Thêm danh mục thất bại');
            redirect('categories/create');
        } else if ($res > 0) {
            Session::flash('success', 'Thêm danh mục thành công');
            return redirect('categories');
        } else {
            Session::flash('warning', 'Có lỗi xảy ra.Vui lòng thử lại sau !');
            redirect('categories/create');
        }
    }

    public function update($id)
    {
        $model = new Category();
        $this->v['category'] = $model->getCategory($id);
        return view('admin.category.edit_form', $this->v);
    }

    public function save_update($id, CategoryRequest $request)
    {
        $params = [];
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
            $pathImg = $request->file('img')->store('public/images/categories');
            $pathImg = str_replace('public/images/categories/', "", $pathImg);
            $params['cols']['img'] = $pathImg;
        }

        $model = new Category();

        $res = $model->saveUpdate($params);

        if ($res == null) {
            return redirect('categories/edit/' . $id);
        } else if ($res == 1) {
            Session::flash('success', 'Cập nhật danh mục thành công');
            return redirect('categories');
        } else {
            Session::flash('error', 'Cập nhật danh mục thất bại');
            return redirect('categories/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $model = new Category();

        $res = $model->remove($id);


        if ($res == 1) {
            Session::flash('success', 'Xóa danh mục thành công');
        } else {
            Session::flash('error', 'Xóa danh mục thất bại');
        }
        return redirect('categories');
    }
}
