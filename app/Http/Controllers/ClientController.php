<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    private $v;
    public function __construct()
    {
        $this->v = [];
        $categoryModel = new Category();
        $this->v['categories'] = $categoryModel->getAll();
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $bannerModel = new Banner();
        $this->v['banners'] = $bannerModel->getAll();

        $productModel = new Product();
        $this->v['products'] = $productModel->loadListWithPagers([],13);
        return view('client.home.index',$this->v);
    }

    public function shop(Request $request){
        $productModel = new Product();
        $this->v['products'] = $productModel->loadListWithPagers([],13);
        return view('client.shop',$this->v);
    }

    public function detail(Request $request,$id){
        $productModel = new Product();
        $this->v['product'] = $productModel->getProduct($id);
      $this->v['products'] = $productModel->getProductByCategory($this->v['product']->category_id,$this->v['product']->id);
        return view('client.product_detail',$this->v);
    }

    public function getContact(){
        return view('client.contact',$this->v);
    }

    public function getblog(){
        return view('client.blog',$this->v);
    }

    public function getAbout(){
        return view('client.about',$this->v);
    }
}
