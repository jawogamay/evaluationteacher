<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluateTeacher extends Model
{
    protected $fillable = [
        'form_id', 'teacher_id'
    ];
}
