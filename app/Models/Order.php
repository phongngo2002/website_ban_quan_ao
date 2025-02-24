<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['id', 'order_code', 'email', 'customer_name', 'phone_number', 'address', 'voucher_id', 'status', 'total'];

    public function loadListWithPagers($prams = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->orderBy('id', 'desc')
            ->where('status', '!=', 3)
            ->paginate(10);

        return $query;
    }

    public function saveNewOrder($data)
    {
        $carts = json_decode(Cookie::get('carts'));
        $dataMail = null;
        $code = time();
        $dataOrder = array_merge([
            'order_code' => '#' . $code,
            'voucher_id' => isset($carts->voucher) ? $carts->voucher->id : 1,
            'total' => $carts->totalPrice + 13000,
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ], $data['cols']);
        $order_id = DB::table($this->table)->insertGetId($dataOrder);
        foreach ($carts->products as $a) {
            $dataMail[] = [
                'img' => $a->img,
                'product_name' => $a->product_name,
                'price' => $a->price,
                'quantity' => $a->totalQuantity,
                'total' => $a->totalQuantity * $a->price
            ];
            $product = DB::table('products')->where('id', $a->id)->first();
            foreach ($a->detail as $b) {
                DB::table('product_order_detail')->insert(
                    [
                        'order_id' => $order_id,
                        'product_id' => $a->id,
                        'size' => $b->size,
                        'quantity' => $b->quantity,
                        'color' => $b->color,
                        'created_at' => Date::now(),
                        'updated_at' => Date::now()

                    ]
                );
            }
            DB::table('products')->where('id', $a->id)->update(['in_stock' => $product->in_stock - $a->totalQuantity, 'updated_at' => Date::now()]);
        }

        return [
            'email' => $data['cols']['email'],
            'name' => $data['cols']['customer_name'],
            'order_code' => '#' . $code,
            'products' => $dataMail,
            'date' => \date('Y-m-d H:i:s'),
            'total' => $carts->totalPrice,
            'discount' => DB::table('vouchers')->where('id', $dataOrder['voucher_id'] ?? 0)->first()->discount ?? 0
        ];
    }

    public function getOrderById($id)
    {
        $res = DB::table($this->table)
            ->select('order_code', 'email', 'customer_name', 'phone_number', 'voucher_id', 'address', 'total', 'orders.id', 'orders.created_at', 'orders.status')
            ->where('orders.id', $id)->first();
        $discount = DB::table('vouchers')->where('id', $res->voucher_id)->first();
        if ($discount) {
            $res->disount = $discount->discount;
        } else {
            $res->discount = 0;
        }

        return $res;
    }


    public function updatetStatusOrder($status = 0, $id)
    {
        $res = DB::table($this->table)
            ->where('id', $id)
            ->update(['status' => $status]);

        return $res;
    }

    public function getDetailInOrder($order_id)
    {
        $res = DB::table($this->table)
            ->selectRaw('product_name,SUM(quantity) quantity,price,SUM(quantity * price) sum')
            ->join('product_order_detail', 'orders.id', '=', 'product_order_detail.order_id')
            ->join('products', 'product_order_detail.product_id', '=', 'products.id')
            ->groupBy('product_name', 'price')
            ->where('orders.id', $order_id)
            ->get();

        return $res;
    }
}
