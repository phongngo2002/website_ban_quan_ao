<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $banner_seed = [];
        $user_seed = [];
        $voucher_seed = [];
        $order_seed = [];
        $product_order_detail_seed = [];
        $product_seed = [];
        $category_seed = [];
        for($i = 1 ; $i <= 10 ; $i++){
            $banner_seed[] = [
              'title' => 'Tiêu đề banner '.$i,
                'desc' => 'Mô tả banner '.$i,
                'img' => 'slide-02.jpg',
                'thumb_img' => 'thumb-03.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $user_seed[] = [
                'email' => 'admin'.$i.'@gmail.com',
                'password' =>  Hash::make('123456'),
                 'name' => 'họ và tên '.$i,
                'address' => 'Địa chỉ '.$i,
                'avatar' => '1.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $voucher_seed[] = [
              'title' => 'Tiêu đề voucher '.$i,
                'discount' => 15,
                'code' => 'giamgia'.$i,
                'start_time' => date('Y-m-d H:i:s'),
                'end_time' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $order_code = '#0';
            if($i < 10){
                $order_code.='0'.$i;
            }else{
                $order_code.=$i;
            }

            $order_seed[] = [
              'order_code' => $order_code,
                'email' => 'nguoimua'.$i.'@gmail.com',
                'customer_name' => 'Họ và tên '.$i,
                'phone_number' => '0325500080',
                'address' => 'Tốt Động,Chương Mỹ,Hà Nội',
                'voucher_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $product_order_detail_seed[] = [
              'order_id' => $i,
                'product_id' => 1,
                'size' => 'X',
                'quantity' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $code = $i < 10 ? "0" : "";
            $product_seed[] = [
                'SKU' => "JK-$code$i",
                'product_name' => 'sản phẩm '.$i,
                'price' => 500000,
                'short_desc' => 'Mô tả ngắn '.$i,
                'img' => '/TQ6hZwW8yeDgyEOFiyh2hsYowmAhVam3bpxVwQeu.jpg',
                'sizes' => '["X","L","XL"]',
                "colors" => '["Xanh","Đỏ","Tím","Vàng"]',
                'desc' => 'Mô tả',
                'weight' => '0,6 kg',
                'dimensions' => '110 x 33 x 100 cm',
                'materials' => '60% cotton',
                'tag' => '["Fashion","Lifestyle","Denim"]',
                'photo_gallery' => '["\/N7T7VFetCW9BbXNGvfe6gQJrzgJ22y1EV3ct9ZlF.jpg","\/MAYCyGc5MCtjfEV17WU51ld3L1SyMyySWIA2fo3x.jpg"]',
                'in_stock' => 100,
                'category_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];


            $category_seed[] = [
                'title' => 'Tiêu đề '.$i,
                'img' => 'banner-04.jpg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        DB::table('banners')->insert($banner_seed);
        DB::table('users')->insert($user_seed);
        DB::table('vouchers')->insert($voucher_seed);
        DB::table('orders')->insert($order_seed);
        DB::table('product_order_detail')->insert($product_order_detail_seed);
        DB::table('products')->insert($product_seed);
        DB::table('categories')->insert($category_seed);
    }
}
