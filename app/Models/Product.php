<?php

namespace App\Models;

use App\Models\ImageProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable= ['code','name','slug','image_primary','price','sale_off','description','short_description','status','featured','brand_id','category_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function productImages()
    {
        return $this->hasMany(ImageProduct::class);
    }
}
