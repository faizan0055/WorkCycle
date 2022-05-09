<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidd extends Model
{

    protected $table='biddproperties';
    protected $fillable=['name','user_id','description','image','price','type','size','bed','washroom','start_datetime','end_datetime'];
}
