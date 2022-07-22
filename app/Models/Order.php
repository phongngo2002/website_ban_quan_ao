<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['id','order_code','email','customer_name','phone_number','address','voucher_id'];

    public function loadListWithPagers($prams = []){
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->paginate(10);

        return $query;
    }
}
