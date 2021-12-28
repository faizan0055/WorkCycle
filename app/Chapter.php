<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $table='chapters';
    protected $fillable=['name','image','description','video'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
