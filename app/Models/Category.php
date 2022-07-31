<?php

namespace App\Models;

use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['id', 'title', 'img', 'status'];

    public function getAll()
    {
        return DB::table($this->table)
            ->select($this->fillable)
            ->where('status', '=', 0)
            ->get();
    }

    public function loadListWithPager($pram = [])
    {
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->where('status', '=', 0)
            ->orderBy('id', 'desc')
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

    public function saveUpdate($params)
    {
        $dataUpdate = [];
        if (empty($params['cols']['id'])) {
            return null;
        }

        foreach ($params['cols'] as $colName => $val) {
            if ($colName == 'id') {
                continue;
            }

            if (in_array($colName, $this->fillable)) {
                $dataUpdate[$colName] = (strlen($val) == 0) ? null : $val;
            }
        }

        $res = DB::table($this->table)
            ->where('id', $params['cols']['id'])
            ->update($dataUpdate);

        return $res;
    }

    public function remove($id)
    {

        if (!isset($id)) {
            return null;
        }

        $res = DB::table($this->table)->where('id', $id)->update(['status' => 1]);

        DB::table('products')->where('category_id', $id)->update(['status' => 1]);

        return $res;
    }
}
