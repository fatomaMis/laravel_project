<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'room_number', 'number', 'capacity','price','manager_id','floor_id','is_admin'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
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
 
