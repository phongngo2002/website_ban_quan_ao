<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['id', 'title', 'img', 'status'];

    public function getAll()
    {
        return DB::table($this->table)
            ->select($this->fillable)
            ->where('status','=',0)
            ->get();
    }

    public function loadListWithPager($pram = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->where('status','=',0)
            ->orderBy('id','desc')
            ->paginate(10);

        return $query;
    }

    public function saveCreate($prams, $src)
    {
        $data = array_merge($prams['cols'], [
            'img' => $src,
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        $res = DB::table($this->table)->insertGetId($data);

        return $res;
    }

    public function getCategory($id)
    {
        $res = DB::table($this->table)
            ->where('id', '=', $id)
            ->first();

        return $res;
    }
}
