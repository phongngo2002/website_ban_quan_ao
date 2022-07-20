<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['id','title','img','status'];

    public function loadListWithPager($pram = []){
        $query = DB::table($this->table)
                ->select($this->fillable)
                ->paginate(10);

        return $query;
    }
}
