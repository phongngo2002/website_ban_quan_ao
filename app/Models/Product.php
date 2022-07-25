<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['id','SKU','product_name','price','short_desc','img','sizes','colors','desc','weight','dimensions','materials','tag','photo_gallery',
        'in_stock'];
    public function loadListWithPagers($prams = []){
        $query = Product::with('category')->where('status','=',0)->orderBy('id','desc')->paginate(16);

        return $query;
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }


    public function saveCreate($prams, $data)
    {
        $data = array_merge($prams['cols'], [
            'img' => $data[0],
            'photo_gallery' => $data[1],
            'created_at' => Date::now(),
            'updated_at' => Date::now()
        ]);

        $res = DB::table($this->table)->insertGetId($data);

        return $res;
    }

    public function getProduct($id){
        $res = DB::table($this->table)->where('id','=',$id)->first();

        return $res;
    }

    public function getProductByCategory($category_id,$id){
        $res = DB::table($this->table)
            ->where('category_id',$category_id)
            ->where('status','=',0)
            ->where('id','!=',$id)
            ->get();

        return $res;
    }
}
