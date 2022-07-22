<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banners';

    protected $fillable = ['id','title','desc','img','thumb_img'];

    public function loadListWithPagers($prams = []){
        $query = DB::table($this->table)
            ->select($this->fillable)
            ->paginate(10);

        return $query;
    }
}
