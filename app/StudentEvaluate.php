<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentEvaluate extends Model
{
    //
    protected $fillable = [
        'form_id','student_id'
    ];
    public function studentevaluate(){
        return $this->belongsTo('App\EvaluationForm','form_id');
    }
}
