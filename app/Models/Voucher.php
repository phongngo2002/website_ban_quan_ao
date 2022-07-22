<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';
    protected $fillable = ['id','title','discount','code','start_time','end_time'];

    public function loadListWithPagers($prams = []){
        $query = DB::table($this->table)
                ->select($this->fillable)
            ->paginate(10);

         return $query;
    }
}
