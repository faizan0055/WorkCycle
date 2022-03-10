<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table='properties';
    protected $fillable=['name','user_id','category_id','description','image','price','type','size','bed','washroom'];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
