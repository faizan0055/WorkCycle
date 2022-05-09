<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BiddParticipate extends Model
{
    protected $table='biddparticipates';
    protected $fillable=['user_id','bidproperty_id','price'];
}
