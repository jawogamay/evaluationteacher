<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionRating extends Model
{
    //
    protected $fillable = [
        'form_id','question_number','rate'
    ];

}
