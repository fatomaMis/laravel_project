<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Room;
use App\Client;

class Myrecervation extends Model
{
       protected $table = 'myreservations';
       protected $fillable = [
        'price',
        'accompany_number',
        'client_id',
        'room_id'
    ];
    public function rooms(){
        return $this->belongsTo(Room::class);
    }

    public function clients(){
        return $this->belongsTo(Client::class);
    }
}
