<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
     protected $table = 'checkins';
     protected $fillable = ['id', 'user_id', 'checkin_latitude','checkin_longitude', 'checkout_latitude','checkout_longitude','checkin','checkout'];
     
     public function user() {
        return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }
}
