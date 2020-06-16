<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Faculty extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fname', 'mi', 'lname', 'birthdate', 'address', 'contact', 'username', 'password', 'pos_id'
    ];
}
