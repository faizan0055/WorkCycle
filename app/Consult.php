<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    protected $table='consults';
    protected $fillable=['name','user_id','description'];
    public function consults()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
