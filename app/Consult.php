<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    protected $table='consults';
    protected $fillable=['question','user_id','reply'];
    public function consults()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
