<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo('App\Client');
    }
}
