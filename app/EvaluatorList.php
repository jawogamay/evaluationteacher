<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluatorList extends Model
{
    protected $fillable = [
        'form_id', 'student_id', 'faculty_id'
    ];
}
