<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable=['name','status','code'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
