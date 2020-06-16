<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fname', 'mi', 'lname', 'birthdate', 'address', 'contact', 'stu_id', 'password', 'sec_id'
    ];
}
