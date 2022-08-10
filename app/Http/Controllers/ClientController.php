<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckOutRequest;
use App\Mail\OrderShipped;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    private $v;


    public function __construct()
    {
        $this->v = [];
        $categoryModel = new Category();
        $this->v['categories'] = $categoryModel->getAll();

    }

    public function cart()
    {
        $carts = [];
        $carts = json_decode(Cookie::get('carts'));
        return $carts;
    }

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $bannerModel = new Banner();
        $this->v['banners'] = $bannerModel->getAll();
        $this->v['carts'] = $this->cart();
        $productModel = new Product();
        $this->v['products'] = $productModel->loadListWithPagers([], 13);
        return view('client.home.index', $this->v);
    }

    public function shop(Request $request)
    {
        $this->v['carts'] = $this->cart();
        $productModel = new Product();
        $this->v['products'] = $productModel->loadListWithPagers([], 13);
        return view('client.shop', $this->v);
    }

    public function detail(Request $request, $id)
    {
        $this->v['carts'] = $this->cart();
        $productModel = new Product();
        $this->v['product'] = $productModel->getProduct($id);
        $this->v['products'] = $productModel->getProductByCategory($this->v['product']->category_id, $this->v['product']->id);
        return view('client.product_detail', $this->v);
    }

    public function getContact()
    {
        return view('client.contact', $this->v);
    }

    public function getblog()
    {
        return view('client.blog', $this->v);
    }

    public function getAbout()
    {
        return view('client.about', $this->v);
    }

    public function getCart(Request $request)
    {
        $this->v['carts'] = $this->cart();
        return view('client.view_cart', $this->v);
    }

    public function addCart(Request $request, $id)
    {
        $data = [
            'id' => $id,
            'size' => strtolower($request->input('size' . $id)),
            'color' => strtolower($request->input('color' . $id)),
            'quantity' => $request->input('quantity' . $id)
        ];
        $model = new Cart(json_decode(Cookie::get('carts')));

        $res = $model->addCart($data);

        if ($res) {
            Session::flash('success', 'Thêm sản phẩm vào giỏ hàng thành công');
            return redirect()->back()->cookie('carts', json_encode($res), 21600);
        }
    }

    public function updateCart(Request $request)
    {

        $carts = Cookie::get('carts');
        $model = new Cart(json_decode($carts));

        $res = $model->updateCart($request->all());

        return redirect()->back()->cookie('carts', json_encode($res), 21600);
    }

    public function deleteCart($id)
    {
        $carts = Cookie::get('carts');

        $model = new Cart(json_decode($carts));

        $res = $model->deleteCart($id);

        if ($res) {
            Session::flash('success', 'Xóa sản phẩm trong giỏ hàng thành công.');
            return redirect()->back()->cookie('carts', json_encode($res), 21600);
        }
    }

    public function deleteItem($id, $size, $color)
    {
        $carts = Cookie::get('carts');

        $model = new Cart(json_decode($carts));

        $res = $model->removeOneProductInCart([$id, $color, $size]);

        if ($res) {
            Session::flash('success', 'Xóa sản phẩm trong giỏ hàng thành công.');
            return redirect()->back()->cookie('carts', json_encode($res), 21600);
        }
    }

    public function getCheckOut(Request $request)
    {
        $this->v['carts'] = $this->cart();
        return view('client.check_out', $this->v);
    }

    public function postCheckOut(CheckOutRequest $request)
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
        $model = new Order();
        $res = $model->saveNewOrder($params);
        if ($res) {
            return redirect('/thank-you')->with('result', $res)->cookie('carts', json_encode([]));
        }
    }

    public function thankYouPage()
    {
        Mail::to(Session::get('result')['email'])->send(new OrderShipped(['data' => Session::get('result')]));
        $this->v['carts'] = $this->cart();
        $this->v['email'] = Session::get('result')['email'];
        return view('client.thank_you', $this->v);
    }
}
