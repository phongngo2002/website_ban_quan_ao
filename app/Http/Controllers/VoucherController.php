<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VoucherController extends Controller
{
    //

    private $v;

    public function __construct()
    {
        $this->v = [];
    }

    public function index(Request $request)
    {
        $model = new Voucher();
        $list = $model->loadListWithPagers($request->all());
        $this->v['list'] = $list;
        return view('admin.voucher.list', $this->v);
    }

    public function create()
    {
        return view('admin.voucher.add_form', []);
    }

    public function save_create(VoucherRequest $request)
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

        $model = new Voucher();

        $res = $model->saveCreate($prams);

        if ($res == null) {
            Session::flash('error', 'Thêm voucher thất bại');
            redirect('vouchers/create');
        } else if ($res > 0) {
            Session::flash('success', 'Thêm voucher thành công');
            return redirect('vouchers');
        } else {
            Session::flash('warning', 'Có lỗi xảy ra.Vui lòng thử lại.');
            redirect('vouchers/create');
        }
    }

    public function update($id)
    {
        $model = new Voucher();

        $this->v['voucher'] = $model->getVoucher($id);
        return view('admin.voucher.edit_form', $this->v);
    }

    public function save_update($id, VoucherRequest $request)
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

        $model = new Voucher();

        $res = $model->saveUpdate($params);

        if ($res == null) {
            return redirect('vouchers/edit/' . $id);
        } else if ($res == 1) {
            Session::flash('success', 'Cập nhật banner thành công');
            return redirect('vouchers');
        } else {
            Session::flash('error', 'Cập nhật banner thất bại');
            return redirect('vouchers/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $model = new Voucher();

        $res = $model->remove($id);
        if ($res == null) {
            Session::flash('warning', 'Voucher đang trong thời gian áp dụng không thể xóa.');
        } else if ($res == 1) {
            Session::flash('success', 'Xóa voucher thành công');
        } else {
            Session::flash('error', 'Xóa voucher thất bại');
        }
        return redirect('vouchers');
    }
}
