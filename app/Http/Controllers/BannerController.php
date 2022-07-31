<?php

namespace App\Http\Controllers;

use App\Http\Requests\BannerRequest;
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
        $model = Banner::all();
    }

    public function index(Request $request)
    {
        $model = new Banner();
        $this->v['list'] = $model->loadListWithPagers($request->all());
        return view('admin.banner.list', $this->v);
    }

    public function create()
    {
        return view('admin.banner.add_form', []);
    }

    public function save_create(BannerRequest $request)
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
        $pathImg = $request->file('img')->store('public/images/banners');
        $pathImg = str_replace('public/images/banners', "", $pathImg);
        $pathThumbImg = $request->file('thumb_img')->store('public/images/banners');
        $pathThumbImg = str_replace('public/images/banners', "", $pathThumbImg);
        $model = new Banner();

        $res = $model->saveCreate($prams, [$pathImg, $pathThumbImg]);

        if ($res == null) {
            Session::flash('error', 'Thêm banner thất bại');
            redirect('banners/create');
        } else if ($res > 0) {
            Session::flash('success', 'Thêm banner thành công');
            return redirect('banners');
        } else {
            Session::flash('warning', 'Có lỗi xảy ra.Vui lòng thử lại.');
            redirect('banners/create');
        }
    }

    public function update($id)
    {
        $model = new Banner();

        $this->v['banner'] = $model->getBanner($id);
        return view('admin.banner.edit_form', $this->v);
    }

    public function save_update($id, BannerRequest $request)
    {
        $method_route = 'route_BackEnd_Banner_SaveUpdate';
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
            $pathImg = $request->file('img')->store('public/images/banners');
            $pathImg = str_replace('public/images/banners/', "", $pathImg);
            $params['cols']['img'] = $pathImg;
        }
        if (!empty($request->file('thumb_img'))) {
            $pathThumbImg = $request->file('thumb_img')->store('public/images/banners');
            $pathThumbImg = str_replace('public/images/banners/', "", $pathThumbImg);
            $params['cols']['thumb_img'] = $pathThumbImg;
        }

        $model = new Banner();

        $res = $model->saveUpdate($params);


        if ($res == null) {
            return redirect('banners/edit/' . $id);
        } else if ($res == 1) {
            Session::flash('success', 'Cập nhật banner thành công');
            return redirect('banners');
        } else {
            Session::flash('error', 'Cập nhật banner thất bại');
            return redirect('banners/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $model = new Banner();

        $res = $model->remove($id);

        if ($res == null) {
            Session::flash('error', 'Không tìm thấy banner cần xóa');
        } else if ($res == 1) {
            Session::flash('success', 'Xóa banner thành công');
        } else {
            Session::flash('error', 'Cập nhật banner thất bại');
        }
        return redirect('banners');
    }
}
