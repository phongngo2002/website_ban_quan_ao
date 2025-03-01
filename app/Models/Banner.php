<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = ['id','title','desc','img','thumb_img'];

    public function getAll(){
        $res = DB::table($this->table)
            ->select($this->fillable)
            ->where('status','=',0)
            ->get();

        return $res;
    }

    public function loadListWithPagers($prams = []){
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->where('status','=',0)
            ->orderBy('id','desc')
            ->paginate(10);

        return $query;
    }
    public function saveCreate($prams,$path){
        $data = array_merge($prams['cols'],[
            'img' => $path[0],
            'thumb_img' => $path[1],
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        $res = DB::table($this->table)->insertGetId($data);

        return $res;
    }

    public function getBanner($id){
        $res = DB::table($this->table)->where('id','=',$id)->first();

        return $res;
    }

    public function saveUpdate($params){
        $dataUpdate = [];
        if(empty($params['cols']['id'])){
            return null;
        }

        foreach ($params['cols'] as $colName => $val){
            if ($colName == 'id'){
                continue;
            }

            if (in_array($colName,$this->fillable)){
                $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
            }
        }

        $res = DB::table($this->table)
            ->where('id',$params['cols']['id'])
            ->update($dataUpdate);

        return $res;
    }

    public function remove($id){
        if(!isset($id)){
            return null;
        }

        $res = DB::table($this->table)->where('id',$id)->update(['status' => 1]);

        return $res;
    }
}
