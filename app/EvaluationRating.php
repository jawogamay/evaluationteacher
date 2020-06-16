<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationRating extends Model
{
    protected $fillable = [
        'ques_id', 'rating', 'rated_by'
    ];
}
