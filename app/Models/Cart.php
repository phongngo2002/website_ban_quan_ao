<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;

    public $totalPrice = 0;
    public $totalQuantity = 0;
    public $products = null;
    public $voucher = null;

    public function __construct($cart)
    {
        if ($cart) {

            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuantity = $cart->totalQuantity;
            $this->voucher = $cart->voucher;
        }
    }

    public function addCart($data)
    {
        $model = new Product();
        $product = $model->getProduct($data['id']);
        $newProduct = [
            'id' => $data['id'],
            'product_name' => $product->product_name,
            'img' => $product->img,
            'quantity' => $data['quantity'],
            'size' => $data['size'],
            'price' => $product->price,
            'color' => $data['color'],
        ];
        $check = false;
        if (!empty($this->products)) {
            $carts = $this->products;
            foreach ($carts as $cart) {
                if ($cart->id == $newProduct['id']) {
                    $temp = false;
                    $check = true;
                    foreach ($cart->detail as $c) {
                        if ($c->size == $newProduct['size'] && $c->color == $newProduct['color']) {
                            $c->quantity += $newProduct['quantity'];
                            $temp = true;
                            break;
                        }
                    }
                    if (!$temp) {
                        $cart->detail[] = [
                            'size' => $newProduct['size'],
                            'color' => $newProduct['color'],
                            'quantity' => $newProduct['quantity']
                        ];
                    }
                    $cart->totalQuantity += $newProduct['quantity'];
                }
            }

            if (!$check) {
                $carts[] = [
                    'id' => $newProduct['id'],
                    'product_name' => $newProduct['product_name'],
                    'img' => $newProduct['img'],
                    'price' => $newProduct['price'],
                    'detail' => [
                        [
                            'size' => $newProduct['size'],
                            'color' => $newProduct['color'],
                            'quantity' => $newProduct['quantity']
                        ]
                    ],
                    'totalQuantity' => $newProduct['quantity']
                ];
            }
            $this->products = $carts;
        } else {
            $this->products[] = [
                'id' => $newProduct['id'],
                'product_name' => $newProduct['product_name'],
                'img' => $newProduct['img'],
                'price' => $newProduct['price'],
                'detail' => [
                    [
                        'size' => $newProduct['size'],
                        'color' => $newProduct['color'],
                        'quantity' => $newProduct['quantity']
                    ]
                ],
                'totalQuantity' => $newProduct['quantity']
            ];
        }

        $this->totalQuantity += $newProduct['quantity'];
        $this->totalPrice += $newProduct['quantity'] * $product->price;
        return [
            'products' => $this->products,
            'totalPrice' => $this->totalPrice,
            'totalQuantity' => $this->totalQuantity,
            'voucher' => $this->voucher
        ];
    }

    public function updateCart($data)
    {
        if (isset($data['cancelVoucher'])) {
            Session::flash('success', 'Hủy áp dụng voucher thành công');
            return [
                'products' => $this->products,
                'totalPrice' => $data['totalPrice'],
                'totalQuantity' => $data['totalPrice'],
                'voucher' => null
            ];
        }
        if (isset($data['coupon'])) {
            $model = new Voucher();
            $res = $model->getVoucherByCode($data['coupon']);

            if ($res) {
                Session::flash('success', 'Áp dụng voucher thành công');
                $this->voucher = [
                    'id' => $res->id,
                    'discount' => $res->discount
                ];
            } else {
                Session::flash('warning', 'Không tìm thấy voucher bạn đã nhập.Vui lòng thử mã khác');
            }
        } else {
            Session::flash('success', 'Cập nhật giỏ hàng thành công');
        }

        for ($j = 0; $j < count($this->products); $j++) {
            $arr = json_decode($data['num-product' . ($j + 1)]);
            $sum = 0;
            $a = 0;
            for ($i = 0; $i < count($this->products[$j]->detail); $i++) {
                $this->products[$j]->detail[$i]->quantity = $arr[$a];
                $sum += $arr[$a];
                $a++;
            }
            $this->products[$j]->totalQuantity = $sum;
        }
        return [
            'products' => $this->products,
            'totalPrice' => $data['totalPrice'],
            'totalQuantity' => $data['totalQuantity'],
            'voucher' => $this->voucher
        ];
    }

    public function deleteCart($id)
    {
        $data = [];
        $money = 0;
        foreach ($this->products as $p) {
            if ($p->id == $id) {
                $this->totalQuantity -= $p->totalQuantity;
            } else {
                $data[] = $p;
                $money += $p->price * $p->totalQuantity;
            }
        }
        $obj = null;
        if (empty($data)) {
            $obj = [];
        } else {
            $this->products = $data;
            $obj = [
                'products' => $this->products,
                'totalPrice' => $money,
                'totalQuantity' => $this->totalQuantity,
                'voucher' => $this->voucher
            ];
        }


        return $obj;
    }

    public function removeOneProductInCart($data)
    {
        $arr = [];
        foreach ($this->products as $a) {
            if ($a->id == $data[0]) {
                foreach ($a->detail as $c) {
                    if ($c->size == $data[1] && $c->color == $data[2]) {
                        $a->totalQuantity -= $c->quantity;
                        $this->totalQuantity -= $c->quantity;
                        $this->totalPrice -= $a->price * $c->quantity;
                        continue;
                    }

                    $arr->detail[] = $c;

                }
                if (!empty($arr)) {
                    $a->detail = $arr;
                } else {
                    $this->deleteCart($data[0]);
                }
                break;
            }
        }
        return [
            'products' => $this->products,
            'totalPrice' => $this->totalPrice,
            'totalQuantity' => $this->totalQuantity,
            'voucher' => $this->voucher
        ];
    }
}
