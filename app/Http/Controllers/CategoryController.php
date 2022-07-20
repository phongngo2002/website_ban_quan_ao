<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

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

        return view('admin.category.list',$this->v);
    }

    public function create()
    {
        return view('admin.category.add_form', []);
    }
}
