<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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


    public function index(Request $request)
    {
        $model = new User();
        $this->v['list'] = $model->loadListWithPagers($request->all());
        return view('admin.user.list', $this->v);
    }

    public function create()
    {
        return view('admin.user.add_form', []);
    }

    public function save_create(UserRequest $request)
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
        $path = $request->file('img')->store('public/images/users');
        $path = str_replace('public/images/users', "", $path);
        $model = new User();

        $res = $model->saveCreate($prams, $path);
        if ($res == null) {
            Session::flash('error', 'Thêm người dùng thất bại');
            return redirect('users/create');
        } else if ($res > 0) {
            Session::flash('success', 'Thêm người dùng thành công');
            return redirect('users');
        } else {
            Session::flash('warning', 'Có lỗi xảy ra.Vui lòng thử lại.');
            return redirect('users/create');
        }

    }

    public function update($id)
    {
        $model = new User();

        $this->v['user'] = $model->getUser($id);
        return view('admin.user.edit_form', $this->v);
    }

    public function save_update($id, UserRequest $request)
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
            $path = $request->file('img')->store('public/images/users');
            $path = str_replace('public/images/users/', "", $path);
        }
        $model = new User();

        $res = $model->saveUpdate($params);
        if ($res == null) {
            return redirect('users/edit/' . $id);
        } else if ($res == 1) {
            Session::flash('success', 'Cập nhật người dùng thành công');
            return redirect('users');
        } else {
            Session::flash('error', 'Cập nhật người dùng thất bại');
            return redirect('users/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $model = new User();

        $res = $model->remove($id);
        if ($res == null) {
            Session::flash('warning', 'Không tìm thấy bản ghi cần xóa');
        } elseif ($res == 1) {
            Session::flash('success', 'Xóa người dùng thành công');
        } else {
            Session::flash('error', 'Xóa người dùng thất bại');
        }
        return redirect('users');
    }
}
