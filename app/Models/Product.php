<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['id','SKU','product_name','price','short_desc','img','sizes','colors','desc','weight','dimensions','materials','tag','photo_gallery',
        'in_stock'];
    public function loadListWithPagers($prams = []){
        $query = Product::with('category')->paginate(6);

        return $query;
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
