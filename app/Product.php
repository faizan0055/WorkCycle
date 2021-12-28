<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['category_id','reference','sub_category_id','name','image','price','discount'];

    public function categories()
    {
        return $this->belongsTo(Chapter::class,'category_id');
    }
    public function sub_categories()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class,'product_id');
    }
}
