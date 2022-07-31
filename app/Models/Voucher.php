<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'vouchers';
    protected $fillable = ['id', 'title', 'discount', 'code', 'start_time', 'end_time'];

    public function loadListWithPagers($prams = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable)->orderBy('id', 'desc')
            ->where('status','=',0)
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

    public function saveUpdate($params){
        if(empty($params['cols']['id'])){
            Session::flash('error','Không xác định bản ghi cần cập nhật');

            return null;
        }
        $dataUpdate = [];

        foreach ($params['cols'] as $colName => $val){
            if ($colName == 'id'){
                continue;
            }
            if (in_array($colName,$this->fillable)){
                $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
            }
        };
        $res = DB::table($this->table)
            ->where('id',$params['cols']['id'])
            ->update($dataUpdate);

        return $res;
    }

    public function remove($id){
        $voucher = DB::table($this->table)->where('id',$id)->first();

        if($voucher->end_time > \Carbon\Carbon::now()){
            return null;
        }

        $res = DB::table($this->table)->where('id',$id)->update(['status' => 1]);
        return $res;
    }
}
