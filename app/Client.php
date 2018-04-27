<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use Notifiable;
    //
    protected $fillable = [
        'name', 'email', 'password','avatar_image','gender','countries'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
