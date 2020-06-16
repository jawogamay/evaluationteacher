<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherEvaluation extends Model
{
    //
    protected $fillable = [
        'student_id','teacher_id','form_id','is_done'
    ];
    public function evaluateform(){
        return $this->belongsTo('App\EvaluationForm','form_id');
    }
}
