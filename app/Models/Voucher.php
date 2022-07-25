<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';
    protected $fillable = ['id', 'title', 'discount', 'code', 'start_time', 'end_time'];

    public function loadListWithPagers($prams = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable)->orderBy('id', 'desc')
            ->paginate(10);

        return $query;
    }

    public function saveCreate($prams)
    {
        $data = array_merge($prams['cols'], [
           'created_at' => Date::now(),
           'updated_at' => Date::now()
        ]);

        $res = DB::table($this->table)->insertGetId($data);

        return $res;
    }

    public function getVoucher($id){
        $res = DB::table($this->table)->where('id','=',$id)->first();

        return $res;
    }
}
